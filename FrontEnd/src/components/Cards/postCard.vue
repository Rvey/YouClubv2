<template>
  <Modal
    v-if="modalOpen"
    :modalContent="modalContent"
    :data="post"
    @close="handleClose()"
  />
  <div class="w-full md:mx-2 mb-4 md:mb-0">
    <div class="bg-black rounded-xl">
      <div
        class="bg-white shadow-xl border-2 border-black rounded-lg overflow-hidden  relative  z-1 transform hover:translate-y-2 hover:translate-x-2 transition-all"
      >
        <img
          class="h-32 w-full object-cover object-center"
          :src="`http://127.0.0.1:8000/api/post/image/${post.image}`"
          alt=""
        />
        <div class="m-4">
          <router-link
            class="inline bg-blue-300 py-1 px-2 rounded-full text-xs lowercase text-gray-700 font-bold"
            :to="{ name: 'BlogPage', params: { id } }"
            >#{{ post?.tags }}</router-link
          >
        </div>
        <div class="p-4 h-auto md:h-40 lg:h-48">
          <router-link
            :to="{ name: 'BlogPage', params: { id } }"
            @click="single"
            class="block text-gray-900 font-medium text-4xl mb-2  lg:text-lg"
          >
            {{ post?.title }}
          </router-link>
          <div
            class="text-black text-md leading-relaxed block md:text-md lg:text-md break-all"
          >
            {{ trim(strip(post?.content)) }}
          </div>
        </div>
        <div
          class="flex align-bottom p-2  bg-blue-100 rounded-lg bg-opacity-25"
        >
          <div class="flex justify-between w-full align-middle">
            <div class="flex gap-4 align-middle  ">
              <div>
                <!-- <img
                class="bg-red-300 w-10 h-10 rounded-full"
                src="#"
                alt="img"
              /> -->
              </div>
              <div class="flex flex-col  ">
                <div class="font-bold text-md uppercase">
                  {{ post.user?.username }}
                </div>
                <div class="font-semibold text-gray-400 text-xs">
                  {{ time(post?.created_at) }}
                </div>
              </div>
            </div>
            <div class="flex align-middle items-center gap-2">
              <div
                class="px-2 py-2 bg-blue-500 rounded-md text-white font-semibold text-sm cursor-pointer hover:bg-blue-600 "
              >
                <router-link
                  @click="single"
                  :to="{ name: 'BlogPage', params: { id } }"
                >
                  ReadMore
                </router-link>
              </div>

              <!-- bookmark -->
              <div class="relative">
                <!-- <i
                v-if="mark"
                @click="removeSaved(post)"
                class="bx bxs-bookmark text-2xl cursor-pointer "
              ></i> -->
                <div v-if="post.user_id == userId || Admin">
                  <svg
                    @click.prevent="deletePost(post)"
                    class="w-6 h-6 transition duration-500 ease-in-out hover:text-red-600  text-red-500 text-2xl  cursor-pointer"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    ></path>
                  </svg>
                  <!-- <i
              @click.prevent="deletePost(post)"
              class="bx bxs-trash-alt transition duration-500 ease-in-out hover:text-red-600  text-red-500 text-2xl  cursor-pointer"
            ></i> -->
                </div>

                <!-- <i
                v-if="!mark"
                @click=" savepost(post)"
                class="bx bx-bookmark text-2xl cursor-pointer "
              ></i> -->
              </div>
              <div v-if="post.user_id == userId || Admin" class="like">
                <svg
                  @click="openModal('editPostModal')"
                  class="w-6 h-6 transition duration-500 ease-in-out hover:text-blue-600  text-gray-500 text-2xl  cursor-pointer"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                  ></path>
                </svg>
                <!-- <i
              @click="openModal('editPostModal')"
              class="bx bxs-edit-alt transition duration-500 ease-in-out hover:text-blue-600  text-gray-500 text-2xl ; cursor-pointer"
            ></i> -->
              </div>
              <!-- <div>
              <i
                class="bx bx-dots-vertical-rounded font-semibold text-2xl cursor-pointer hover:text-gray-600"
                @click="show()"
              ></i>
            </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <transition name="fade">
      <div
        v-if="!isOpen"
        class="absolute  bg-gray-100 rounded-md font-semibold z-10 "
      >
        <div class="flex gap-6">
          <div v-if="post.user_id == userId || Admin">
            <i
              @click.prevent="deletePost(post)"
              class="bx bxs-trash-alt transition duration-500 ease-in-out hover:text-red-600  text-red-500 text-4xl ; cursor-pointer"
            ></i>
          </div>

          <div v-if="post.user_id == userId || Admin" class="like">
            <i
              @click="openModal('editPostModal')"
              class="bx bxs-edit-alt transition duration-500 ease-in-out hover:text-blue-600  text-gray-500 text-4xl ; cursor-pointer"
            ></i>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import moment from "moment";
import Modal from "@/components/Modals/Modal.vue";
import { computed, onMounted, ref } from "vue";
import { useStore } from "vuex";
import { useRoute } from "vue-router";
import { file_blob } from "@/util";
export default {
  components: {
    Modal,
  },
  props: ["post"],
  setup(props) {
    const route = useRoute();
    const store = useStore();
    const add = ref(true);
    const post = props.post;
    const modalOpen = ref(false);
    const modalContent = ref("");
    const id = ref(post.id);
    const mark = ref(false);
    const image = ref(null);
    const isOpen = ref(true);

    const userId = computed(() => store.getters["auth/userId"]);
    const posts = computed(() => store.getters["post/ALL_POSTS"]);
    const Admin = computed(() => store.getters["auth/Admin"]);
    const userName = computed(() => store.getters["auth/userName"]);

    const time = (date) => {
      //   return moment(date).format("MMM Do YY, h:mm:ss a");
      return moment(date)
        .startOf("hour")
        .fromNow();
    };

    const strip = (data) => {
      return data.replace(/(<([^>]+)>)/gi, "");
    };

    const trim = (text) => {
      return text.substring(0, 200) + "...";
    };

    const show = () => {
      isOpen.value = !isOpen.value;
      console.log("wekrwke");
    };

    const booktoggle = () => {
      mark.value = !mark.value;
    };

    const openModal = (modal) => {
      modalContent.value = modal;
      modalOpen.value = true;
    };

    const single = ({ id }) => {
      store.dispatch("post/single", id);
    };

    const handleClose = () => {
      modalOpen.value = false;
    };

    const removeSaved = async ({ id }) => {
      store.dispatch("bookmark/deleteMarked", id);
      booktoggle();
    };

    const savepost = async (postData) => {
      store.dispatch("bookmark/submitMarked", postData);
      booktoggle();
    };

    const deletePost = async ({ id }) => {
      await store.dispatch("post/deletePost", id);
      store.dispatch("post/getPosts");
    };

    return {
      modalOpen,
      modalContent,
      add,
      posts,
      single,
      route,
      // editPost,
      userName,
      handleClose,
      openModal,
      post,
      deletePost,
      time,
      userId,
      Admin,
      image,
      id,
      isOpen,
      show,
      mark,
      booktoggle,
      savepost,
      removeSaved,
      strip,
      trim,
    };
  },
};
</script>
