<template>
  <div class="f">
    <div class="profile-wrapper">
      <div class=" ehe">Your Profile</div>
      <div class="profile-settings">
        <form enctype="multipart/form-data" >
          <div class="flex justify-center -mt-8">
            <div class="">
              <img
                id="preview"
                v-if="Boolean(thumbnailData)"
                :src="thumbnailData"
                class="rounded-full w-40 h-40 border-blue-300 border-8 "
              />
            </div>
          </div>
          <div class="text-center px-3 pb-6 pt-2">
            <h3 class="text-white text-sm bold font-sans">Olivia Dunham</h3>
            <p class="mt-2 font-sans font-light text-black">
              <input
                type="file"
                class="file absolute top-86 w-10 h-10  bg-red-500 rounded-full opacity-100 "
                accept="image/*"
                @change="onFileChange"
              />
              Hello, i'm from another the other side!
            </p>
          </div>
        </form>

        <div class="cover">
          <form enctype="multipart/form-data">
            <div class="">
              <img
                id="preview"
                v-if="Boolean(thumbnailData)"
                :src="thumbnailData"
                class="absolute inset-0 h-full w-2 rounded-full bg-green-500 object-cover"
              />
            </div>
            <input type="text" v-model="user.username" />
            <input type="text" v-model="user.email" />
          <button @click.prevent="EditUser">save</button>
          </form>
        </div>
        <div class="user">
          <div class="username">
            Username : {{ username }} <i class="bx bx-edit edit"></i>
          </div>
          <div class="Email">
            Email : {{ email }} <i class="bx bx-edit"></i>
          </div>

        </div>
      </div>
    </div>

    <div class="pspace">
      <div class="bookmarks">
        <div class="ii"><i class="bx bxs-upvote"></i>Up votes</div>

        <div class="btn-da">></div>
      </div>

      <div class="bookmarks">
        <div class="ii"><i class="bx bxs-bookmark"></i> Bookmarks</div>
        <div class="btn-da">></div>
      </div>

      <div class="bookmarks">
        <div class="ii"><i class="bx bxl-audible"></i>My pots</div>
        <div class="btn-da">></div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, ref, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import { file_blob } from "@/util";
export default {
  setup() {
    const user = ref({
      username: "",
      email: "",
      image: null,
    });

    onMounted(() => {
      store.dispatch("user/single", userId);
    });
  
    const store = useStore();

    const email = computed(() => store.state.auth.user?.email);
    const username = computed(() => store.getters["auth/userName"]);
    const userId = computed(() => store.getters["auth/userId"]);

    const thumbnailData = ref(null);

    const onFileChange = async (e) => {
      thumbnailData.value = await file_blob(e.target.files[0]);
      user.value.image = e.target.files[0];
    };

    const EditUser = async () => {
      let formData = new FormData();

      // Object.keys(user.value).forEach((k) => {
      //   formData.append(`${k}`, user.image[`${k}`]);
      // });
      await store.dispatch("user/editUser", formData);
     
    };

    return {
      user,
      username,
      email,
      userId,
      thumbnailData,
      onFileChange,
      EditUser,
    };
  },
};
</script>
