import {createWebHistory, createRouter} from "vue-router"

const routes = [
    {
        name:   'users',
        path:   '/',
        component: () => import('../Components/AllUsers.vue')
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;