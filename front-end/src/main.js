require("./bootstap");

import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import scss from "./styles/main.scss";

require("./store/subscriber");

store.dispatch("auth/attempt", localStorage.getItem("token")).then(() => {
  createApp(App)
    .use(store)
    .use(router)
    .use(scss)
    .mount("#app");
});
