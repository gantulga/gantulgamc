Nova.booting((Vue, router) => {
    Vue.component('index-belongs-to-many-checkbox', require('./components/IndexField'));
    Vue.component('detail-belongs-to-many-checkbox', require('./components/DetailField'));
    Vue.component('form-belongs-to-many-checkbox', require('./components/FormField'));
})
