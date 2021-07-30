import axios from "axios";

export default {
  namespaced: true,
  state: {
    allComments: [],
    loading_newcomment: false,
    error_newpost: null,
  },
  getters: {
    ALL_COMMENTS(stats) {
      return state.allComments;
    },
    LOADING_NEWPOST(state) {
      return state.loading_newpost;
    },
    ERR_NEWPOST(state) {
      return state.error_newpost;
    },
  },
  actions: {
    async getComments({ commit }) {
      try {
        commit("SET_ERROR", null);
        const res = await axios.get(`api/comments`);
        commit("GET_COMMENTS", res.data);
      } catch (err) {
        console.log(err);
      }
    },

    async submitComment({ commit, dispatch }, commentData) {
      try {
        const res = await axios.post("/api/comment", commentData);
        console.log(res);
        return commit("SET_LOADING_NEWCOMMENT(", false);
     
      } catch (err) {
        console.log( 'sdfsdfsf' ,err);
      }
    },
  },

  mutations: {
    SET_ERROR(state, value) {
      state.error_newcomment = value;
    },

    SET_LOADING_NEWCOMMENT(state, value) {
      state.loading_newcomment = value;
    },

    SET_CURRENT_POST(state, value) {
      state.current_comment = value;
    },
  },
};
