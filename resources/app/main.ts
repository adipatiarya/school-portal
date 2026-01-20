import { createApp } from "vue";
import router from "./router";
import mitt from "mitt";

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
app.mount("#app");
