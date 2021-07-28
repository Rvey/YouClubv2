<template>
  <div class="body">
    <div class="ds-title">Dashboard</div>
    <div class="dashboard">
      <Panel />
      <Profile />
    </div>
  </div>
</template>
<script>
import Panel from "@/components/panelControl.vue";
import Profile from "@/components/profile.vue";

export default {
  components: {
    Panel,
    Profile,
  },
  setup() {},
};
</script>
