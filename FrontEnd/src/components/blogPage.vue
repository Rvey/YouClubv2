<template>
  <div class="body">
    <div>
      <div class="socials">
        <Comment />
        <Like />
      </div>
      <div class="blog-wrapper">
        <div class="blog">
          <div class="blog-category">
          </div>
          <div class="blog-title">
            {{post?.title}}
          </div>
          <div class="blog-p">
            <div class="blog-author">
              by {{post?.user.username}}
            </div>
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
      <Scomment />
    </div>
  </div>
</template>
<script>
import {useRoute} from 'vue-router'
import {useStore} from 'vuex'

import Like from "@/components/Misc/comment.vue";
import Comment from "@/components/Misc/like.vue";
import Scomment from "@/components/commentSection.vue";
import { computed, onMounted } from '@vue/runtime-core';

export default {
  components: {
    Like,
    Comment,
    Scomment,
  },
  setup() {
    const store = useStore()
    const route = useRoute()
  
    const post = computed(() => store.getters['post/CURRENT_POST'])

    const id = computed(() => route.params.id)

    onMounted(() => {
        store.dispatch("post/single" , id.value)
  
    })
  return {
    id, 
    post
  }
   
  }
};
</script>
<style></style>
