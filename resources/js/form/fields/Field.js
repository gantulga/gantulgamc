export default {

    props: {
        id: { type: [String, Number], required: false },
        name: { type: String, required: true },
        label: { type: [String, Boolean], required: false },
        value: { required: false },
        readonly: { type: Boolean, required: false, default: false },
        placeholder: { type: String, required: false },
        showHelpText: { type: Boolean, default: true },
        helpText: { type: String, required: false },
        showErrors: { type: Boolean, default: true },
        horizontal: { type: Boolean, default: true },
    },

    data() {
        return {
            fieldValue: this.value ? JSON.parse(JSON.stringify(this.value)) : null,
            inputClasses: 'shadow appearance-none bg-white border border-grey-darker rounded w-full py-2 px-3 text-grey-darkest leading-tight focus:outline-none focus:shadow-outline',
        }
    },

    watch: {
        value(value) {
            this.fieldValue = value;
        },

        fieldValue(value) {
            this.$emit("input", value);
        }
    }
}
