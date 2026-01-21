import { createApp } from "vue";
import router from "./router";
import { PerfectScrollbarPlugin } from "vue3-perfect-scrollbar";
import i18n from "./i18n";
import "vue3-perfect-scrollbar/style.css";

import mitt from "mitt";
import "bootstrap-icons/font/bootstrap-icons.css";
import "@fortawesome/fontawesome-free/scss/fontawesome.scss";
import "@fortawesome/fontawesome-free/scss/regular.scss";
import "@fortawesome/fontawesome-free/scss/solid.scss";
import "@fortawesome/fontawesome-free/scss/brands.scss";
import "@fortawesome/fontawesome-free/scss/v4-shims.scss";

import Panel from "@/components/bootstrap/Panel.vue";
import PanelBody from "@/components/bootstrap/PanelBody.vue";
import PanelHeader from "@/components/bootstrap/PanelHeader.vue";
import PanelTitle from "@/components/bootstrap/PanelTitle.vue";
import PanelFooter from "@/components/bootstrap/PanelFooter.vue";
import PanelToolbar from "@/components/bootstrap/PanelToolbar.vue";

import "bootstrap";
import "./scss/vue.scss";

import App from "./app.vue";
import { createPinia } from "pinia";
import { useAuthStore } from "./stores/auth";
const emitter = mitt();

const app = createApp(App);
app.component("Panel", Panel);
app.component("PanelBody", PanelBody);
app.component("PanelHeader", PanelHeader);
app.component("PanelFooter", PanelFooter);
app.component("PanelToolbar", PanelToolbar);
app.component("PanelTitle", PanelTitle);
app.use(router);
app.use(createPinia());

useAuthStore().fetchUser();

app.config.globalProperties.emitter = emitter;
app.use(PerfectScrollbarPlugin);
app.use(i18n);

app.mount("#app");
