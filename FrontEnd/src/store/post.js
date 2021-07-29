import axios from "axios";

export default {
  namespaced: true,
  state: {
    allPosts: [],
    loading_newpost: false,
    error_newpost: null,
  },
  getters: {
    ALL_POSTS(state) {
      return state.allPosts;
    },
    LOADING_NEWPOST(state) {
      return state.loading_newpost;
    },
    ERR_NEWPOST(state) {
      return state.error_newpost;
    },
    CURRENT_POST(state) {
      return state.current_post
    }
  },
  actions: {
    async getPosts({ commit }) {
      try {
        commit("SET_ERROR", null);
        const res = await axios.get(`api/posts`);
        commit("GET_POSTS", res.data);
        console.log(res.data);
      } catch (err) {
        console.log(err);
      }
    },


    async single ({commit } ,id){
      try {
        const res = await axios.get(`/api/post/${id}` );
        commit("SET_LOADING_NEWPOST" , false);
  
        return commit ("SET_CURRENT_POST", res.data)
      }catch (err){
        commit("SET_ERROR_NEWPOST" , err.message);
      }
    },

    async submitPost({ commit, dispatch }, postData) {
      try {
        commit("SET_LOADING_NEWPOST", true);
        commit("SET_ERROR_NEWPOST", null);

        const res = await axios.post("/api/post", postData);
        console.log(res.data);
        return commit("SET_LOADING_NEWPOST", false);
      } catch (err) {
        // commit("SET_LOADING_NEWPOST", false);
        commit("SET_ERROR_NEWPOST", err.message);
      }
    },
    async editPost({commit}, post) {
      try {
        await axios.put(`/api/post/${post.id}` , post);
        return commit("SET_LOADING_NEWPOST", false);
      } catch (err) {
        console.log(err);
      }
    },

    async deletePost({commit}, id) {
      try {
       
        await axios.delete(`/api/post/${id}`);
        // return commit ('DELETE_POST , id');
      } catch (err) {
        console.log(err);
      }
    },
    // async submitComment({ commit }, commentData) {
    //   try {
    //     await axios.post("/api/comment", commentData);
    //     return true;
    //   } catch (err) {
    //     console.log(err);
    //   }
    // },

   
  },
  mutations: {
    GET_POSTS(state, payload) {
      state.allPosts = payload;
    },
    // DELETE_POST (state , id) {
    //   index = state.post.findIndex(post => post.id == id)
    //   state.post.splice(index , 1)
    // },
   
    SET_ERROR(state, value) {
      state.error_newpost = value;
    },
    SET_LOADING_NEWPOST(state, value) {
      state.loading_newpost = value;
    },
    SET_CURRENT_POST(state, value) {
      state.current_post = value;
    }
  },
};
