import axios from "axios";

export default {
  namespaced: true,
  state: {
    allTags: [],
  },
  getters: {
    ALL_TAGS(state) {
      return state.allTags;
    },
  },
  actions: {
    async submitTag({ commit , dispatch }, datag) {
      try {
        const res = await axios.post(`api/tag`, datag);
        // dispatch("getCategories");
        dispatch("getTags");
        console.log(res);
      } catch (err) {
        console.log(err);
      }
    },
    async getTags({ commit }) {
      try {
        const res = await axios.get(`api/tags`);
        commit("GET_TAGS", res.data);
        
      } catch (err) {
        console.log(err);
      }
    },

    async deleteTag({ commit , dispatch}, id) {
      try {
        await axios.delete(`api/tag/${id}`);
        dispatch("getTags");
      } catch (err) {
        console.log(err);
      }
    },
  },
  mutations: {
    GET_TAGS(state, payload) {
      state.allTags = payload;
    },
  },
};
