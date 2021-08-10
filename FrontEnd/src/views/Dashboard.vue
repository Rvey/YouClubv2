<template>
      <Sidebar />
      <Dashbody />
      <Mobile />
</template>
<script>
import Sidebar from "@/components/sidebar.vue";
import Dashbody from "@/components/dashbody.vue";
import Mobile from "@/components/mobilenav.vue"
export default {
  components: {
    Sidebar,
    Dashbody,
    Mobile
  },
};
</script>