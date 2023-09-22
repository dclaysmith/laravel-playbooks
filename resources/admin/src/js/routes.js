import { createWebHashHistory, createRouter } from "vue-router";

import Playbook from "./components/playbook/index.vue";
import Playbooks from "./components/playbooks/index.vue";
import Audience from "./components/audience/index.vue";
import Audiences from "./components/audiences/index.vue";
import Conditions from "./components/conditions/index.vue";

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
    path: "/audiences",
    name: "Audiences",
    component: Audiences,
  },
  {
    path: "/audiences/:className",
    name: "Audience",
    component: Audience,
    props: (route) => ({ className: route.params.className }),
  },
  {
    path: "/conditions",
    name: "Conditions",
    component: Conditions,
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
