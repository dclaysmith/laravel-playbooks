import { createWebHashHistory, createRouter } from "vue-router";

import Pages from "./components/pages/index.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Pages,
    },
    {
        path: "/pages",
        name: "Pages",
        component: Pages,
    },
    // {
    //     path: "/pages/:id",
    //     name: "Page",
    //     component: Page,
    //     props: (route) => ({ id: parseInt(route.params.id) }),
    // },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;
