<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <div v-for="val in value" :key="val.id" class="mb-3" >
                <ImageLoader :src="field.diskPath + val.file" class="max-w-xs" @missing="(value) => missing = value" />

                <input :id="field.name" type="text"
                    class=" form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="field.name"
                    :value="val.original_name"
                    disabled="disabled"
                />
                <DeleteButton @click="confirmRemoval(val.id)" :dusk="field.attribute + '-delete-link'">
                    <span class="class ml-2 mt-1">
                        {{__('Delete')}}
                    </span>
                </DeleteButton>
            </div>
            <input type="button" v-if="field.multi || value.length==0" @click="browseMedia" class="btn btn-default btn-primary" value="Add media" />
            <resource-browser
                :field="field"
                resource-name="media"
                @actionExecuted="actionExecuted"
                :via-resource-id="resourceId"
                :load-cards="false"
                @select="selected"
                :open="browseModalOpen"
                v-if="browseModalOpen"
                @onClose="closeMedia"
            />

            <transition name="fade">
                <!--modal v-if="browseModalOpen" @modal-close="closeMedia" >
                    <div class="bg-40 rounded shadow-lg overflow-hidden p-4" style="width: 1024px; min-width: 1024px;">
                        <media-resource-index
                            :field="field"
                            resource-name="media"
                            @actionExecuted="actionExecuted"
                            :via-resource-id="resourceId"
                            :load-cards="false"
                            :mime-type="field.mimeType"
                            @select="selected"
                        />
                    </div>
                </modal-->
                <confirm-upload-removal-modal
                    v-if="removeMediaId"
                    @confirm="removeFile"
                    @close="closeRemoveModal"
                />
            </transition>

            <p v-if="hasError" class="mt-4 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors, Errors } from 'laravel-nova'
import ImageLoader from  '../../../../../nova/resources/js/components/ImageLoader'
import DeleteButton from '../../../../../nova/resources/js/components/DeleteButton'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    components: { ImageLoader, DeleteButton },

    data: () => ({
        browseModalOpen: false,
        removeMediaId: 0,
        uploadErrors: new Errors(),
    }),

    computed: {
        hasError() {
            return this.uploadErrors.has(this.fieldAttribute)
        },

        firstError() {
            if (this.hasError) {
                return this.uploadErrors.first(this.fieldAttribute)
            }
        },
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            this.value.forEach(val => {
                formData.append(this.field.attribute+'[]', val.id);
            });
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },

        /**
         * Show media browser modal.
         */
        browseMedia() {
            this.browseModalOpen = true;
        },

        /**
         * Close media browser modal.
         */
        closeMedia() {
            this.browseModalOpen = false;
        },

        /**
         * Handle the actionExecuted event and pass it up the chain.
         */
        actionExecuted() {
            this.$emit('actionExecuted')
        },

        /**
         * Handle the select event.
         */
        selected(selectedResources) {
            selectedResources.length && this.closeMedia();
            if(!this.field.multi){
                // get only last element as array
                selectedResources = [selectedResources[selectedResources.length-1]]
            }
            if(selectedResources.length){
                this.value = [...this.value, ...selectedResources];
            }
        },

        /**
         * Confirm removal of the linked file
         */
        confirmRemoval(id) {
            this.removeMediaId = id
        },

        closeRemoveModal() {
            this.removeMediaId = 0
        },

        /**
         * Detach the linked media
         */
        async removeFile() {
            this.uploadErrors = new Errors()

            const {
                resourceName,
                resourceId,
                removeMediaId
            } = this

            const attribute = this.field.attribute

            const uri = `/nova-vendor/media-field/${resourceName}/${resourceId}/media/${removeMediaId}/field/${attribute}?viaRelationship=${attribute}`

            try{
                if(this.value.find(val=> val.id == this.removeMediaId).pivot) {
                    await Nova.request().delete(uri)
                }
                this.value = this.value.filter(
                    val => val.id != this.removeMediaId
                );
                this.$emit('media-removed')
                this.closeRemoveModal()
            }
            catch (error) {
                this.closeRemoveModal()

                if (error.response) { //error.response.status == 422
                    this.uploadErrors = new Errors(error.response.data.errors)
                }
            }
        },
    },
}
</script>
