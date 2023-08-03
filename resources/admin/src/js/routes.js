import { createWebHashHistory, createRouter } from "vue-router";

import Playbook from "./components/playbook/index.vue";
import Playbooks from "./components/playbooks/index.vue";
import Trigger from "./components/trigger/index.vue";
import Triggers from "./components/triggers/index.vue";

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
    {
        path: "/playbooks/:id",
        name: "Playbook",
        component: Playbook,
        props: (route) => ({ id: parseInt(route.params.id) }),
    },
    {
        path: "/triggers",
        name: "Triggers",
        component: Triggers,
    },
    {
        path: "/triggers/:className",
        name: "Trigger",
        component: Trigger,
        props: (route) => ({ className: route.params.className }),
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;
