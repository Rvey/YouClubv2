<template>
  <Sidebar />
  <MobileNav />
  <Profile />
</template>
<script>
import Sidebar from "@/components/sidebar.vue";
import MobileNav from "@/components/mobilenav.vue";
import Profile from "@/components/profile.vue";
export default {
  components: {
    Profile,
    MobileNav,
    Sidebar,
  },
  setup() {},
};
</script>
