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
              <img src="../assets/bg.jpg" alt="" />
            </div>

            <div class="blog-article">
              {{ post?.content }}
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="t">
           <form action="">
        <textarea
          name=""
          id=""
          cols="30"
          rows="10"
          v-model="Comment.content"
        ></textarea>
        <div class="c-btn">
          <button @click.prevent="SendComment" class="comment">COMMENT</button>
          <button class="cancel"></button>
        </div>
      </form>
      </div> -->

      <Scomment :id="id" />
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
    const id = computed(() => route.params.id);
    onMounted(() => {
      store.dispatch("post/single", id.value);
      console.log("userid", userId);
    });

    // comment
    // const Comment = ref({
    //   content: "",
    //   post_id: id.value

    // });

    const SendComment = async () => {
      await store.dispatch("comments/submitComment", Comment.value);
      console.log(typeof [id.value]);
    };

    return {
      id,
      post,
      SendComment,
      store,
      userId,
    };
  },
};
</script>
<style></style>
