import axios from "axios";

export default {
  namespaced: true,
  state: {
    allUsers: [],
    loading_newusers: false,
    error_newusers: null,
  },

  getters: {
    ALL_USERS(state) {
      return state.allUsers;
    },
    LOADING_NEWUSER(state) {
      return state.loading_newusers;
    },
    ERR_NEWUSER(state) {
      return state.error_newusers;
    },
  },

  actions: {
    async getUsers({ commit }) {
      try {
        commit("SET_ERROR", null);
        const res = await axios.get(`api/users`);
        commit("GET_USERS", res.data);
      } catch (err) {
        console.log(err);
      }
    },

    async DeleteUser({commit} , id) {
      try{
      await axios.delete(`api/user/${id}`);
        
      }catch(err) {
        console.log(err);
      }
    },
    async editUser({ commit } , userData ){
      try{
       const res =  await axios.put(`/api/user/${userData.id}` , userData)
       console.log(res);
      }catch(err){
        console.log(err);
      }
    }
  },

  mutations: {
    GET_USERS(state, payload) {
      state.allUsers = payload;
    },
    SET_ERROR(state, value) {
      state.error_newusers = value;
    },

    SET_LOADING_NEWCOMMENT(state, value) {
      state.loading_newusers = value;
    },
  },
};
