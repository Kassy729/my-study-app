import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Show from "../views/show.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/show/:postId",
    name: "Show",
    component: Show,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
