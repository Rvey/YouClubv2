import axios from "axios";

export default {
  namespaced: true,
  state: {
    allComments: [],
    loading_newcomment: false,
    error_newcomment: null,
  },
  getters: {
    ALL_COMMENTS(state) {
      return state.allComments;
    },
    LOADING_NEWCOMMENT(state) {
      return state.loading_newcomment;
    },
    ERR_NEWCOMMENT(state) {
      return state.error_newcomment;
    },
  },
  actions: {
    async getComments({ commit }) {
      try {
        commit("SET_ERROR", null);
        const res = await axios.get(`api/comments`);
        commit("GET_COMMENTS", res.data);
        return res.data;
      } catch (err) {
        console.log(err);
      }
    },

    async submitComment({ commit, dispatch }, commentData) {
      try {
        const res = await axios.post("/api/comment", commentData);
        console.log(res);
        store.dispatch("comments/getComments");
        return commit("SET_LOADING_NEWCOMMENT(", false);
      } catch (err) {
      }
    },

    async EditComment({commit , dispatch } , comment) {
      try {
        await axios.put(`/api/comment/${comment.id}`, comment);
        return commit("SET_LOADING_NEWCOMMENT", false);
      } catch (err) {
        console.log(err);
      }
    },

    async DeleteComment({ commit }, id) {
      try {
        const res = await axios.delete(`/api/comment/${id}`);
        console.log(res);
      } catch (err) {
        console.log(err);
      }
    },
  },

  mutations: {
    GET_COMMENTS(state, payload) {
      state.allComments = payload;
    },

    SET_ERROR(state, value) {
      state.error_newcomment = value;
    },

    SET_LOADING_NEWCOMMENT(state, value) {
      state.loading_newcomment = value;
    },

    SET_CURRENT_COMMENT(state, value) {
      state.current_comment = value;
    },
  },
};
