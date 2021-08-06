<template>
  <div class="body">
    <div>
      <div class="socials">
        <Comment />
        <Like />
      </div>
      <div class="blog-wrapper">
        <div class="blog">
          <div class="blog-category"></div>
          <div class="blog-title">
            {{ post?.title }}

          </div>
          <div class="blog-p">
            <div class="blog-author">by {{ post?.user?.username }}</div>
            <div class="blog-time">
              {{ post?.created_at }}
            </div>
          </div>

          <div class="a-i">
            <div class="blog-image">
              <img :src="`http://127.0.0.1:8000/api/post/image/${post?.image}`"  alt="" />
            </div>

            <div class="blog-article">
              {{ post?.content }}
            </div>
          </div>
           <h3>Leave a comment</h3>
           <Scomment :id="id" />
        </div>
       
      </div>
    </div>
  </div>
</template>
<script>
import { useRoute } from "vue-router";
import { useStore } from "vuex";

import Like from "@/components/Misc/comment.vue";
import Comment from "@/components/Misc/like.vue";
import Scomment from "@/components/commentSection.vue";

import { computed, onMounted, ref } from "@vue/runtime-core";

export default {
  components: {
    Like,
    Comment,
    Scomment,
  },
  setup() {
    const store = useStore();
    const route = useRoute();
    const post = computed(() => store.getters["post/CURRENT_POST"]);
    const userId = computed(() => store.getters["auth/userId"]);
     const Admin = computed(() => store.getters["auth/Admin"]);
     
    const id = computed(() => route.params.id);
    onMounted(() => {
      store.dispatch("post/single", id.value);
      // console.log("userid", image);
    });

    // comment
    // const Comment = ref({
    //   content: "",
    //   post_id: id.value

    // });
    // const image = ref(null);


    const SendComment = async () => {
      await store.dispatch("comments/submitComment", Comment.value);
       
    };

    return {
      id,
      post,
      SendComment,
      store,
      userId,
      Admin
      // image
    };
  },
};
</script>
<style></style>
