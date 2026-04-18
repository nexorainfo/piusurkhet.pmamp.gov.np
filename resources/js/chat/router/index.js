import {createRouter, createWebHistory} from "vue-router";
import store from "../store"

const routes = [
    {
        path: '/admin/chat/login',
        name: 'Login',
        meta: {isGuest: true},
        component: () => import('../views/Login.vue')
    },
    {
        path: '/admin/chat',
        name: 'ChatIndex',
        meta: {requiresAuth: true},
        component: () => import('../views/Chat.vue')
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.access_token) {
        next({name: "Login"});
    } else if (store.state.user.access_token && to.meta.isGuest) {
        next({name: "ChatIndex"});
    } else {
        next();
    }
});

export default router
