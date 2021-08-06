<template>
  <!-- dektop nav -->
  <div>
    <div class="header">
      <div class="logo">
        <h1>YouClub</h1>
      </div>
      <div>
        <ul>
          <div class="nav">
            <li><a href="#" class="active">Home</a></li>
            <li><router-link to="/Community">Community</router-link></li>
            <li v-if="Admin"><router-link to="/Dashboard">Dashboard</router-link></li>
          </div>
          <div v-if="Auth" class="conn">
            <li >
              <router-link class="conn" to="/login">Log in</router-link>
            </li>
            <li >
              <i class="fas fa-sign-out-alt conn" @click.prevent="logout()"></i>
            </li>
          </div>
        </ul>
      </div>
    </div>

    <!-- mobile menu -->

    <div class="menu">
      <div class="mnav">
        <ul>
          <li>
            <a href="#" class="active"
              ><i class="fab fa-phoenix-squadron"></i
            ></a>
          </li>
          <li>
            <a href="#"><i class="fas fa-satellite-dish"></i></a>
          </li>
          <li><i class="fab fa-phoenix-squadron logo"></i></li>
          <li>
            <a href="#"><i class="fas fa-user"></i></a>
          </li>

          <li>
            <a class="" href="#"><i class="fas fa-sign-out-alt"></i></a>
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