
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

window.Vue = require('vue');
window.Marked = require('marked');

Vue.component('workingticket', require('./components/WorkingTicket.vue'));
Vue.component('working-time-confirm', require('./components/WorkingTimeConfirm.vue'));
Vue.component('clean-up-select', require('./components/CleanUpSelect.vue'));
Vue.component('ticket-admin', require('./components/TicketAdmin.vue'));
const App = new Vue({
    el: '#app'
});
