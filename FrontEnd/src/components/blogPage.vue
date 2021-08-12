<template>
  <div class="body m-0 md:ml-12">
    <div>
      <!-- <div class="socials">
        <Comment />
        <Like />
      </div> -->
      <div class="blog-wrapper  ">
        <div class="blog">
          <div class="a-i w-full">
            <div class="blog-image w-full flex items-center space-y-7">
              <img
                :src="`http://127.0.0.1:8000/api/post/image/${post?.image}`"
                alt=""
              />
            </div>
            <div class="blog-category"></div>
            <div class="blog-title">
              {{ post?.title }}
            </div>
            <div class="blog-p ">
              <div class="blog-author text-2xl font-medium">
                by {{ post?.user?.username }}
              </div>
              <div class=" font-semibold text-gray-500 text-xl ">
                {{ time(post?.created_at) }}
              </div>
            </div>

            <div v-html="post?.content" class="blog-article mt-16"></div>
          </div>
          <div
            class=" mt-16 sm:mt-48 md:mt-64 lg:mt-80 bg-gray-100 p-2 md:p-6 rounded-lg "
          >
            <h3 class="font-bold text-2xl">Leave a comment</h3>
            <Scomment :id="id" class="bg-gray-200 p-6" />
          </div>
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
import moment from "moment";
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

    const time = (date) => {
      //   return moment(date).format("MMM Do YY, h:mm:ss a");
      return moment(date)
        .startOf("hour")
        .fromNow();
    };

    const SendComment = async () => {
      await store.dispatch("comments/submitComment", Comment.value);
    };

    return {
      id,
      post,
      SendComment,
      store,
      userId,
      Admin,
      // image
      time,
    };
  },
};
</script>
<style></style>
