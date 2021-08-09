<template>
  <div class="lg:overflow-hidden h-screen">
    <div
      class="text-center flex align-middle justify-center h-16 pt-4 md:h-40 lg:h-56 font-bold text-4xl"
    >
      You <span class="text-blue-500">Club</span>
    </div>
    <div class="w-screen block lg:flex   ">
      <div
        class="login sm:w-full md:w-2/3 m-auto h-screen align-middle lg:w-1/2 overflow-hidden"
      >
        <div class="card-login">
          <div class="pb-6 text-gray-700 font-extrabold text-3xl">Register</div>

          <form class="space-y-4" action="">
            <div>
              <label class="input">
                <input
                  class="input__field"
                  type="text"
                  placeholder=" "
                  v-model="userData.username"
                  required
                />
                <span class="input__label">Usename</span>
              </label>
            </div>
            <div v-if="error?.username" class="text-red-500 font-semibold">
              {{ error?.username[0] }}
            </div>

            <div>
              <label class="input">
                <input
                  class="input__field"
                  type="email"
                  placeholder=" "
                  v-model="userData.email"
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
                  v-model="userData.password"
                  required
                />
                <span class="input__label">Password</span>
              </label>
            </div>
            <transition name="fade">
              <div v-if="error?.password" class="text-red-500 font-semibold">
                {{ error?.password[0] }}
              </div>
            </transition>
            <div>
              <label class="input">
                <input
                  class="input__field"
                  type="password"
                  placeholder=" "
                  v-model="userData.password_confirmation"
                  required
                />
                <span class="input__label">Password Confirmation</span>
              </label>
            </div>
          </form>
          <div></div>

          <div class="button-group">
            <button
              class="hover:bg-blue-600 transition-all ease"
              @click.prevent="signup"
            >
              Register
            </button>
          </div>
          <div class="pt-5 font-semibold">
            Already Have an account ?
            <span
              @click="redirect"
              class="underline text-blue-400 cursor-pointer hover:text-gray-500 transition-all duration-300 ease"
              >Log in</span
            >
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

    const userData = ref({
      username: "",
      email: "",
      password: "",
      password_confirmation: "",
    });

    const error = computed(() => store.getters["auth/error"]);

    const redirect = () => {
      store.dispatch("auth/clearErr");
      return router.push({ path: "/Login" });
    };
    const signup = async () => {
      await store.dispatch("auth/signup", userData.value);

      if (!store.getters["auth/error"]) {
        return redirect();
      }
    };

    return {
      error,
      userData,
      signup,
      redirect,
    };
  },
};
</script>
