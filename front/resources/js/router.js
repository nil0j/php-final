import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/products",
        component: () => import("./Pages/ProductList.vue"),
    },
    {
        path: "/products/login",
        component: () => import("./Pages/Login.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
