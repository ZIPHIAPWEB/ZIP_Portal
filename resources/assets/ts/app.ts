
import { createApp, markRaw } from 'vue';
import { createPinia } from 'pinia';

import App from './App.vue';
import router from './router';

import type { Router } from 'vue-router';
declare module 'pinia' {
    export interface PiniaCustomProperties {
        router: Router;
    }
}

const app = createApp(App);
const pinia = createPinia();
// Vue.use(require('@ckeditor/ckeditor5-vue2'));

// Vue.component('download-excel', require('vue-json-excel'));
// Vue.component('chart-component', require('./components/Chart.vue'));
//const app = new Vue({
//    el: '#app'
//});

pinia.use(({ store }) => {
    store.router = markRaw(router);
});

app.use(pinia);
app.use(router);
app.mount('#app');