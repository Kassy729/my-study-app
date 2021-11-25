import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Show from "../views/show.vue";
import Update from "../views/edit.vue";
import Register from "../views/register.vue";
import Login from "../views/login.vue";
import TodoList from "../views/todoList.vue";

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
  {
    path: "/update/:postId",
    name: "Update",
    component: Update,
  },
  {
    path: "/todoList",
    name: "TodoList",
    component: TodoList,
  },
  {
    path: "/register",
    name: "Register",
    component: Register,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
