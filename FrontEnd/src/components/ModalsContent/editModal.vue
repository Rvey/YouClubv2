<template>
  <div>
    <div >
      <form @click.prevent="submit" action="#">
   
          <div>
            <input type="file" id="file" accept="images" />
            <label for="file" class="label">
              <i class="bx bxs-image-add"></i> Upload Image edit
            </label>
          </div>
      
        <div >
          <label for="Post title">Post title</label>
          <input v-model="post.title" type="text" />
        </div>

        <div>
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

        <div class="submit-btns">
          <button class="submit" @click="editPost(post)" type="submit">Submit</button>
          <button @click.prevent="close" class="cancel">cancel</button>
        </div>
      </form>
    </div>
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
      // title:"" ,
      // content: ""
    });

    const editPost = async () => {
      await store.dispatch("post/editPost", post.value);
      console.log(post.value);
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
