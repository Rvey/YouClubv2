import axios from "axios";

export default {
  namespaced: true,
  state: {
    allMarkedPosts: [],
    loading_newMarked: false,
    error_newMarked: null,
  },
  getters: {
    ALL_MARKED(state) {
      return state.allMarkedPosts;
    },
    LOADING_NEWMARKED(state) {
      return state.loading_newMarked;
    },
    ERR_NEWMARKED(state) {
      return state.error_newMarked;
    },
  },

  actions: {
    async getMaked({ commit }) {
      try {
        commit("SET_ERROR", null);
        const res = await axios.get(`api/marked`);
        commit("GET_MARKED", res.data);
      } catch (err) {
        console.log(err);
      }
    },

    async submitMarked({ commit, dispatch }, markedData) {
      try {
        const res = await axios.post(`api/marked`, markedData);
        console.log(res);
      } catch (err) {
        console.log(err);
      }
    },

    async deleteMarked({ commit }, id) {
      try {
       const res  =  await axios.delete(`api/marked/${id}`);
        console.log(res);
        return commit("SET_LOADING_NEWMARKED", false);
      } catch (err) {
        console.log(err);
      }
    },
  },
};
