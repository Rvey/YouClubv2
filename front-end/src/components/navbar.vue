<template>
  <!-- dektop nav -->
  <div>
    <div class="header">
      <div>
        <a href="#" class="logo">Logo</a>
      </div>
      <div>
        <ul>
          <div class="nav">
            <li><a href="#" class="active">Home</a></li>
            <li><router-link to="/Community">Community</router-link></li>
            <li><a href="#">Dashboard</a></li>
          </div>
          <div class="conn">
            <li>
              <router-link class="conn" to="/login">Log in</router-link>
            </li>
            <li>
              <a class="" href="#"
                ><i
                  class="fas fa-sign-out-alt conn"
                  @click.prevent="logout()"
                ></i
              ></a>
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
    <h1>username {{ users }}</h1>
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
      console.log("dasda");
    };

    const users = computed(() => store.state.auth.user?.username);

    return {
      users,
      store,
      logout,
    };
  },
};
</script>
<style lang="scss">
</style>