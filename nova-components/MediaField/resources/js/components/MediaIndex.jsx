import ResourceIndex from '../../../../../nova/resources/js/views/Index';

export default {
    mixins: [ResourceIndex],
    props: {
        mimeType: {
            type: String,
        },
    },
    computed: {
        /**
         * Return the heading for the view
         */
        headingTitle() {
            return 'Browse Media';
        },

        /**
         * Build the resource request query string.
         */
        resourceRequestQueryString() {
            return {
                ... ResourceIndex.computed.resourceRequestQueryString.call(this),
                mimeType: this.mimeType,
            }
        },


    },
    methods: {
        select() {
            this.$emit('select', this.selectedResources.map(res => {
                return Object.values(res.fields).reduce((res, field) => {
                    res[field.attribute] = field.value;
                    return res;
                }, {});
            } ));
        }
    },
    render(h){
        return <div>
            {ResourceIndex.render.call(this, ...arguments)}
            {(!this.loading && !this.initialLoading) &&
                <div class="bg-30 flex px-8 py-4">
                    <input type="button" value="Select" onClick={this.select} disabled={!this.selectedResources.length} dusk="select-button" class={"ml-auto btn btn-default btn-primary " + (!this.selectedResources.length ? ' opacity-50 cursor-not-allowed':'')} />
                </div>
            }
        </div>;
    },

}
