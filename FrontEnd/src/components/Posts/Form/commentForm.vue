<template>
<div class="t"> 
  <form action="">
    <textarea name="" id="" cols="30" rows="10" v-model="Comment.content"></textarea>
    <div class="c-btn">
      <button @click.prevent="SendComment" class="comment">COMMENT</button>
      <button class="cancel"> Cancel </button>
    </div>
  </form>
   <h4>77 Comments</h4>

  

    <div class="comments">
      <div class="user-avatar">
        <img src="./../assets/bg.jpg" alt="" />
      </div>

      <div class="com-wrapper">
        <div class="user-com">
          <div class="user-name">RedOne</div>
          <div class="time">3 days ago</div>
        </div>
        <div class="com">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus,
          libero iure quo debitis temporibus placeat autem alias cupiditate
          officiis excepturi consequuntur, sit molestias consequatur numquam
          sequi et rem impedit saepe ipsam nostrum neque sint illum ducimus!
          Explicabo deserunt optio reiciendis?
        </div>
      </div>
    </div>
    </div>
</template>
<script>
// import { useStore } from "vuex";
// import { computed, ref } from "vue";

// export default {
//   setup() {

// const store = useStore();
//       const Comment = ref({
//         content: ""
//       });
//       const SendComment = async () => {
//          await store.dispatch("comments/submitComment" , Comment.value) 

//       } 
//     return {
//         SendComment, 
//         Comment,
//         store,
        
//     };
//   },
  
// };
import { useRoute } from "vue-router";
import { useStore } from "vuex";

import Like from "@/components/Misc/comment.vue";
import Comment from "@/components/Misc/like.vue";
// import Scomment from "@/components/commentSection.vue";

import { computed, onMounted , ref} from "@vue/runtime-core";

export default {
  components: {

  
    
    
  },
  setup() {
    const store = useStore();
    const route = useRoute();
    const post = computed(() => store.getters["post/CURRENT_POST"]);
    const id = computed(() => route.params.id);
    onMounted(() => {
      store.dispatch("post/single", id.value);
    });

    // comment
    const Comment = ref({
      content: "",
      post_id: id.value
     
    });
    const SendComment = async () => {
      await store.dispatch("comments/submitComment", Comment.value);
      console.log(typeof[id.value]);
    };

    return {
      id,
      post,
        SendComment, 
        Comment,
        store,
    };
  },
</script>
