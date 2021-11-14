import axios from "axios";
import Vue from "vue";
import Vuex from "vuex";
import Constant from "./modules/constant";

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    todoList: [],
    user: null,
  },
  mutations: {
    setUserData(state, userData) {
      state.user = userData;
      localStorage.setItem("user", JSON.stringify(userData));
      axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`;
    },

    [Constant.ADD_TODO]: (state, payload) => {
      if (payload.todo !== "") {
        localStorage.setItem(
          payload.todo,
          JSON.stringify({
            todo: payload.todo,
            done: false,
          })
        );

        state.todoList.push({
          todo: payload.todo,
          done: false,
        });
      } else {
        alert("할 일을 입력해주세요!");
      }
    },

    [Constant.DONE_TOGGLE]: (state, payload) => {
      state.todoList[payload.index].done = !state.todoList[payload.index].done;
      localStorage[payload.todo] = JSON.stringify({
        todo: payload.todo,
        done: state.todoList[payload.index].done,
      });
    },

    [Constant.DELETE_ALL]: (state) => {
      localStorage.clear();
      state.todoList = [];
    },

    [Constant.DELETE_TODO]: (state, payload) => {
      localStorage.removeItem(payload.todo);
      state.todoList.splice(payload.index, 1);
    },

    [Constant.SHOW_LIST]: (state) => {
      for (let i = 0; i < localStorage.length; i++) {
        let localKey = localStorage.key(i);
        if (localKey === "loglevel:webpack-dev-server") continue;

        state.todoList.push({
          todo: localKey,
          done: JSON.parse(localStorage[localKey]).done,
        });
      }
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.get(
          "http://localhost:8000/sanctum/csrf-cookie"
        );
        console.log(response.status);
        const { data } = await axios.post(
          "http://localhost:8000/api/login",
          credentials
        );
        commit("setUserData", data);
      } catch (err) {
        console.log(err);
      }
    },
  },
});

export default store;
