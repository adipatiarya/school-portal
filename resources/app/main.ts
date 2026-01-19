import { createApp } from 'vue';
import router from './router';
import 'bootstrap';
import './scss/vue.scss';



import App from "./app.vue";

const app = createApp(App);
app.use(router);

app.mount('#app');
