<template>

  <div class="slide-create ">
    <form class="flex h-full flex-col gap-6 " enctype="multipart/form-data">
      <img
        class="imagePreview"
        v-if="Boolean(thumbnailData)"
        :src="thumbnailData"
      />

      <input type="file" class="file" accept="image/*" @change="onFileChange" />

      <div class="flex flex-col gap-3">
        <label class="text-lg font-bold" for="Post title">Post title</label>
        <input type='text' class="w-full mt-2 mb-6 px-6 py-3 border rounded-lg text-lg text-gray-700 focus:outline-none" v-model="post.title" />  
      </div>



      
        <div class="flex flex-col gap-6">
          <label class="text-lg font-bold" for="Post title">Category</label>
          <div class="flex gap-6">
            <div v-for="tag in tags" :key="tag.id">
              <!-- <input
            type="checkbox"
            v-bind:value="tag.tagName"
            v-model="post.tags"
            @click= "checkone"
          /> -->

              <div class="flex items-center gap-8">
                <label class="inline-flex items-center">
                  <input
                    type="radio"
                    class="h-5 w-5 text-red-600"
                    v-bind:value="tag.tagName"
                    v-model="post.tags"
                    @click="checkone"
                  />
                  <span class="ml-2 text-gray-700">
                    <label for="{{ tag.tagName }}">{{ tag.tagName }}</label>
                  </span>
                </label>
              </div>
            </div>
          </div>
          
       



        <div clas>
          <Tiptap v-model="post.content"  />
        </div>
      </div>

      <!--        submit-->
      <div class="flex justify-end align-bottom gap-3">
        <button
          @click.prevent="submit()"
          class="bg-green-500 hover:bg-green-600 px-6 py-2 text-gray-100 font-semibold rounded-md"
          type="submit"
        >
          Submit
        </button>
        <button
          @click.prevent="close"
          class="bg-red-400 hover:bg-red-500 text-white px-6 py-2 font-semibold whitespace-normal rounded-md"
        >
          cancel</button
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
      post.tags = [];
    };

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
      onFileChange,
      thumbnailData,
      tags,
      tag,
      checkedNames,
      checkone,
    };
  },
};
</script>
