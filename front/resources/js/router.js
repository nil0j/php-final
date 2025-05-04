import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./Pages/Home.vue"),
    },
    {
        path: "/products",
        component: () => import("./Pages/ProductList.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
