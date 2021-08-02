<template>
  <div class="overlay" @mousedown.self="$emit('close')">
    <div class="modal">
      <component :is="modalContent" :data="data" @close="$emit('close')">
      </component>
    </div>
  </div>
</template>

<script>
import { onMounted, onUnmounted } from "@vue/runtime-core";
import SubmitPostModal from "@/components/ModalsContent/postModal.vue";
import editPostModal from "@/components/ModalsContent/editModal.vue";
import editUserModal from "@/components/ModalsContent/editUser.vue";
export default {
  name: "Modal",
  props: ["modalContent", "data"],
  components: {
    SubmitPostModal,
    editPostModal,
    editUserModal
  },
  setup() {
    onMounted(() => {
      document.body.classList.add("no-scroll");
         setTimeout(() => {
        open.value = true;
      }, 50);
    });

    onUnmounted(() => {
      document.body.classList.remove("no-scroll");
    });
    
    return {
      open 
    };
  },
};
</script>
