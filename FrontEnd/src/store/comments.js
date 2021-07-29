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

    async submitComment({ commit }, commentData) {
      try {
        await axios.post("/api/comment", commentData);
        return true;
      } catch (err) {
        console.log(err);
      }
    },
  },
};
