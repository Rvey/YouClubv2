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
        <a href="#">
          <i class="bx bx-home-alt"></i>
          <span class="links_name">Home</span>
        </a>
        <span class="tooltip">Home</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bx-group"></i>
          <span class="links_name">Community</span>
        </a>
        <span class="tooltip">Community</span>
      </li>

      <li>
        <a href="#">
          <i class="bx bx-category"></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
    </ul>

    <div class="profile_content">
      <div class="profile">
        <div class="profile_details">
          <img class="profile_img" src="./../assets/bg.jpg" alt="" />

          <div class="user_info">
            <div class="name">RedOne</div>
            <div class="email">redone@gmail.com</div>
          </div>
        </div>
      </div>
      <div class="logout">
        <i class="bx bx-log-in-circle"></i>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
export default {
  setup() {
    const toggle = ref(false);

    const e = () => {
      toggle.value = !toggle.value;
    };
    return {
      e,
      toggle,
    };
  },
};
</script>



<style>
i {
  color: black;
}
</style>