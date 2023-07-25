import { createWebHashHistory, createRouter } from "vue-router";

import Playbooks from "./components/playbooks/index.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Playbooks,
    },
    {
        path: "/playbooks",
        name: "Playbooks",
        component: Playbooks,
    },
    // {
    //     path: "/playbooks/:id",
    //     name: "Playbook",
    //     component: Playbook,
    //     props: (route) => ({ id: parseInt(route.params.id) }),
    // },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;
