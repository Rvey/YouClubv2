import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Community from "../views/Community.vue";
import Dashboard from "../views/Dashboard.vue";
import BlogPage from "../views/BlogPage.vue";
const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/Community",
    name: "Community",
    component: Community,
    props: true 
  },
  {
    path: "/Dashboard",
    name: "Dashboard",
    component: Dashboard,
  },
  {
    path: "/BlogPage",
    name: "BlogPage",
    component: BlogPage,
    props: true 
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
