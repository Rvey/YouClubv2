<template>
      <Sidebar />
      <Dashbody />
</template>
<script>
import Sidebar from "@/components/sidebar.vue";
import Dashbody from "@/components/dashbody.vue";
export default {
  components: {
    Sidebar,
    Dashbody
  },
};
</script>