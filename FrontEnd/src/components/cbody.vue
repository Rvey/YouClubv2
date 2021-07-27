<template>
  <div>
    <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      @close="handleClose()"
    />

    <div class="body">
      <h2>Top trending</h2>
      <!-- card -->

      <div v-for="post in posts" :key="post.id">
        <div class="post-card">
          <div>
            <img class="img" src="../assets/bg.jpg" alt="" />
          </div>
          <div class="card_content">
            <div class="info">
              <h5>{{post.user}}</h5>
              <h5>{{ time(post.created_at )}}</h5>
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
                <a href="">Read More</a>

              </div>

              <div class="btns">
                <div class="add" @click="bonk" :class="add ? 'plus' : 'minos '">
                  <i class="bx bx-bookmark-alt-plus green"></i>
                </div>
                <div
                  class="remove"
                  @click="bonk"
                  :class="add ? 'minos ' : 'plus'"
                >
                  <i class="bx bx-bookmark-alt-minus red"></i>
                </div>
                <!-- <div class="like">
                  <div class="like">
                  <i @click="editPost" class='bx bxs-edit-alt' ></i>
                  </div>
                </div> -->
                <div v-if="post.user_id == userId  " class="Delete">
                  <div class="Delete">
                    <i
                      @click="deletePost(post)"
                      class="bx bxs-trash-alt"
                    ></i>
                  </div>
                </div>

                <div class="likes-counter">{{ count }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--    post model -->
      <button class="addpost" @click="openModal('submitPostModal')">
        <i class="bx bx-plus-circle"></i>
      </button>
    </div>
  </div>
</template>
<script>
import moment from "moment";
import Modal from "@/components/Modals/Modal.vue";
// import SubmitPostModal from "@/components/ModalsContent/postModal.vue";
import { computed, ref } from "vue";
import { useStore } from "vuex";
import { onMounted } from "vue";
export default {
  components: {
    Modal,
  },
  setup(_, { emit }) {
    const store = useStore();
    const add = ref(true);
    const count = ref(0);
    const isLiked = ref(true);
    const post = ref(false);
    const modalOpen = ref(false);
    const modalContent = ref("");
    const id = ref(post.id);
    const bonk = () => {
      add.value = !add.value;
    };
    onMounted(() => {
      store.dispatch("post/getPosts");
       console.log( 'userid', userId.value);
       console.log(posts.value);
       console.log('admin ' , Admin.value);
       console.log('username' , userName.value);
      
    });

    const userId = computed(() => store.getters["auth/userId"]);
    const posts = computed(() => store.getters["post/ALL_POSTS"]);
    const Admin = computed(() => store.getters["auth/Admin"]);
    const userName = computed(() => store.getters["auth/userName"]);

    const editPost = () => {
     console.log('edit btn '); 
    }
    const deletePost = ({id}) => {
      store.dispatch("post/deletePost", id) 
    };

    // const delete =


      const time = (date) => {
      return moment(date).format("MMM Do YY, h:mm:ss a");
    };

    const handleClose = () => {
      modalOpen.value = false;
    };

    const openModal = (modal) => {
      modalContent.value = modal;
      modalOpen.value = true;
    };
    const toggle = () => {
      post.value = !post.value;
    
    };
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
      count,
      isLiked,
      add,
      posts,
      // like,
      editPost,
      userName,
      bonk,
      toggle,
      handleClose,
      openModal,
      post,
      deletePost,
      time,userId,
      Admin,
      id
    };
  },
};
</script>
