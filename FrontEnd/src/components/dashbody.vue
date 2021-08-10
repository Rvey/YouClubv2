<template>
  <div class="body m-0 md:ml-20">
    <div class="ds-title">Dashboard</div>
    <div class="dashboard">
    <div class="left-side">
      <Table />
    
    
       </div>
    <Profile />
      
    </div>
  </div>
</template>
<script>
import Table from "@/components/userTable.vue";
import Profile from "@/components/profile.vue";
import Tags from "@/components/Misc/tag.vue";

export default {
  components: {
    Table,
    Profile,
   
  },
  setup() {},
};
</script>
