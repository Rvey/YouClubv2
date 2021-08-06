<template>
  <div class="sidebar" :class="toggle ? 'active' : 'not-active'">
    <div class="logo_content">
      <div class="logo">
        <i class="bx bxl-c-plus-plus icon"></i>
        <div class="logo_name">YouClub</div>
      </div>
      <i class="bx bx-menu" id="btn" @click.prevent="e"></i>
    </div>
    <ul class="nav_list">
      <li class="search">
        <input class="search" type="text" placeholder="Search..." />
        <span class="tooltip">Search</span>
      </li>
      <li class="search-btn">
        <a href="#">
          <i class="bx bx-search"></i>
          <span class="links_name">Home</span>
        </a>
        <span class="tooltip">Search</span>
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