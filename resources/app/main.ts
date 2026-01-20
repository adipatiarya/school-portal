import { createApp } from "vue";
import router from "./router";
import { PerfectScrollbarPlugin } from "vue3-perfect-scrollbar";
import "vue3-perfect-scrollbar/style.css";

import mitt from "mitt";
import "bootstrap-icons/font/bootstrap-icons.css";
import "@fortawesome/fontawesome-free/scss/fontawesome.scss";
import "@fortawesome/fontawesome-free/scss/regular.scss";
import "@fortawesome/fontawesome-free/scss/solid.scss";
import "@fortawesome/fontawesome-free/scss/brands.scss";
import "@fortawesome/fontawesome-free/scss/v4-shims.scss";

import "bootstrap";
import "./scss/vue.scss";

import App from "./app.vue";
import { createPinia } from "pinia";
import { useAuthStore } from "./stores/auth";
const emitter = mitt();

const app = createApp(App);
app.use(router);
app.use(createPinia());


useAuthStore().fetchUser();

app.config.globalProperties.emitter = emitter;
app.use(PerfectScrollbarPlugin)
app.mount("#app");
