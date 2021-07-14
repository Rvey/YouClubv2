<template>
  <div class="container" :class="slide ? 'sign-in-mode' : 'sign-up-mode'">
    <div class="forms-container">
      <div class="signin-signup">
        <Login />

        <!-- sign up form  -->

        <Register />
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
        <img src="../assets/Saly-1.svg" class="image" alt="img" />
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
        <img src="../assets/Saly-1.svg" class="image" alt="img" />
      </div>
    </div>
  </div>
</template>
<script>
import { useStore } from "vuex";
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import Register from "./register.vue";
import Login from "./login.vue";
export default {
  components: {
    Register,
    Login,
  },
  setup() {
    const route = useRoute();
    const store = useStore();
    const slide = ref(true);
    const move = () => {
      slide.value = !slide.value;
      store.dispatch("auth/clearErr");
    };
    return {
      slide,
      move,
    };
  },
};
</script>

