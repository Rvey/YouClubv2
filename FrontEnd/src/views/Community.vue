<template>
  <Sidebar />
  <NewPost class="h-screen" :class="toggle ? 'activeP' : 'not-activeP'" />
  <Cbody />
  <button class="addpost" @click="show">
    <i class="bx bx-plus-circle"></i>
  </button>
</template>
<script>
import Sidebar from "@/components/sidebar.vue";
import Cbody from "@/components/cbody.vue";
import NewPost from "@/components/newPost.vue";
import { computed, ref } from "vue";
export default {
  components: {
    Sidebar,
    Cbody,
    NewPost,
  },
  setup() {
    const toggle = ref(false);
    const show = () => {
      toggle.value = !toggle.value;
    };
    return {
      toggle,
      show,
    };
  },
};
</script>
<style></style>
