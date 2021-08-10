<template>
  <Sidebar />
  <i class="addpost text-red-400  text-4xl bx bx-right-arrow-alt z-50"  v-if="toggle" @click="show"></i>
  <NewPost class="h-screen" :class="toggle ? 'activeP' : 'not-activeP'" />
  <Cbody />
  <div class="hidden md:block">
  <button class="addpost text-3xl  text-red-400 bottom-19" v-if="!toggle" @click="show">
    <i class="bx bx-plus-circle rounded-full text-white bg-blue-500 p-3"></i>
  </button>
   <button class="addpost text-4xl  " v-if="toggle" @click="show">
    <i class="text-red-400  bx bx-right-arrow-alt"></i>
  </button>
</div>
<!-- mobile nav  -->

    <div class="fixed bottom-0 right-0 left-0  h-20 flex items-center bg-white md:hidden ">
      <div class="flex  w-full justify-center">
        <ul class="w-full flex justify-around items-center text-4xl list-none p-0 ">
          <li class="">
            <router-link to="/" class="active"><i class='bx bx-home shadow-xl' ></i></router-link>
          </li>
          <li>
            <router-link to="/Dashboard">
            <i class='bx bxs-dashboard text-gray-700 '>
              </i></router-link>
          </li>
          <li class=" rounded-full">

    <i class="bx bx-plus-circle rounded-full text-white bg-blue-500 p-3"  v-if="!toggle" @click="show"></i>

    


            
          </li>
          <li>
            <router-link to="/Login"><i class='bx bx-user-circle text-gray-700' ></i></router-link>
          </li>

          <li>
            <i class='bx bx-log-in-circle text-gray-700 ' @click.prevent="logout()"></i>
          </li>
        </ul>
      </div>
    </div>


</template>
<script>
import Sidebar from "@/components/sidebar.vue";
import Cbody from "@/components/cbody.vue";
import NewPost from "@/components/newPost.vue";
import MobileNav from "@/components/mobilenav.vue"
import { computed, ref } from "vue";
export default {
  components: {
    Sidebar,
    Cbody,
    NewPost,
    MobileNav
  },
  props:["toggle"],
  setup(props) {
    const toggle = ref(false);
    const show = () => {
      toggle.value = !toggle.value;
    };
    return {
      toggle,
      show,
    };
  },
};
</script>
<style></style>
