require('./bootstrap');

window.Vue = require('vue');
var Turbolinks = require('turbolinks');
var TurbolinksAdapter = require('vue-turbolinks').default;
var scrollreveal = require('./scrollreveal').default;

Vue.use(TurbolinksAdapter);
Turbolinks.start();
//Turbolinks.setProgressBarDelay(10);

import VueProgressBar from 'vue-progressbar'
window.Vue.use(VueProgressBar, {
    color: '#00947D',
    failedColor: '#E3342F',
    thickness: '3px',
    autoFinish: false,
})


Vue.component('carousel', require('./components/Carousel.vue'));
Vue.component('slide', require('./components/Slide.vue'));
Vue.component('tab', require('./components/Tab.vue'));
Vue.component('tabs', require('./components/Tabs.vue'));
Vue.component('vertical-tabs', require('./components/VerticalTabs.vue'));
Vue.component('scrollbar', require('./components/Scrollbar.vue'));
Vue.component('accordion', require('./components/Accordion.vue'));
Vue.component('accordion-panel', require('./components/AccordionPanel.vue'));
Vue.component('image-loader', require('./components/ImageLoader.vue'));
Vue.component('bg-loader', require('./components/BackgroundLoader.vue'));
Vue.component('lightbox', require('./components/Lightbox.vue'));
Vue.component('metric', require('./components/Metric.vue'));
Vue.component('search-box', require('./components/SearchBox.vue'));
Vue.component('alert-success', require('./components/alert/Success.vue'));

function initApp() {

    return new Vue({
        el: '#app',
        data() {
            return {
                pjaxKey: 1,
                showTopBar: true,
                showSearch: false,
                isNavbarSticky: true,
            }
        },
        created() {
            console.log('App created.');
        },
        mounted(){
            console.log('app mounted')
            window.addEventListener('scroll', this.onScroll)
            scrollreveal();
        },
        beforeDestroy () {
            console.log('app before destroy')
            window.removeEventListener('scroll', this.onScroll)
        },
        computed: {

        },
        methods: {
            toggleMainMenu() {
                this.$refs.mainMenu.classList.toggle('hidden');
            },
            toggleSearch() {
                this.showSearch = !this.showSearch;
            },
            onScroll () {
                this.showTopBar = this.$el.getBoundingClientRect().top == 0;
                this.isNavbarSticky = this.$refs.footer.getBoundingClientRect().top > (window.innerHeight || document.documentElement.clientHeight);
            }
        }
    });
}

document.addEventListener('turbolinks:load', (event) => {
    if (window.vue) {
        //window.vue.$Progress.finish();
        window.vue.$destroy(true);
    }
    window.vue = initApp();
})

document.addEventListener('turbolinks:click', (event) => {
    window.vue.$Progress.start();
    //window.vue.$Progress.increase(10);
    //Turbolinks.setProgressBarDelay(0);
    console.log('turbolinks click')
})

document.addEventListener('turbolinks:request-end', (event) => {
    window.vue.$Progress.finish();
})


