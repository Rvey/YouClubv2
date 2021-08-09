<template>
<div class="overflow-hidden h-screen">
<div class="text-center flex align-middle justify-center  h-16 pt-4 md:h-40 lg:h-56 font-bold text-4xl">
  You <span class="text-blue-500">Club</span> 
</div>
<div class="w-full ">
  <div class="login sm:w-full md:w-2/3 mx-auto lg:w-1/2">
    <div class="card-login">
      <div class="pb-6 text-gray-700 font-extrabold text-3xl">Login</div>

      <form class="space-y-4" >
        <div>
          <label class="input">
            <input
              class="input__field"
              type="email"
              placeholder=" "
              v-model="loginform.email"
              required
            />
            <span class="input__label">Email</span>
          </label>
        </div>
        <transition name="fade">
          <div v-if="error?.email" class="text-red-500 font-semibold">
            {{ error?.email[0] }}
          </div>
        </transition>

        <div>
          <label class="input">
            <input
              class="input__field"
              type="password"
              placeholder=" "
              v-model="loginform.password"
              required
            />
            <span class="input__label">Password</span>
          </label>
        </div>
        <transition name="fade">
          <div v-if="error?.password" class="text-red-500 font-semibold">
            {{ error.password[0] }}
          </div>
        </transition>
      </form>
      <div></div>

      <div class="button-group">
        <button
          class="hover:bg-blue-600 transition-all ease"
          @click.prevent="login"
        >
          Login
        </button>
      </div>
      <div class="pt-5 font-semibold">
        Dont Have account ?
        <span @click="redirect" class="underline text-blue-400 cursor-pointer hover:text-gray-500 transition-all duration-300 ease" >Create account</span>
      </div>
    </div>
  </div>
  </div>
</div>
</template>
<script>
import { useStore } from "vuex";
import { ref, computed } from "vue";
import { useRouter } from "vue-router";
export default {
  setup() {
    const store = useStore();
    const router = useRouter();

    const loginform = ref({ email: "", password: "" });

    const error = computed(() => store.getters["auth/error"]);

     const redirect = () => {
      store.dispatch("auth/clearErr");
      return router.push({ path: "/Register" });

    }

    const login = async () => {
      await store.dispatch("auth/login", loginform.value);
      if (store.getters["auth/authenticated"]) {
        return router.push({ path: "/" });
      }
    };

    return {
      loginform,
      error,
      login,
      redirect
    };
  },
};
</script>
