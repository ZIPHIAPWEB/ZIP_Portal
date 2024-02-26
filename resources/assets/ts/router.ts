import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import { useAuthStore } from './store/auth';

import LoginPage from './views/LoginPage.vue';
import RegisterPage from './views/RegisterPage.vue';
import ForgotPasswordPage from './views/ForgotPasswordPage.vue';
import ResetPasswordPage from './views/ResetPasswordPage.vue';
import EmailVerificationPage from './views/client/EmailVerificationPage.vue';
import ApplicationFormPage from './views/client/ApplicationFormPage.vue';
import StudentDashboardPage from './views/client/DashboardPage.vue';
import CoordinatorDashboardPage from './views/coordinator/DashboardPage.vue';
import CoordinatorAdminStopperPage from './views/coordinator/AdminStopperPage.vue';
import CoordinatorProgramPage from './views/coordinator/ProgramPage.vue';
import SelectedStudentPageVue from './views/coordinator/SelectedStudentPage.vue';
import SuperadminDashboardPage from './views/superadmin/DashboardPage.vue';
import SuperadminStudentPage from './views/superadmin/StudentPage.vue';
import SuperadminCoordPage from './views/superadmin/CoordinatorPage.vue';
import SuperadminProgramPage from './views/superadmin/settings/ProgramPage.vue';
import SuperadminProgramCategoryPage from './views/superadmin/settings/ProgramCategory.vue';
import SuperadminVisaSponsorPage from './views/superadmin/settings/VisaSponsorPage.vue';

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
        path: basePath + "/forgot-password",
        name: "forgot-password",
        component: ForgotPasswordPage
    },
    {
        path: basePath + "/email-verification",
        name: "email-verification",
        component: EmailVerificationPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/reset-password-form/:token",
        name: "reset-password",
        component: ResetPasswordPage,
        meta: {
            requiresAuth: false
        }
    },
    {
        path: basePath + "/application-form",
        name: "application-form",
        component: ApplicationFormPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/sa/dashboard",
        name: "superadmin-dashboard",
        component: SuperadminDashboardPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/student/dashboard",
        name: "student-dashboard",
        component: StudentDashboardPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/coord/dashboard",
        name: "coordinator-dashboard",
        component: CoordinatorDashboardPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/coord/admin-verification",
        name: "coordinator-admin-veriff",
        component: CoordinatorAdminStopperPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/coord/program/:name",
        name: "coordinator-program",
        component: CoordinatorProgramPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/coord/student-profile/:id",
        name: "coordinator-student-profile",
        component: SelectedStudentPageVue,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/sa/students",
        name: "superadmin-student-lists",
        component: SuperadminStudentPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/sa/coordinators",
        name: "superadmin-coords-lists",
        component: SuperadminCoordPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: basePath + "/sa/programs",
        name: "superadmin-coords-programs",
        component: SuperadminProgramPage
    },
    {
        path: basePath + "/sa/program-categories",
        name: "superadmin-program-categories",
        component: SuperadminProgramCategoryPage
    },
    {
        path: basePath + "/sa/visa-sponsors",
        name: "superadmin-visa-sponsor",
        component: SuperadminVisaSponsorPage
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();

    if (to.meta.requiresAuth && !authStore.getIsAuthenticate && to.name !== 'login') {

        next({ name: 'login'});
    } else {

        if(authStore.getAuthRole == 'superadmin') {
            
            if (authStore.getIsAuthenticate && (to.name == 'login' || to.name == 'register') ) {

                next({ name: 'superadmin-dashboard'});
            }
        }
        
        if(authStore.getAuthRole == 'student') {

            if (authStore.getIsAuthenticate && authStore.getIsVerified && authStore.getIsFilled && (to.name == 'login' || to.name == 'register') ) {

                next({ name: 'student-dashboard'});

                return;
            }
            
            if (authStore.getIsAuthenticate && !authStore.getIsVerified && !authStore.getIsFilled && to.name !== 'email-verification') {

                next({ name: 'email-verification'});

                return;
            } 
    
            if (authStore.getIsAuthenticate && !authStore.getIsFilled && authStore.getIsVerified && to.name !== 'application-form') {
    
                next({ name: 'application-form'});

                return;
            }
        }

        if (authStore.getAuthRole == 'coordinator' || authStore.getAuthRole == 'accounting') {

            if (authStore.getIsAuthenticate && authStore.getIsVerified && (to.name == 'login' || to.name == 'register')) {

                next({ name: 'coordinator-dashboard' });
            } 

            if (authStore.getIsAuthenticate && !authStore.getIsVerified && to.name !== 'coordinator-admin-veriff') {

                next({ name: 'coordinator-admin-veriff' });
            } 
        }

        next();
    }
})

export default router;