<template>
  <div class="container" :class="slide ? 'sign-in-mode' : 'sign-up-mode'">
    <div class="forms-container">
      <div class="signin-signup">
        <form @submit.prevent="login" action="#" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input v-model="loginform.email" type="email" placeholder="Email" />
          </div>
          <div class="error">{{ error?.email[0] }}</div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input
              v-model="loginform.password"
              type="password"
              placeholder="Password"
            />
          </div>
          <div class="error">{{ error?.password[0] }}</div>
          <h1>sdfsdf {{ authenticated }}</h1>
          <input type="submit" value="Login" class="btn solid" />
        </form>

        <!-- sign up form  -->

        <form @submit.prevent="signup" action="#" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input
              v-model="userData.fullName"
              type="text"
              placeholder="fullName"
            />
          </div>

          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input v-model="userData.email" type="email" placeholder="Email" />
          </div>
          <div v-if="error?.email" class="error">{{ error.email[0] }}</div>

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
          <input type="submit" class="btn" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
            ex ratione. Aliquid!
          </p>
          <button @click.prevent="move" class="btn transparent">Sign up</button>
        </div>
        <img src="../assets/Saly-1.svg" class="image" alt="dfghdfgh" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
            laboriosam ad deleniti.
          </p>
          <button @click.prevent="move" class="btn transparent">Sign in</button>
        </div>
        <img src="../assets/Saly-1.svg" class="image" alt="gfhdfgh" />
      </div>
    </div>
  </div>

  gsdfgsdfg {{ user }}
</template>
<script>
import { useStore } from "vuex";
import { ref, computed } from "vue";

export default {
  setup() {
    const store = useStore();
    const userData = ref({
      fullName: "",
      email: "",
      password: "",
      password_confirmation: "",
    });

    const slide = ref(true);

    const loginform = ref({ email: "", password: "" });
    // const user = computed(() => store.getters["auth/user"]);
    const error = computed(() => store.state.auth.error);
    // const user = computed(() => store.state.auth.user);
    const user = computed(() => store.state.auth.user?.fullName);

    const login = () => {
      store.dispatch("auth/login", loginform.value);
    };
    const signup = () => {
      store.dispatch("auth/signup", userData.value);
    };

    const move = () => {
      slide.value = !slide.value;
      store.dispatch("auth/clearErr");
    };

    return {
      loginform,
      error,
      user,
      userData,
      slide,
      move,
      signup,
      login,
    };
  },
};
</script>

