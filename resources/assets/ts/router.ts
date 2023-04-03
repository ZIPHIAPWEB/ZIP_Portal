import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';

import LoginPage from './views/LoginPage.vue';
import RegisterPage from './views/RegisterPage.vue';
import EmailVerificationPage from './views/client/EmailVerificationPage.vue';
import ApplicationFormPage from './views/client/ApplicationFormPage.vue';
import StudentDashboardPage from './views/client/DashboardPage.vue';

let basePath = '/portal/v2';

let routes:Array<RouteRecordRaw> = [
    {
        path: basePath + "/login",
        name: "login",
        component: LoginPage
    },
    {
        path: basePath + "/register",
        name: "register",
        component: RegisterPage
    },
    {
        path: basePath + "/email-verification",
        name: "email-verification",
        component: EmailVerificationPage
    },
    {
        path: basePath + "/application-form",
        name: "application-form",
        component: ApplicationFormPage
    },
    {
        path: basePath + "/student/dashboard",
        name: "student-dashboard",
        component: StudentDashboardPage
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;