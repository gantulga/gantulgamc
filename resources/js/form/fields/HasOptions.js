export default {
    methods: {
        getValue(option, key) {
            if (typeof (option) == 'string' && typeof (key) == 'string') return key;
            if (typeof (option) == 'string' && typeof (key) == 'number') return option;
            if (typeof (option) == 'object') {
                if (option.key && option.value) return option.key;
                if (option.value && option.label) return option.value;
                for (const key in option) {
                    if (option.hasOwnProperty(key)) {
                        return key;
                    }
                }
            }
            return option;
        },
        getLabel(option, key) {
            if (typeof (option) == 'string') return option;
            if (typeof (option) == 'object') {
                if (option.key && option.value) return option.value;
                if (option.value && option.label) return option.label;
                for (const key in option) {
                    if (option.hasOwnProperty(key)) {
                        return option[key];
                    }
                }
            }
            return option;
        }
    }
}
