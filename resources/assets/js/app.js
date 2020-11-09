require('./bootstrap');

import Vue from 'vue';
import VueRouter from "vue-router";

window.Vue = Vue;
Vue.use(VueRouter);

import Form from "./utilities/Form";
window.Form = Form;

import router from './routes';

new Vue({
    el: '#app',
    router
});
