import Vuex from 'vuex'

/** MODULES */
import auth from "./auth.js";
import post from "./post.js";
import comments from "./comments.js";
import likes from "./likes.js";
import tags from "./tags.js";
import user from "./user.js";
import bookmark from "./bookmark.js";
export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    auth,
    post,
    comments,
    user,
    tags,
    likes,
    bookmark
  },
});
