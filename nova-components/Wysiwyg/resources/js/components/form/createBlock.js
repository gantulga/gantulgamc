
export default function (config) {

    var { attributes } = config;

    config.props = {
        ... config.props,
        field: Object,
        resourceId: [Number,String],
        attributes: {
            type: Object,
            required: true,
            default: function () {
                var defaults = {};
                Object.keys(attributes).forEach(key => {
                    let attr = attributes[key];
                    defaults[key] = attr.default ? attr.default : null;
                });
                return defaults;
            },
            validator: function (uvAttributes) {
                for (const key in attributes) {
                    let attrDef = attributes[key];

                    if (attrDef.hasOwnProperty('required') && attrDef.required && !uvAttributes.hasOwnProperty(key)) {
                        console.log('required validation')
                        return false;
                    }
                    /*
                    if (attrDef.hasOwnProperty('type') && uvAttributes.hasOwnProperty(key) && typeof (uvAttributes[key]) != attrDef.type) {
                        console.log('type validation', key, uvAttributes[key], typeof(uvAttributes[key]), attrDef.type)
                        return false;
                    }
                    */
                };
                return true;
            }
        }
    }
    config.model = {
        prop: 'attributes',
        event: 'change'
    }
    config.watch = {
        attributes: {
            deep: true,
            handler: function (attributes) {
                this.$emit("change", attributes);
            }
        }
    }

    return config;
}
