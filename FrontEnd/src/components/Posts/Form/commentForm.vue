<template>
  <form action="">
    <textarea name="" id="" cols="30" rows="10" v-model="Comment.content"></textarea>
    <div class="c-btn">
      <button @click.prevent="SendComment" class="comment">COMMENT</button>
      <button class="cancel">CANCEL</button>
    </div>
  </form>
</template>
<script>
import { useStore } from "vuex";
import { ref } from "vue";

export default {
  setup() {

const store = useStore();
      const Comment = ref({
        content: ""
      });


      const SendComment = async () => {
         await store.dispatch("comments/submitComment" , Comment.value) 

      } 
    return {
        SendComment, 
        Comment,
        store
    };
  },
};
</script>
