import axios from "axios";
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import scss from "./styles/main.scss";

createApp(App)
  .use(store)
  .use(router)
  .use(scss)
  .mount("#app");

axios.defaults.baseURL = "http://127.0.0.1:8000/";
