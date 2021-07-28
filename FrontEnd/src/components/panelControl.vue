<template>
  <div class="da-panel">
    <Stats />
    <Table />
  </div>
</template>
<script>
import Stats from "@/components/Cards/statsCard.vue";
import Table from "@/components/table.vue";
export default {
  components: {
    Stats,
    Table,
  },
  setup() {},
};
</script>
