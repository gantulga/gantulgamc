import { Errors } from 'form-backend-validation'

export default {
    props: {
        errors: {
            //default: () => new Errors(),
        },
    },

    data: () => ({
        errorClass: 'has-error border-red',
    }),

    computed: {
        errorObject() {
            return this.errors instanceof Errors ? this.errors : new Errors(this.errors);
        },

        errorClasses() {
            return this.hasError ? this.errorClass : ''
        },

        hasError() {
            return this.errorObject.has(this.name) || this.errorObject.has(this.alternateName)
        },

        firstError() {
            if (this.hasError) {
                return this.errorObject.first(this.name) || this.errorObject.first(this.alternateName)
            }
        },

        alternateName() {
            return this.name.replace(/\]/g, '').replace(/\[/g, '.');
        }
    },
}
