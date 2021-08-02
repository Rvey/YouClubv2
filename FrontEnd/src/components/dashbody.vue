<template>
  <div class="body">
    <div class="ds-title">Dashboard</div>
    <div class="dashboard">
      <Table />
      <Profile />
    </div>
  </div>
</template>
<script>
import Table from "@/components/userTable.vue";
import Profile from "@/components/profile.vue";

export default {
  components: {
    Table,
    Profile,
  },
  setup() {},
};
</script>
