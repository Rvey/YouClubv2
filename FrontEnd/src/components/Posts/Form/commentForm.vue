<template>
  <form action="">
    <textarea name="" id="" cols="30" rows="10" v-model="Comment"  ></textarea>
    <div class="c-btn">
      <button @click.prevent="SendComment" class="comment">COMMENT</button>
      <button class="cancel">CANCEL</button>
    </div>
  </form>
</template>
<script>
import { ref } from "vue";
export default {
  setup() {
      const Comment = ref('');
      const SendComment = () => {
          console.log(Comment.value);
      } 
    return {
        SendComment, 
        Comment
    };
  },
};
</script>
