<template>
  <div>
    <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      @close="handleClose()"
    />
    <div class="body">
      <div class="ds-title">Cummunity</div>
      <form class="search-form">
  <input type="search" value="" placeholder="Search" class="search-input">
  <button type="submit" class="search-button">
    <svg class="submit-button">
      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search"></use>
    </svg>
  </button>
 
</form>


      <!-- <div class="ds-title">Trending</div> -->

      <div class="ds-title">Categories</div>

      <catCards />

      <div class="ds-title">Blogs</div>
      <!-- card -->
      <div class="post-container">
        <PostCard v-for="post in posts" :post="post" :key="post.id" />
      </div>
      <!--    post model -->
      <button v-if="Auth" class="addpost" @click="openModal('submitPostModal')">
        <i class="bx bx-plus-circle"></i>
      </button>
    </div>
  </div>
</template>
<script>
import Modal from "@/components/Modals/Modal.vue";

import PostCard from "@/components/Cards/postCard.vue";
import catCards from "@/components/Cards/statsCard.vue";
import { computed, ref } from "vue";
import { useStore } from "vuex";
import { onMounted } from "vue";
export default {
  components: {
    Modal,
    PostCard,
    catCards,
  },
  setup(_, { emit }) {
    const store = useStore();
    const modalOpen = ref(false);
    const modalContent = ref("submitPostModal");

    onMounted(() => {
      store.dispatch("post/getPosts");
      console.log("userid", userId.value);
      console.log(posts.value);
      console.log("admin ", Admin.value);
      console.log("username", userName.value);
    });


    const userId = computed(() => store.getters["auth/userId"]);
    const posts = computed(() => store.getters["post/ALL_POSTS"]);
    const Admin = computed(() => store.getters["auth/Admin"]);
    const userName = computed(() => store.getters["auth/userName"]);
    const Auth = computed(() => store.getters["auth/authenticated"]);

    const openModal = (modal) => {
      modalContent.value = modal;
      modalOpen.value = true;
    };
    const handleClose = () => {
      modalOpen.value = false;
    };

    return {
      modalOpen,
      modalContent,
      openModal,
      handleClose,
      posts,
      userId,
      Admin,
      userName,
      Auth
    };
  },
};
</script>
