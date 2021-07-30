import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store/index';
import Index from './pages/index';

Vue.use(VueRouter);

const routes = [
    { path: '/home', component: Index }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;