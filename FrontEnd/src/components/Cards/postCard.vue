<template>
  <div>
    <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      :data="post"
      @close="handleClose()"
    />
    <div class="post-card">
      <div>
        <img class="img" src="../../assets/bg.jpg" alt="" />
      </div>
      <div class="card_content">
        <div class="info">
          <h5>{{post.id}}</h5>
          <h5>{{ time(post.created_at) }}</h5>
          <h5>category</h5>
        </div>

        <div class="card_body">
          <h2 v-if="post.title.length < 8">{{ post.title }}</h2>
          <h2 v-if="post.title.length >= 8">
            , {{ post.title.substring(0, 8) + "..." }}
          </h2>
          <p v-if="post.content.length < 100">{{ post.content }}</p>
          <p v-if="post.content.length >= 100">
            {{ post.content.substring(0, 100) + "..." }}
          </p>
        </div>
        <div class="socialize">
          <div class="More">
            <router-link :to="{ name:'BlogPage' , params:{id}}" ></router-link>
          </div>

          <div class="btns">
            <div class="add" @click="bonk" :class="add ? 'plus' : 'minos '">
              <i class="bx bx-bookmark-alt-plus green"></i>
            </div>
            <div class="remove" @click="bonk" :class="add ? 'minos ' : 'plus'">
              <i class="bx bx-bookmark-alt-minus red"></i>
            </div>
            <div class="like">
              <div class="like">
                <i
                  @click="openModal('editPostModal')"
                  class="bx bxs-edit-alt"
                ></i>
              </div>
            </div>
            <div v-if="post.user_id == userId" class="Delete">
              <div class="Delete">
                <i @click="deletePost(post)" class="bx bxs-trash-alt"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import Modal from "@/components/Modals/Modal.vue";
import { computed, ref } from "vue";
import { useStore } from "vuex";

import { useRoute } from 'vue-router';
export default {

  components: {
    Modal,
  },
  props: ["post"],
  setup(props) {
    const store = useStore();
    const add = ref(true);
    const post = props.post;
    const modalOpen = ref(false);
    const modalContent = ref("");
    const id = ref(post.id);
    const bonk = () => {
      add.value = !add.value;
    };


    const route = useRoute();
    const userId = computed(() => store.getters["auth/userId"]);
    const posts = computed(() => store.getters["post/ALL_POSTS"]);
    const Admin = computed(() => store.getters["auth/Admin"]);
    const userName = computed(() => store.getters["auth/userName"]);

    const deletePost = ({ id }) => {
      store.dispatch("post/deletePost", id);
    };

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

    const single =  ({ id }) => {
       store.dispatch("post/single" , id);
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
      id,
    };
  },
};
</script>
