import { createApp } from "vue";

import App from "./js/index.vue";
import router from "./js/routes.js";
import notifications from "@kyvg/vue3-notification";
import VueCookies from "vue-cookies";

// Import full Spectre source code
import "spectre.css";

const app = createApp(App).use(router).use(notifications).use(VueCookies);

// look for laravel-cms-admin or default to body
if (document.getElementById("laravel-playbooks-admin")) {
    app.mount("#laravel-playbooks-admin");
} else {
    app.mount("body");
}
