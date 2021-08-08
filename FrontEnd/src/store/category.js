import axios from "axios";

export default {
  namespaced: true,

  state: {
    allCategories: [],
  },
  getters: {
    ALL_CATEGORIES(state) {
      return state.allCategories;
    },
  },

  actions: {
    async getCategories({ commit }) {
      try {
        const res = await axios.get(`api/categories`);
        commit("GET_CATEGORIES", res.data);
      } catch (err) {
        console.log(err);
      }
    },

    async deleteCategories({ commit }, id) {
      try {
        await axios.delete(`api/category/${id}`);
        dispatch('getCategories');
      } catch (err) {
        console.log(err);
      }
    },
  },
  mutations: {
    GET_CATEGORIES(state, payload) {
      state.allcategories = payload;
    },
  },
};
