<template>
  <div class="sidebar hidden md:flex items-center" :class="toggle ? 'active' : 'not-active' ">
    <div class="logo_content">
      <div class="logo space-x-7 justify-center">
        <img src="@/assets/logo.svg" @click.prevent="e" class="w-8 h-8 cursor-pointer" alt="">
        <div class="logo_name">YouClub</div>
      </div>
    </div>
    <ul class="nav_list">
      <li>

      <!-- <i class="bx bx-menu" id="btn" ></i> -->
      </li>
      <li>
        <router-link to="/">
          <i class="bx bx-home-alt"></i>
          <span class="links_name">Home</span>
        </router-link>
        <span class="tooltip">Home</span>
      </li>
      <li>
        <router-link to="/Community">
          <i class="bx bx-group"></i>
          <span class="links_name">Community</span>
        </router-link>
        <span class="tooltip">Community</span>
      </li>
         <li>
        <router-link to="/Profile">
          <i class="bx bx-user"></i>
          <span class="links_name">Profile</span>
        </router-link>
        <span class="tooltip">Profile</span>
      </li>

      <li  v-if=" Admin ">
        <router-link to="/Dashboard">
          <i class="bx bx-category"></i>
          <span class="links_name">Dashboard</span>
        </router-link>
        <span class="tooltip">Dashboard</span>
      </li>
    </ul>

    <div v-if="Auth" class="profile_content">
      <div class="profile">
        <div class="profile_details">
          <img class="profile_img" src="./../assets/bg.jpg" alt="" />

          <div class="user_info">
            <div class="name">{{ user }}</div>
            <div class="email">{{ email }}</div>
          </div>
        </div>
      </div>
      <div class="logout">
        <i class="bx bx-log-in-circle" @click.prevent="logout"></i>
      </div>
    </div>
  </div>
</template>

<script>
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { ref, computed } from "vue";
export default {
  setup() {
    const router = useRouter();
    const store = useStore();

    const toggle = ref(false);

    const logout = () => {
      if (store.dispatch("auth/logout")) {
        return router.push({ path: "Login" });
      }
    };

    const Auth = computed(() => store.getters["auth/authenticated"]);
    const Admin = computed(() => store.getters["auth/Admin"]);
    const user = computed(() => store.state.auth.user?.username);
    const email = computed(() => store.state.auth.user?.email);
    const userId = computed(() => store.getters["auth/userId"]);
    const e = () => {
      toggle.value = !toggle.value;
    };
    return {
      e,
      user,
      logout,
      toggle,
      email,
      Admin,
      userId,
      Auth
    };
  },
};
</script>



<style>
i {
  color: black;
}
</style>