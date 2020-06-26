let ResourceBrowser = require('./components/ResourceBrowser');
Nova.booting((Vue, router) => {
    Vue.component('index-media-field', require('./components/IndexField'));
    Vue.component('detail-media-field', require('./components/DetailField'));
    Vue.component('form-media-field', require('./components/FormField'));
    Vue.component('media-resource-index', require('./components/MediaIndex.jsx').default);
    Vue.component('resource-browser', ResourceBrowser);
})

