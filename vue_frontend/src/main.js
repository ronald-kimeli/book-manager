import { createApp, markRaw } from "vue";
import { createPinia } from "pinia";
import router from "./router";

import "./assets/libs/jquery/dist/jquery.min";
import "./assets/libs/bootstrap/dist/js/bootstrap.bundle.min";
import "./assets/js/sidebarmenu";
import "./assets/js/app.min";
import "./assets/libs/apexcharts/dist/apexcharts.min";
import "./assets/libs/simplebar/dist/simplebar";
import "./assets/libs/simplebar/dist/simplebar.css";
import "./assets/js/dashboard";
import "./assets/css/styles.min.css";
import App from "./App.vue";

const pinia = createPinia();

pinia.use(({ store }) => {
  store.router = markRaw(router);
});

const app = createApp(App);

app.use(pinia);
app.use(router);

app.mount("#app");
