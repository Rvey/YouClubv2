<template>
  <div>
    <form class="form"  action="#">
      <div>
        <input type="file" id="file" accept="images" />
      </div>

      <div class="field" >
        <label for="Post title">Post title</label>
        <input v-model="post.title" type="text" />
      </div>

      <div class="field">
        <label for="Post title">Post content</label>
        <textarea
          v-model="post.content"
          id="content"
          name="content"
          rows="10"
          cols="50"
        >
        </textarea>
      </div>

      <!--        submit-->

      <div class="btns">
        <button class="submit" @click.prevent="editPost(post)" type="submit">
          Submit
        </button>
        <button @click.prevent="close" class="cancel">cancel</button>
      </div>
    </form>
  </div>
</template>
<script>
import { useStore } from "vuex";
import { ref } from "vue";

export default {
  name: "editPostModal",
  props: ["data"],

  setup({ data }, { emit }) {
    const store = useStore();
    const post = ref({
      id: data.id,
      title: data.title,
      content: data.content,
    });


    const editPost =  () => {
       store.dispatch("post/editPost", post.value);
       store.dispatch("post/getPosts");
    
      emit('close')
       
    };

    const close = () => {
      console.log(post.title);
      return emit("close");
    };
    return {
      close,
      editPost,
      post,
    };
  },
};
</script>
