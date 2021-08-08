import axios from "axios";

export default {
    namespaced: true,
    state: {
        allLikes : [],
    },
    getters: {
        ALL_LIKES(state) {
            return state.allLikes;
        }
    },
    actions: {
        async getLikes({ commit }) {
            try {
               const res =  await axios.get(`api/likes`);
                    
            }catch(err) {
                console.log(err.message);
            }
        },
        async submitLikes({ commit } , likesCount) {
            try {
               const res =  await axios.post(`api/like` , likesCount);
               console.log( 'result' , res.data);
            }catch(err) {
                console.log(err.message);
            }
        },
    },
    mutations:{
        GET_LIKES(state , payload) {
            state.allLikes = payload;
        }
    }
}