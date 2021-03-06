/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import router from './router';
import store from './store/index';

import Vuex from 'vuex';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Top', require('./components/Top.vue').default);
Vue.component('Commands', require('./components/Commands.vue').default);
Vue.component('Chara', require('./components/Chara.vue').default);
Vue.component('Message', require('./components/Message.vue').default);
Vue.component('Achieve', require('./components/Achieve.vue').default);
Vue.component('MyCanvas', require('./components/MyCanvas.vue').default);
Vue.component('Goal', require('./components/Goal.vue').default);
Vue.component('Game', require('./components/Game.vue').default);
Vue.component('CharaStatus', require('./components/CharaStatus.vue').default);
Vue.component('CharaFood', require('./components/CharaFood.vue').default);
Vue.component('CharaPictures', require('./components/CharaPictures.vue').default);
Vue.component('CharaFarewell', require('./components/CharaFarewell.vue').default);
Vue.component('GameOmikuji', require('./components/GameOmikuji.vue').default);
Vue.component('GameSlot', require('./components/GameSlot.vue').default);
Vue.component('GameHighAndLow', require('./components/GameHighAndLow.vue').default);
Vue.component('GameFoodShop', require('./components/GameFoodShop.vue').default);



Vue.use(Vuex);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router
});
