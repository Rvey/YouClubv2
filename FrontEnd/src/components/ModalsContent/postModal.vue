<template>
<div>
   <Modal v-if="modalOpen" :modalContent="modalContent" @close="handleClose()" />
    <div ref="modal"
    class="form-wrapper">
      <form @click.prevent="submit" class="post-form" action="#" >
        <div class="upload-wrapper">
          <div class="image">
            <input type="file" id="file" accept="images" />
            <label for="file" class="label"> <i class='bx bxs-image-add' ></i> Upload Image</label>
          </div>
        </div>
        <div class="t">
          <label for="Post title">Post title</label>
          <input v-model="post.title" type="text"  />
        </div>

        <div class="c">
          <label for="Post title">Post content</label>
       <textarea v-model="post.content" id="content" name="content" rows="10" cols="50">
Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus cumque assumenda vitae, reprehenderit provident beatae officia? Quam, doloremque? Et sit rem ea impedit accusamus a velit temporibus aut voluptatum voluptatibus?
  </textarea>
        </div>

        <!--        submit-->

        <div class="submit-btns">
          <button  class="submit" type="submit">Submit</button>
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
  name: "SubmitPostModal",

  setup(props, { emit }) {
    const store = useStore();
    const post = ref({
      title: "" ,
      content: ""
      
    });

    const submit = async () => {
    await store.dispatch("post/submitPost" , post.value)
    
    }



    const close = () => {
      return emit("close");
      console.log('cacel');
    };
    return {
      close,
      submit,
      post
    };
  },
};
</script>
