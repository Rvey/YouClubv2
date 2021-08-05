import axios from "axios";

export default {
  namespaced: true,
  state: {
    token: null,
    user: null,
    loading: false,
    error: null,
  },
  getters: {
    authenticated(state) {
      return state.token && state.user;
    },
    user(state) {
      return state.user;
    },
    error(state) {
      return state.error;
    },
    Admin(state) {
      return state.user?.is_Admin;
    },
    userId(state) {
      return state.user?.id;
    },
    userName(state) {
      return state.user?.username;
    }
  },
  actions: {
    async login({ commit, dispatch }, credentials) {
      try {
        commit("SET_ERROR", null);

        const res = await axios.post("/api/login", credentials);
        commit("SET_USER", res.data.user);
        console.log(res.data.token);
        commit("SET_TOKEN", res.data.token);
        // window.location.replace("/");
      } catch (err) {
        commit("SET_ERROR", err.response.data.errors);
        commit("SET_LOADING", false);
      }
    },

    async attempt({ commit, state }, token) {
      try {

        if (token) commit("SET_TOKEN", token);

        if (!state.token) return;

        const res = await axios.get("/api/user");

        console.log(res.data);

        commit("SET_USER", res.data);
        commit("SET_LOADING", false);
      } catch (err) {
        console.log(err);
        commit("SET_ERROR", err.message);
        commit("SET_TOKEN", null);
        commit("SET_USER", null);
      }
    },

    async signup({ commit, dispatch }, credentials) {
      try {
        commit("SET_ERROR", null);
        const res = await axios.post("api/signup", credentials);
        
        // return dispatch("attempt", res.data.data.token);
        // window.location.replace("/login");
      } catch (err) {
        commit("SET_ERROR", err.response.data.errors);
      }
    },

    async logout({ commit }) {
      try {
        await axios.post("/api/logout");
window.location.replace("/");
        commit("SET_USER", null);
        commit("SET_TOKEN", null);
      } catch (err) {
        commit("SET_USER", null);
        commit("SET_TOKEN", null);

        console.log(err);
      }
    },

    clearErr({ dispatch, commit }) {
      commit("SET_ERROR", null);
    },
  },
  mutations: {
    SET_TOKEN(state, token) {
      state.token = token;
    },
    SET_USER(state, user) {
      state.user = user;
    },
    SET_LOADING(state, value) {
      state.loading = value;
    },
    SET_ERROR(state, error) {
      state.error = error;
    },
  },
  modules: {},
};

// import axios from "axios";

// export default {
//   namespaced: true,
//   state: {
//     token: null,
//     user: null,
//   },

//   getters:{

//    // check auth
//    authenticated (state) {
//       return state.token && state.user
//    },

//    user (state) {
//          return state.user
//    }
//   },

//   mutations: {
//     SET_TOKEN(state, token) {
//       state.token = token;
//     },
//     SET_USER(state, data) {
//       state.user = data;
//     },
//   },
//   actions: {
//     async singIn({ dispatch }, loginform) {
//       let response = await axios.post("/login", loginform);
//       console.log(response.data.token);
//       console.log(response.data.user.fullName);

//     },

//     /**
//      attemp the auth and commit the token that we get from the singin action
//      and make request to the me end point to know if the token actually works
//      * */

//     //  async attempt({ commit }, token) {
//     //    commit("SET_TOKEN", token);

//     //    try {
//     //      if (token) commit("SET_TOKEN", token);
//     //      if (!state.token) return;
//     //      const res = await axios.get("/me");
//     //      commit("SET_USER", res.data);

//     //    } catch (err) {
//     //      console.log(err);
//     //      commit("SET_ERROR", err.message);
//     //      commit("SET_TOKEN", null);
//     //      commit("SET_USER", null);
//     //    }
//     //  },
//   },
// };
