<template>
  <div>
    <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      @close="handleClose()"
    />
    <div class="body m-0 md:ml-16">
          <form @submit.prevent="searchPost(search.keyword)">
      <div
        class="flex items-center justify-between lg:flex-wrap p-4 mx-0 lg:mx-24
      "
      >
        <div class=" text-4xl font-bold  ">Community</div>

        <div class=" p-2 shadow flex my-6 md:my-0 w-60 lg:w-auto">
          <span class="w-auto flex justify-end items-center text-gray-500 p-2">
          </span>
          <input
            class="w-full rounded p-2 outline-none "
            type="text"
            placeholder="Seach anything"
            v-model="search.keyword"
          />
          <button
            class="bg-blue-400 hover:bg-blue-300 rounded text-white p-2 pl-4 pr-4 "
            type="submit"
          >
            <p class="font-semibold text-xs">Search</p>
          </button>
        </div>
      </div>
          </form>

      <!-- <div class="ds-title">Trending</div> -->

      <div class=" text-4xl font-bold  pb-9 pl-6"></div>

      <!-- <catCards /> -->

      <div class=" text-4xl font-bold  pb-9 pl-6">Blogs</div>
      <!-- card -->

      <div class="w-full h-full">
        <div
          class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3  2xl:grid-cols-4 md:grid-cols-2 gap-5 p-5"
        >
          <div v-if="s" v-for="result in results" :key="result.id">
            <PostCard  v-for="post in results" :post="result" :key="result.id" />
          </div>
          <PostCard v-if="!s" v-for="post in posts" :post="post" :key="post.id" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Modal from "@/components/Modals/Modal.vue";

import PostCard from "@/components/Cards/postCard.vue";
import catCards from "@/components/Cards/tags.vue";
import NewPost from "@/components/newPost.vue";
import { computed, ref } from "vue";
import { useStore } from "vuex";
import { onMounted, watch } from "vue";
export default {
  components: {
    Modal,
    PostCard,
    catCards,
    NewPost,
  },
  setup(_, { emit }) {
    const store = useStore();
    const modalOpen = ref(false);
    const modalContent = ref("submitPostModal");

    const search = ref({
      keyword: "",
    });

    const s = ref(false);

    watch(() => {
      search.keyword = () => {
        console.log(searchPost());
      };
    });

    onMounted(() => {
      store.dispatch("post/getPosts");
      store.dispatch("post/search");
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
    const results = computed(() => store.getters["post/SEARCH_RESULTS"]);

    const searchPost = async (searchData) => {
      await store.dispatch("post/search", searchData);
      console.log(searchData);
      toggle()
    };

    const toggle = () => {
      s.value = !s.value
    }

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
      Auth,
      searchPost,
      search,
      results,
      toggle,
      s
    };
  },
};
</script>
