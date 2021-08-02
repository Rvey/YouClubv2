<template>
  <div>
    <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      @close="handleClose()"
    />
    <div ref="modal">
      <form>
        <div>
          <div class="image">
            <input type="file" id="file" accept="images" />
            <label for="file" class="label">
              <i class="bx bxs-image-add"></i> Upload Image</label
            >
          </div>
        </div>
        <div>
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

        <div>
          <button @click.prevent="submit" class="submit" type="submit">
            Submit
          </button>
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
      title: "",
      content: "",
    });

    const submit = async () => {
      await store.dispatch("post/submitPost", post.value);
    };

    const close = () => {
      return emit("close");
    };
    return {
      close,
      submit,
      post,
    };
  },
};
</script>
