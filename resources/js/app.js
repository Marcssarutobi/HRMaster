import './bootstrap';

import { createApp } from 'vue';
import { createRouter, createWebHashHistory } from 'vue-router';

import App from './components/App.vue'

const app = createApp({})

app.component('app', App);

const routes = [
    {
        path: '/',
        component: ()=>import('./components/accueil.vue')
    },
    {
        path: '/dep',
        component: ()=>import('./components/depart.vue')
    },
    {
        path: '/poste',
        component: ()=>import('./components/poste.vue')
    },
    {
        path: '/employer',
        component: ()=>import('./components/employer.vue')
    },
    {
        path: '/depart',
        component: ()=>import('./components/depart.vue')
    }
]
const router = createRouter({
    history: createWebHashHistory(),
    routes
})



app.use(router)

app.mount('#app')