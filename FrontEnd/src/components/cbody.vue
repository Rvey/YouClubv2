<template>

  <div>
    <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      @close="handleClose()"
    />
    <div class="body">

      <div class="ds-title">Top trending</div>
      <!-- card -->
      <div>
        <PostCard v-for="post in posts" :post="post" :key="post.id" />
      </div>
      <!--    post model -->
      <button class="addpost" @click="openModal('submitPostModal')">
        <i class="bx bx-plus-circle"></i>
      </button>
    </div>
  </div>
</template>
<script>
import Modal from "@/components/Modals/Modal.vue";

import PostCard from "@/components/Cards/postCard.vue";
import { computed, ref } from "vue";
import { useStore } from "vuex";
import { onMounted } from "vue";
export default {
  components: {
    Modal,
    PostCard,
  },
  setup(_, { emit }) {
    const store = useStore();
    const modalOpen = ref(false);
    const modalContent = ref("");

    onMounted(() => {
      store.dispatch("post/getPosts");
      console.log("userid", userId.value);
      console.log(posts.value);
      console.log("admin ", Admin.value);
      console.log("username", userName.value);
    });

    // const editPost = () => {
    //  console.log('edit btn ');
    // }

    // const delete =
    const userId = computed(() => store.getters["auth/userId"]);
    const posts = computed(() => store.getters["post/ALL_POSTS"]);
    const Admin = computed(() => store.getters["auth/Admin"]);
    const userName = computed(() => store.getters["auth/userName"]);

    const openModal = (modal) => {
      modalContent.value = modal;
      modalOpen.value = true;
    };
    const handleClose = () => {
      modalOpen.value = false;
    };
    // const toggle = () => {
    //   post.value = !post.value;
    // };
    // const like = () => {
    //   if (count.value === 0) {
    //     count.value++;
    //   } else {
    //     count.value--;
    //   }
    //   isLiked.value = !isLiked.value;
    // };
    return {
      modalOpen,
      modalContent,
      openModal,
      handleClose,
      posts,
      userId,
      Admin,
      userName,
    };
  },
};
</script>
