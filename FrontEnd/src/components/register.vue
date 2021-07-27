<template>
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
    <input type="submit" class="btn" value="Sign up" />
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

    const error = computed(() => store.getters["auth/error"]);
    const signup = () => {
      if (store.dispatch("auth/signup", userData.value)) {
        return router.push({ path: "/Login" });
      }
      console.log("wrong");
    };

    return {
      error,
      userData,
      signup,
    };
  },
};
</script>

