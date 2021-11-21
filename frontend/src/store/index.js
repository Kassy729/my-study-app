import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

import Constant from "./modules/constant";
import auth from "./modules/auth";
import axios from "axios";

const store = new Vuex.Store({
  modules: {
    Constant: Constant,
    auth,
  },
  state: {
    todoList: [],
  },
  mutations: {
    [Constant.ADD_TODO]: (state, payload) => {
      if (payload.todo !== "") {
        localStorage.setItem(
          payload.todo,
          JSON.stringify({
            todo: payload.todo,
            done: false,
          })
        );

        const form = new FormData();
        form.append("todo", payload.todo);
        form.append("user_id", auth.state.user.user.id);
        axios
          .post("/api/todo", form)
          .then((res) => {
            console.log(res.data);
          })
          .catch((err) => {
            console.log(err);
          });

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
      // axios
      //   .delete("/api/todo")
      //   .then(() => {})
      //   .catch((err) => {
      //     console.log(err);
      //   });
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
});

export default store;
