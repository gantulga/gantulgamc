<template>
    <default-field :field="field" :errors="errors" :fullWidthContent="true">
        <template slot="field">
            <div v-if="hasValue" class="mb-6">
                <template v-if="shouldShowLoader">
                    <ImageLoader
                        :src="imageUrl"
                        :maxWidth="maxWidth"
                        @missing="value => (missing = value)"
                    />
                </template>

                <template v-if="field.value && !imageUrl">
                    <card
                        class="flex item-center relative border border-lg border-50 overflow-hidden p-4"
                    >
                        <span class="truncate mr-3"> {{ field.value }} </span>

                        <DeleteButton
                            :dusk="field.attribute + '-internal-delete-link'"
                            class="ml-auto"
                            v-if="shouldShowRemoveButton"
                            @click="confirmRemoval"
                        />
                    </card>
                </template>

                <p v-if="imageUrl" class="mt-3 flex items-center text-sm">
                    <DeleteButton
                        :dusk="field.attribute + '-delete-link'"
                        v-if="shouldShowRemoveButton"
                        @click="confirmRemoval"
                    >
                        <span class="class ml-2 mt-1"> {{ __('Delete') }} </span>
                    </DeleteButton>
                </p>

                <portal to="modals">
                    <transition name="fade">
                        <confirm-upload-removal-modal
                            v-if="removeModalOpen"
                            @confirm="removeFile"
                            @close="closeRemoveModal"
                        />
                    </transition>
                </portal>
            </div>

            <span class="form-file mr-4" :class="{ 'opacity-75': isReadonly }">
                <input
                    ref="fileField"
                    :dusk="field.attribute"
                    class="form-file-input select-none"
                    type="file"
                    :id="idAttr"
                    name="name"
                    @change="fileChange"
                    :disabled="isReadonly"
                    :multiple="isMultiple"
                />
                <label
                    :for="labelFor"
                    class="form-file-btn btn btn-default btn-primary select-none"
                >
                    {{ __('Choose File') }}
                </label>
            </span>

            <span class="text-gray-50 select-none"> {{ currentLabel }} </span>
            <ul v-if="isMultiple && files.length" class="list-reset mt-3">
                <li v-for="file in files" :key="file.name">{{file.name}}</li>
            </ul>
            <p v-if="hasError" class="text-xs mt-2 text-danger">{{ firstError }}</p>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors, Errors } from 'laravel-nova'
import FileField from '../../../../../nova/resources/js/components/Form/FileField';

export default {
    mixins: [FormField, HandlesValidationErrors, FileField],
    data(){
        return {
            files: [],
        }
    },
    mounted() {
        this.field.fill = this.fill;
    },
    computed:{
        isMultiple(){
            return this.field.multiple || false;
        }
    },
    methods: {
        /**
         * Respond to the file change
         */
        fileChange(event) {
            let files = this.$refs.fileField.files;
            this.file = files[0];
            this.fileName = files[0].name;

            if(this.isMultiple){
                this.files = Array.from(files);
                this.files.shift();
            }
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
         fill(formData) {
            if (this.file) {
                formData.append(this.field.attribute, this.file, this.fileName)
            }
            if(this.isMultiple && this.files.length){
                this.files.forEach(file=>{
                    formData.append(this.field.attribute + ':$' + '[]', file, file.name)
                })
            }
        }
    }

}
</script>
