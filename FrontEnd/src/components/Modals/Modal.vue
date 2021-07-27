<template>
  <div class="overlay">
    <div class="modal">
      <component :is="modalContent" @close="$emit('close')">
      </component>
    </div>
  </div>

</template>

<script>
import { onMounted, onUnmounted } from "@vue/runtime-core";
import SubmitPostModal from "@/components/ModalsContent/postModal.vue";

export default {
  name: "Modal",
  props: ["modalContent"],
  components: {
SubmitPostModal
  },
  setup() {
    onMounted(() => {
      document.body.classList.add("no-scroll");
      
    });

    onUnmounted(() => {
      document.body.classList.remove("no-scroll");
    });

    return {  };
  },
};
</script>
