<template>
  <!-- <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      @close="handleClose()"
    /> -->
  <div ref="modal">
    <form class="form" enctype="multipart/form-data">
      <img class="imagePreview" v-if="Boolean(thumbnailData)" :src="thumbnailData" />

      <input type="file" class="file" accept="image/*" @change="onFileChange" />

      <div class="field">
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
import { ref, watch } from "vue";
import { file_blob } from "@/util";
// import { useImageUpload } from "@/components/consomable/useImageUpload.js";
export default {
  name: "SubmitPostModal",

  setup(props, { emit }) {
    const store = useStore();

    // const imagefile = ref("");
    // const imageUrl = ref("");

    const post = ref({
      title: "",
      content: "",
      image: null,
    });

    const thumbnailData = ref(null);

    const submit = async () => {
      let formData = new FormData();

      Object.keys(post.value).forEach(k => {
        formData.append(`${k}`, post.value[`${k}`]);
      })
      await store.dispatch("post/submitPost", formData);
      emit('close');
    };

    const onFileChange = async (e) => {
      thumbnailData.value = await file_blob(e.target.files[0]);
      post.value.image = e.target.files[0];
    };

    // const image = {
    //   file: "",
    // };

    // function imageHandler(event) {
    //     //   const cc =  post.yep = e.target.files[0].name;
    //     //  return cc ;
    //     console.log(event);
    // }

    // const imageHandler = (e) => {
    //   // if (e.target.files.lenght === 0) {
    //   //   imagefile.value = "";
    //   //   imageUrl.value = "";
    //   //   return;
    //   // }

    //   var cc = (post.yep = e.target.files[0].name);

    //   document.querySelector(".input").value = cc;
    //   post.yep = cc;

    //   console.log(post.yep);
    // };

    // show selected image

    // watch(imagefile, (imagefile, e) => {
    //   if (!(imagefile instanceof File)) {
    //     return;
    //   }

    //   const fileReader = new FileReader();

    //   fileReader.readAsDataURL(imagefile);

    //   fileReader.addEventListener("load", () => {
    //     imageUrl.value = fileReader.result;
    //   });
    // });

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
      thumbnailData
    };
  },
};
</script>
