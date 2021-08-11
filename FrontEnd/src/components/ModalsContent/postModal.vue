<template>
  <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      @close="handleClose()"
    />
  <div ref="modal">
    <form class="form" enctype="multipart/form-data">
      <img
        class="imagePreview"
        v-if="Boolean(thumbnailData)"
        :src="thumbnailData"
      />

      <input type="file" class="file" accept="image/*" @change="onFileChange" />

      <div class="field">
        <label for="Post title">Post title</label>
        <input v-model="post.title" type="text" />
      </div>

      <div class="field">
        <label for="Post title">Post content</label>
        <div v-for="tag in tags" :key="tag.id">
          <input
            type="checkbox"
            v-bind:value="tag.tagName"
            v-model="post.tags"
            @click= "checkone"
          />
          <label for="{{ tag.tagName }}">{{ tag.tagName }}</label>
        </div>

        <br />
        <span>Checked names: {{ post.tags }}</span>

        <Tiptap v-model="post.content" />
      </div>

      <!--        submit-->
      <div class="btns">
        <button @click.prevent="submit()" class="submit" type="submit">
          Submit
        </button>
        <button @click.prevent="close" class="cancel">cancel</button
        >{{ post.yep }}
      </div>
    </form>
  </div>
</template>
<script>
import { useStore } from "vuex";
import { ref, watch, computed, onMounted } from "vue";
import { file_blob } from "@/util";
import Tiptap from "@/components/tiptap.vue";

export default {
  name: "SubmitPostModal",
  components: {
    Tiptap,
  },
  setup(props, { emit }) {
    const store = useStore();

    onMounted(() => {
      store.dispatch("tags/getTags");
      console.log(tag.tagName);
    });

    const checkedNames = ref([]);

    const tag = ref({
      tagName: "",
    });

    const post = ref({
      title: "",
      content: "",
      image: null,
      tags: ref([]),
    });

    const thumbnailData = ref(null);

    const checkone = () => {
      post.tags = []
    }



    const submit = async () => {
      let formData = new FormData();

      Object.keys(post.value).forEach((k) => {
        formData.append(`${k}`, post.value[`${k}`]);
      });
      await store.dispatch("post/submitPost", formData);

      emit("close");
    };

    const tags = computed(() => store.getters["tags/ALL_TAGS"]);

    const onFileChange = async (e) => {
      thumbnailData.value = await file_blob(e.target.files[0]);
      post.value.image = e.target.files[0];
    };

    const close = () => {
      return emit("close");
    };
    return {
      close,
      submit,
      post,
      // imageHandler,
      // imageUrl,
      // imagefile,
      onFileChange,
      thumbnailData,
      tags,
      tag,
      checkedNames,
      checkone
    };
  },
};
</script>
