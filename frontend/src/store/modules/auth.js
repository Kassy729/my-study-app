import axios from "axios";

const auth = {
  namespaced: true,
  state: {
    user: null,
  },
  mutations: {
    setUserData(state, userData) {
      state.user = userData;
      localStorage.setItem("user", JSON.stringify(userData));
      axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`;
    },

    clearUserData(state) {
      state.user = null;
      localStorage.removeItem("user");
      location.reload();
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const { data } = await axios.post(
          "http://35.76.24.183:8000/api/login",
          credentials
        );

        commit("setUserData", data);
      } catch (err) {
        console.log(err);
      }
    },
    logout({ commit }) {
      axios.post("http://35.76.24.183:8000/api/logout").then((res) => {
        console.log(res.data);
      });
      commit("clearUserData");
    },
  },
};

export default auth;
