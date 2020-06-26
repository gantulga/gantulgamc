<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <div class="w-full max-col-3">
                <div
                    v-for="resource in availableResources"
                    :key="resource.value"
                    class="flex mb-2"
                >
                    <checkbox
                        :value="resource.value"
                        :checked="isChecked(resource)"
                        @input="toggleOption(resource)"
                        class="pr-2"
                    />
                    <label
                        :for="resource.value"
                        v-text="resource.display"
                        @click="toggleOption(resource)"
                        class="w-full"
                    ></label>
                </div>
            </div>

            <!-- Trashed State -->
            <div v-if="softDeletes && !isLocked">
                <checkbox-with-label :checked="withTrashed" @change="toggleWithTrashed">
                    {{ __('With Trashed') }}
                </checkbox-with-label>
            </div>
        </template>
    </default-field>
</template>
<script>
import BelongsToField from '../../../../../nova/resources/js/components/Form/BelongsToField'
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, BelongsToField],
    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || []
        },

        isChecked(option) {
            return this.value ? this.value.find(item=>item.value==option.value) : false
        },

        toggleOption(option) {
            if (this.isChecked(option)) {
                //this.$set(this, 'value', this.value.filter(item => item.value != option.value))
                this.value = this.value.filter(item => item.value != option.value);
                return
            }
            //if(Number.isInteger(option.value)) {
                this.value.push(option)
            //}
        },

         /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            if(this.value.length == 0){
                formData.append(this.field.attribute, []);
            }
            else {
                this.value.forEach(val => {
                    formData.append(this.field.attribute+'[]', val.value);
                });
            }
        },
    }
}
</script>
<style>
    .max-col-3 {
        -moz-column-count: 3;
        -webkit-column-count: 3;
        column-count: 3;
        white-space: nowrap;
    }

    .max-col-2 {
        -moz-column-count: 2;
        -webkit-column-count: 2;
        column-count: 2;
        white-space: nowrap;
    }
</style>
