<template>
  <div class="container" :class="slide ? 'sign-in-mode' : 'sign-up-mode'">
    <div class="forms-container">
      <div class="signin-signup">
        <Login/>

        <!-- sign up form  -->

        <form @submit.prevent="signup" action="#" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input v-model="userData.username" type="text" placeholder="Username" required/>
          </div>

          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input v-model="userData.email" type="email" placeholder="Email" required/>
          </div>
          <div v-if="error?.email" class="error">{{ error?.email[0] }}</div>

          <!-- password email -->

          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input
                v-model="userData.password"
                type="password"
                placeholder="Password"
                required
            />
          </div>
          <div v-if="error?.password" class="error">
            {{ error?.password[0] }}
          </div>

          <!--  password consfirmation -->

          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input
                v-model="userData.password_confirmation"
                type="password"
                placeholder="Cornfirm Password"
                required
            />
          </div>
          <input type="submit" class="btn" value="Sign up"/>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
           
          </p>
          <button @click.prevent="move" class="btn transparent">Sign up</button>
        </div>
        <img src="" class="image" alt=""/>
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
           
          </p>
          <button @click.prevent="move" class="btn transparent">Sign in</button>
        </div>
        <img src="" class="image" alt=""/>
      </div>
    </div>
  </div>
</template>
<script>
import {useStore} from "vuex";
import {computed, ref} from "vue";
import { useRouter} from "vue-router";
import Register from "./register.vue";
import Login from "./login.vue";


export default {
  components: {
    Register,
    Login,
  },
  setup() {
    const router = useRouter();
    const store = useStore();
    const slide = ref(true);
    const move = () => {
      slide.value = !slide.value;
      store.dispatch("auth/clearErr");
    };
      const userData = ref({
        username: "",
        email: "",
        password: "",
        password_confirmation: "",
      });

      const error = computed(() => store.getters["auth/error"]);
      const signup = () => {
        if (store.dispatch("auth/signup", userData.value)) {
          // return router.push({path: "/Login"});
           return move();
        }
        console.log("wrong");
      };

      return {
        error,
        userData,
        signup,
        slide,
        move
      };
  },
};
</script>

