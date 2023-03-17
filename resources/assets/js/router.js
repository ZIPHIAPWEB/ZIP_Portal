import { createRouter, createWebHistory } from 'vue-router';

import LoginPage from './views/LoginPage.vue';
import RegisterPage from './views/RegisterPage.vue';

let basePath = '/portal/v2';

const routes = [
    {
        path: basePath + "/login",
        name: "login",
        component: LoginPage
    },
    {
        path: basePath + "/register",
        name: "register",
        component: RegisterPage
    }
];

const router = new createRouter({
    history: createWebHistory(),
    routes
});

export default router;