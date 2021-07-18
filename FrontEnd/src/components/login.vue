<template>
  <form @submit.prevent="login" action="#" class="sign-in-form">
    <h2 class="title">Sign in</h2>
    <div class="input-field">
      <i class="fas fa-user"></i>
      <input v-model="loginform.email" type="text" placeholder="Email" required/>
    </div>
    <div v-if="error?.email" class="error">{{ error?.email[0] }}</div>
    <div class="input-field">
      <i class="fas fa-lock"></i>
      <input
        v-model="loginform.password"
        type="password"
        placeholder="Password"
        required
      />
    </div>
    <div v-if="error?.password" class="error">
      {{ error?.password[0] }}
    </div>
    <input type="submit" value="Login" class="btn solid" />
  </form>
</template>
<script>
import { useStore } from "vuex";
import { ref, computed } from "vue";
import { useRouter } from "vue-router";
export default {
  setup() {
    const store = useStore();
    const router = useRouter();

    const userData = ref({
      username: "",
      email: "",
      password: "",
      password_confirmation: "",
    });

    const loginform = ref({ email: "", password: "" });

    const error = computed(() => store.getters["auth/error"]);

    const login = async () => {
      await store.dispatch("auth/login", loginform.value);
      if (store.getters["auth/authenticated"]) {
        return router.push({ path: "/" });
      }
    };

    return {
      loginform,
      error,
      // user,
      userData,
      login,
    };
  },
};
</script>

