import Vuex from 'vuex'

/** MODULES */
import auth from "./auth.js";
import post from "./post.js";
import comments from "./comments.js";
export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    auth,
    post,
    comments
  },
});
