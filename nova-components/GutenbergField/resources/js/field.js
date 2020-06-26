Nova.booting((Vue, router) => {
    Vue.component('index-gutenberg-field', require('./components/IndexField'));
    Vue.component('detail-gutenberg-field', require('./components/DetailField'));
    Vue.component('form-gutenberg-field', require('./components/FormField'));
})
