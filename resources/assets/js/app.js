import Vue from 'vue';

import VModal from 'vue-js-modal';
Vue.use(VModal);

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

import Layout from './Layout.vue';
import Home from './components/Home.vue';
import Classes from './components/Classes.vue';
import ClassDetails from './components/ClassDetails.vue';

const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home
    },
    {
        name: 'Classes',
        path: '/grades-tracker/classes',
        component: Classes,
        props: {errors: '??'}
    },
    {
        name: 'ClassDetails',
        path: '/grades-tracker/classes/details/:id',
        component: ClassDetails,
        props: (route) => ({classID: route.params.id}),
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});
new Vue(Vue.util.extend({ router }, Layout)).$mount('#app');