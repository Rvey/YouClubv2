<template>
  <Sidebar />
  <NewPost class="h-screen" :class="toggle ? 'activeP' : 'not-activeP'" />
  <Cbody />
  <button class="addpost text-3xl  text-red-400" v-if="!toggle" @click="show">
    <i class="bx bx-plus-circle rounded-full text-white bg-blue-500 p-3"></i>
  </button>
   <button class="addpost text-4xl " v-if="toggle" @click="show">
    <i class="text-red-400  bx bx-right-arrow-alt"></i>
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
