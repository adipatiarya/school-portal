import { createApp } from "vue";
import router from "./router";

import "bootstrap";
import "./scss/vue.scss";

import App from "./app.vue";
import { createPinia } from "pinia";

const app = createApp(App);
app.use(router);
app.use(createPinia());

app.mount("#app");
