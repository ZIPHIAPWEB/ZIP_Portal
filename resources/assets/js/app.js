
require('./bootstrap');

window.Vue = require('vue');

import Chart from 'chart.js'
import Vue from 'vue';

Vue.use(require('@ckeditor/ckeditor5-vue2'));

Vue.component('download-excel', require('vue-json-excel'));
Vue.component('chart-component', require('./components/Chart.vue'));
//const app = new Vue({
//    el: '#app'
//});