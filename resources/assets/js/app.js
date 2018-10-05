
require('./bootstrap');

window.Vue = require('vue');

import Chart from 'chart.js'

Vue.component('download-excel', require('vue-json-excel'));
Vue.component('chart-component', require('./components/Chart.vue'));