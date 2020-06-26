<script>
import BelongsToField from '../../../../../nova/resources/js/components/Form/BelongsToField'

import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [BelongsToField],

    computed: {
        /**
         * Get the query params for getting available resources
         */
        queryParams() {
            return {
                params: {
                    ... BelongsToField.computed.queryParams.call(this).params,
                    resourceId: this.$route.params.resourceId,
                    viaResourceId: this.$route.query.viaResourceId,
                    viaResource: this.$route.query.viaResource,
                    viaRelationship: this.$route.query.viaRelationship,
                }
            }
        }
    }

    /*
    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
   /*     setInitialValue() {
            this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
   /*     fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
    /*    handleChange(value) {
            this.value = value
        },
    },
    */
}
</script>
