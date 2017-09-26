
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

window.Vue = require('vue');


Vue.component('ticket-description', require('./components/TicketDescription.vue'));
Vue.component('working-time-confirm', require('./components/WorkingTimeConfirm.vue'));
const app = new Vue({
    el: '#app'
});
