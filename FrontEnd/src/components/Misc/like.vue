<template>
  <div>
  <div class="like-s dim" @click="postLike(likes)" >
    <svg
      class="w-6 h-6"
      fill="none"
      stroke="currentColor"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"
      ></path>
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"
      ></path>
    </svg>
  </div>
  <div>
    <p class="counter">{{ count }}</p>
  </div>
  </div>
</template>
<script>
import { ref } from "@vue/reactivity";
import { useStore } from "vuex";
export default {

  setup() {
    const store = useStore();
    const count = ref(0);
    const likes = ref({
      likes : count
    })
    const isLiked = ref(true);
    const like = () => {
      if (count.value === 0) {
        count.value++;
      } else {
        count.value--;
      }
      isLiked.value = !isLiked.value;
    };

    const postLike = async (likeCount) => {
     await store.dispatch("likes/submitLikes" , likeCount);
     like()
     console.log(likes.value);
     
      console.log('tt ' , likeCount);
    }
    return {
      count,
      isLiked,
      like,
      postLike,
      likes
    };
  },
};
</script>
<style lang="scss">
.red {
  color: rgb(153, 153, 153);
}
.dim {
  color: rgb(255, 62, 62);
}
.counter {
    text-align: center;
    font-weight: 600;
}
</style>
