
require('./bootstrap');

import { createApp } from 'vue';

import router from './router';

import App from './App.vue';

// Vue.use(require('@ckeditor/ckeditor5-vue2'));

// Vue.component('download-excel', require('vue-json-excel'));
// Vue.component('chart-component', require('./components/Chart.vue'));
//const app = new Vue({
//    el: '#app'
//});

createApp(App)
    .use(router)
    .mount('#app');