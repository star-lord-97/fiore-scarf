import { createRouter, createWebHistory } from "vue-router";

import Home from "./views/Home";
import Shop from "./views/Shop";
import Product from "./views/Product";
import Cart from "./views/Cart";
import Wishlist from "./views/Wishlist";
import Login from "./views/Login";
import Register from "./views/Register";
import About from "./views/About";
import Contact from "./views/Contact";
import store from "./store";
import Admin from "./views/Admin";
import User from "./views/User";

const routes = [
    {
        path: "/",
        component: Home,
    },

    {
        path: "/shop/:category?",
        component: Shop,
    },

    {
        path: "/product/:code",
        component: Product,
    },

    {
        path: "/cart",
        component: Cart,
        meta: { userOnly: true },
    },

    {
        path: "/wishlist",
        component: Wishlist,
        meta: { userOnly: true },
    },

    {
        path: "/login",
        component: Login,
        meta: { guestOnly: true },
    },

    {
        path: "/register",
        component: Register,
        meta: { guestOnly: true },
    },

    {
        path: "/about",
        component: About,
    },

    {
        path: "/contact",
        component: Contact,
    },

    {
        path: "/admin/:page",
        component: Admin,
        meta: { adminOnly: true },
    },

    {
        path: "/user/:page",
        component: User,
        meta: { userOnly: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve({ left: 0, top: 0 });
            }, 500);
        });
    },
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.userOnly)) {
        if (!store.getters.isLoggedIn) {
            next({ path: "/login" });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.guestOnly)) {
        if (store.getters.isLoggedIn) {
            next({ path: "/" });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.adminOnly)) {
        if (!store.getters.isAdmin) {
            next({ path: "/" });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
