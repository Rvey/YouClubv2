imoprt axios from 'axios'

export default {
  state: {
    token: null,
    user: null,
  },
  mutations: {

  },
  actions: {
      async singIn () {
         const response = axios.post('auth/singin' , this.form)
         console.log(response.data);
      }
  },
};
