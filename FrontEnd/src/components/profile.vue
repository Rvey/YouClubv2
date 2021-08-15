<template>
  <div class="body m-0 md:ml-24 pt-7">
    <!-- <div class="text-3xl font-bold">
      My Profile
    </div>
    <div class="md:grid grid-cols-4 grid-rows-2  bg-white gap-2 p-4 rounded-xl">
      <div class="md:col-span-1 h-48 shadow-xl ">
        <div class="flex w-full h-full relative">
          <img
            src="https://res.cloudinary.com/dboafhu31/image/upload/v1625318266/imagen_2021-07-03_091743_vtbkf8.png"
            class="w-44 h-44 m-auto"
            alt=""
          />
        </div>
      </div>

    
      <div class="md:col-span-3 h-48  p-4 space-y-2">
        <div class="flex ">
          <span
            class="text-sm bg-blue-50 font-bold uppercase rounded-l px-4 py-2 whitespace-no-wrap w-2/6"
            >Name:</span
          >
          <input
            class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
            type="text"
            v-model="username" 
            v-if="toggle"
          />
          <input v-if="edit" type="text" v-model="user.username" />
          <div class="flex gap-3">
           <button @click.prevent="show">edit</button>
            <button  @click.prevent="EditUser(user)">save</button>

          </div>
        </div>
        <div class="flex ">
          <span
            class="text-sm border bg-blue-50 font-bold uppercase rounded-l px-4 py-2 bg-gray-50 whitespace-no-wrap w-2/6"
            >Email:</span
          >
          <input
            class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none  rounded-md rounded-l-none  -ml-1 w-4/6"
            type="text"
            v-model="email"
          />
          <input type="text" v-model="user.email">
          <div class="flex gap-3">
           <button @click.prevent="EditUser(user)">edit</button>
            <button @click.prevent="EditUser">save</button>

          </div>
        </div>
      </div>
      <div class="md:col-span-3 h-48  p-4 space-y-2 hidden md:block bg-blue-100">
        <h3 class="font-bold uppercase">Profile Description</h3>
        <p >

        </p>
      </div>
    </div> -->
    <div class="text-3xl font-bold">
      My Posts
    </div>
    <!-- <p>{{ userPosts.content }}</p> -->
    <div v-for="Post in userPosts" :key="Post.id">
      <div class=" p-4 bg-gray-100 m-4 hover:w-10 space-y-3">
        <!-- <input v-model="Post.id" /> -->
        <p class="font-semibold capitalize text-xl">{{ Post.title }}</p>
        <p class="bg-gray-200 p-2 rounded-lg">{{ strip(Post.content) }}</p>
        <div class="flex gap-4">

        <div class="p-2 bg-gray-400 w-min rounded-md text-white font-medium hover:bg-gray-500">

        <router-link class=""  @click="single" :to="{ name: 'BlogPage', params: Post }">
          ReadMore
        </router-link>
        </div>
         <div >
            <i
              @click.prevent="deletePost(Post.id)"
              class="bx bx-trash-alt transition duration-500 ease-in-out hover:text-red-600  text-red-500 text-3xl ; cursor-pointer"
            ></i>
          </div>
        </div>

           
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
      store.dispatch("post/userPosts", userId.value);
    });

    const store = useStore();
    const email = computed(() => store.state.auth.user?.email);
    const username = computed(() => store.state.auth.user?.username)
    const admin = computed(() => store.getters["auth/Admin"]);
    const userId = computed(() => store.getters["auth/userId"]);
    const userPosts = computed(() => store.getters["post/CURRENT_USERPOST"]);
    const post = computed(() => store.getters["post/CURRENT_POST"]);
    const thumbnailData = ref(null);
    const toggle = ref(true);


    const show = () => {
      toggle.value = !toggle.value
      console.log(toggle.value);
    }

    const strip = (data) => {
      return data.replace(/(<([^>]+)>)/gi, "");
    };
    const onFileChange = async (e) => {
      thumbnailData.value = await file_blob(e.target.files[0]);
      user.value.image = e.target.files[0];
    };
      const deletePost = async (post) => {
      await store.dispatch("post/deletePost", post);
      console.log(post);
    };
      const EditUser = (userData) => {
      store.dispatch("user/editUser", userData);
     show()
    };

    return {
      user,
      username,
      email,
      userId,
      thumbnailData,
      onFileChange,
      EditUser,
      admin,
      userPosts,
      post,
      strip,
      toggle,
      show,
      deletePost
      // id
    };
  },
};
</script>
