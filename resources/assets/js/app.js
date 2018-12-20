
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');


window.Vue = require('vue');

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

Vue.use(require('vue-chat-scroll')) // https://www.npmjs.com/package/vue-chat-scroll

window.Noty  = require('noty');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.moment = require('moment');
 moment().format();

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('spinner1', require('./components/spinner1.vue'));
Vue.component('spinner2', require('./components/spinner2.vue'));
Vue.component('spinner3', require('./components/spinner3.vue'));
Vue.component('v-select', require('./components/select.vue'));
Vue.component('notification', require('./components/notification.vue'));
Vue.component('image-view', require('./components/image-view.vue'));
// Vue.component('card2', require('./components/card2.vue'));


import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: false
});

const app = new Vue({
    el: '#app'
});
