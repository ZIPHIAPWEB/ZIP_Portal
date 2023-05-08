
import { createApp } from 'vue';
import { createPinia } from 'pinia';

import App from './App.vue';
import router from './router';

// Vue.use(require('@ckeditor/ckeditor5-vue2'));

// Vue.component('download-excel', require('vue-json-excel'));
// Vue.component('chart-component', require('./components/Chart.vue'));
//const app = new Vue({
//    el: '#app'
//});

createApp(App)
    .use(createPinia())
    .use(router)
    .mount('#app');