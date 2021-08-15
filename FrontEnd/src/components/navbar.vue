<template>
  <!-- dektop nav -->
  <div>
    <div class="header bg-black bg-opacity-40">

          <div class="flex align-middle items-center gap-2">
          <img src="@/assets/logo.svg" class="w-7 h-7 " alt="" srcset="" />
          <div class="font-bold text-2xl"> <span class="text-white">You</span><span class="text-blue-500">Club</span></div>
        </div>
     
  
      <div>
        <ul>
          <div class="nav  h-16 items-center ">
            <li><router-link  to="/" class="active">Home</router-link></li>
            <li><router-link to="/Community">Community</router-link></li>
            <li v-if="Admin"><router-link to="/Dashboard">Dashboard</router-link></li>
          </div>
          <div>
            <li v-if="!Auth" >
              <router-link class="" to="/login">
              <i class='bx bx-log-in-circle text-white text-2xl hover:text-blue-400 cursor-pointer'></i>
              </router-link>
            </li>
            <li v-if="Auth" >
             <i class='bx bx-log-in-circle text-white text-2xl hover:text-red-400 cursor-pointer' @click.prevent="logout()"></i>
            </li>
          </div>
        </ul>
      </div>
    </div>

    <!-- mobile menu -->

    <div class="fixed bottom-0 right-0 left-0  h-20 flex items-center bg-white md:hidden ">
      <div class="flex  w-full justify-center">
        <ul class="w-full flex justify-around items-center text-4xl list-none p-0 ">
          <li class="">
            <router-link to="/" class="active"><i class='bx bx-home shadow-xl' ></i></router-link>
          </li>
          <li>
            <router-link to="/Dashboard">
            <i class='bx bxs-dashboard text-gray-700 '>
              </i></router-link>
          </li>
          <li class="p-4 bg-gray-400 rounded-full">
            <router-link to="/Community">
            <img src="@/assets/logo.svg" class="w-14 h-14  mb-20  " alt="" srcset="" />
            </router-link>
          </li>
          <li>
            <router-link to="/Profile"><i class='bx bx-user-circle text-gray-700' ></i></router-link>
          </li>

          <li>
            <i class='bx bx-log-in-circle text-gray-700 ' @click.prevent="logout()"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { useStore } from "vuex";
import { ref, computed } from "vue";

export default {
  setup() {
    const store = useStore();

    const logout = () => {
      store.dispatch("auth/logout");
     
    };
    const Auth = computed(() => store.getters["auth/authenticated"]);
    const Admin = computed(() => store.getters["auth/Admin"]);
    const users = computed(() => store.state.auth.user?.username);

    return {
      users,
      store,
      logout,
      Admin,
      Auth
    };
  },
};
</script>
<style lang="scss">
</style>