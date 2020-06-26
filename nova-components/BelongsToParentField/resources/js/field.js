Nova.booting((Vue, router) => {
    Vue.component('index-belongs-to-parent-field', require('./components/IndexField'));
    Vue.component('detail-belongs-to-parent-field', require('./components/DetailField'));
    Vue.component('form-belongs-to-parent-field', require('./components/FormField'));
})
