/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import User from "./components/user/User";


require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import TransactionList from "./components/transaction/TransactionList";
import Form from './components/transaction/Form'
import Transaction from './components/transaction/Transaction'
import UserList from "./components/user/UserList";

Vue.use(VueRouter)

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const router = new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            name: 'transactions',
            component: TransactionList
        },
        {
            path: '#/transactions/:transactionId',
            name: 'transactionShow',
            component: Transaction
        },
        {
            path: '#/transactions/edit/:transactionId',
            name: 'transactionEdit',
            component: Form
        },
        {
            path: '#/transactions/add',
            name: 'transactionsCreate',
            component: Form
        },
        {
            path: '#/users',
            name: 'users',
            component: UserList
        },
        {
            path: '#/user/:userId',
            name: 'userShow',
            component: User
        },

    ],
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { VueRouter },
    router,
});
