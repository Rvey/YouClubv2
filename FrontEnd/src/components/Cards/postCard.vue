<template>
  <div>
    <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      :data="post"
      @close="handleClose()"
    />

    <div class="card">
      <div class="card-header">
        <img
          :src="`http://127.0.0.1:8000/api/post/image/${post.image}`"
          width="1500"
          height="1368"
          alt=""
        />
      </div>
      <div class="card-body">
        <span class="tag tag-teal">
          Technology
        </span>
        <h4 v-if="post.title.length < 8">
          {{ post.title.substring(0, 8) + "..." }}
        </h4>
        <h4 class="article-title" v-if="post.title.length >= 8">
          , {{ post.title.substring(0, 8) + "..." }}
        </h4>
        <p class="article-desc" v-if="post.content.length < 100">
          {{ post.content }}
        </p>
        <p class="article-desc" v-if="post.content.length >= 100">
          {{ post.content.substring(0, 100) + "..." }}
        </p>
      </div>
      <div class="end">
        <div class="user">
          <img
            src="https://randomuser.me/api/portraits/men/33.jpg"
            alt="user"
          />
          <div class="user-info">
            <h5>{{ post?.user.username }}</h5>
            <small>{{ time(post.created_at) }}</small>
          </div>
        </div>
        <div class="btns">
          <div class="add" @click="bonk" :class="add ? 'plus' : 'minos '">
            <i class="bx bx-bookmark-alt-plus green"></i>
          </div>
          <div class="remove" @click="bonk" :class="add ? 'minos ' : 'plus'">
            <i class="bx bx-bookmark-alt-minus red"></i>
          </div>

          <div v-if="post.user_id == userId || Admin" class="like">
            <i @click="openModal('editPostModal')" class="bx bxs-edit-alt"></i>
          </div>

          <div v-if="post.user_id == userId || Admin" class="Delete">
            <div class="Delete">
              <i @click.prevent="deletePost(post)" class="bx bxs-trash-alt"></i>
            </div>
          </div>

          <div class="like">
            <router-link
              @click="single"
              :to="{ name: 'BlogPage', params: { id } }"
            >
              <i class="bx bxs-right-arrow-alt more"></i
            ></router-link>
          </div>
        </div>
      </div>
    </div>
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
    const bonk = () => {
      add.value = !add.value;
    };

    const userId = computed(() => store.getters["auth/userId"]);
    const posts = computed(() => store.getters["post/ALL_POSTS"]);
    const Admin = computed(() => store.getters["auth/Admin"]);
    const userName = computed(() => store.getters["auth/userName"]);

    const deletePost = async ({ id }) => {
      await store.dispatch("post/deletePost", id);
      store.dispatch("post/getPosts");
    };

    const image = ref(null);

    const time = (date) => {
      //   return moment(date).format("MMM Do YY, h:mm:ss a");
      return moment(date)
        .startOf("hour")
        .fromNow();
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
    return {
      modalOpen,
      modalContent,
      add,
      posts,
      single,
      route,
      // editPost,
      userName,
      bonk,
      handleClose,
      openModal,
      post,
      deletePost,
      time,
      userId,
      Admin,
      image,
      id,
    };
  },
};
</script>
