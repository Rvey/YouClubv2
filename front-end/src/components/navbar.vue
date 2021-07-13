<template>
  <!-- dektop nav -->

  <div class="header">
    <div>
      <a href="#" class="logo">user {{ user }}</a>
    </div>
    <div>
      <ul>
        <div class="nav">
          <li><a href="#" class="active">Home</a></li>
          <li><a href="#">Community</a></li>
          <li><a href="#">Dashboard</a></li>
        </div>
        <div class="conn">
          <li><router-link class="conn" to="/login">Log in</router-link></li>
          <li>
            <a class="" href="#"><i class="fas fa-sign-out-alt conn"></i></a>
          </li>
        </div>
      </ul>
    </div>
  </div>
  <Whitespace />

  <!-- mobile menu -->
  <div class="menu">
    <div class="mnav">
      <ul>
        <li>
          <a href="#" class="active"><i class="fab fa-phoenix-squadron"></i></a>
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
</template>

<script>
import Whitespace from "@/components/Misc/whitespace.vue";

import { mapGetters } from "vuex";

export default {
  components: {
    Whitespace,
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
};
</script>
<style lang="scss">
</style>