<template>
  <div class="t mt-4 ">
    <form action="">
      <textarea
        name=""
        id=""
        cols="30"
        rows="10"
        v-model="Comment.content"
      ></textarea>
      <div class="c-btn">
        <button @click.prevent="SendComment " class="comment bg-gray-400 mt-3">COMMENT</button>
        <!-- <button class="cancel ">Cancel</button> -->
      </div>
    </form>
    <h4 class="font-bold mt-6 text-2xl">Comments</h4>
    <div
      v-for="comment in comments"
      :comment="comment"
      :key="comment.id"
      class="comments  p-3 rounded-md w-full"
    >
      <div class="bg-gray-300 w-full rounded-md p-2" v-if="comment.post_id == id">
        <div class="com-wrapper w-full">
          <div class="w-full">
            <div class="user-com space-y-1">
              <div class="user-name font-semibold">
                {{ comment?.user.username }}
              </div>
              <div class="time font-bold text-gray-400">
                {{ time(comment?.created_at) }}
              </div>
            </div>
            <div class="m-2">

              <div class="break-all bg-gray-500 p-3 rounded-md text-white ">
                {{ comment.content }}
              </div>

              <div>
                <input
                  v-model="Comment.content"
                  :class="show ? 'block' : 'hidden'"
                  v-if="comment.id == comment.id"
                  type="text"
                  name=""
                />
              </div>

            </div>

            <div class="flex justify-end pr-3">
              <button
                v-if="comment.user_id == userId || Admin"
                class="delete "
                @click="DeleteComment(comment.id)"
              >
                Delete
              </button>
            </div>

            <!-- <button class="delete" @click="EditComment(comment)">Edit</button> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import moment from "moment";

import { useRoute } from "vue-router";
import { useStore } from "vuex";

import { computed, onMounted, ref } from "@vue/runtime-core";

export default {
  components: {},
  props: ["comment"],
  setup(props) {
    const store = useStore();
    const route = useRoute();
    const id = computed(() => route.params.id);
    const show = ref(false);
    const Comment = ref({
      content: "",
      post_id: id.value,
    });
    //  const idC = computed(() => comment.id);
    const commentID = ref({
      Cid: "",
    });
    onMounted(() => {
      store.dispatch("comments/getComments");
      console.log("userid", userId.value);
      // console.log(commentID);
      // console.log(idC.id);
    });
    const userId = computed(() => store.getters["auth/userId"]);
    const Admin = computed(() => store.getters["auth/Admin"]);
    const userName = computed(() => store.getters["auth/userName"]);
    const time = (date) => {
      //   return moment(date).format("MMM Do YY, h:mm:ss a");
      return moment(date)
        .startOf("hour")
        .fromNow();
    };

    const DeleteComment = (index) => {
      store.dispatch("comments/DeleteComment", index);
      store.dispatch("comments/getComments");
      console.log(index);
    };

    const EditComment = (commentData) => {
      store.dispatch("comments/EditComment", commentData);
      store.dispatch("comments/getComments");
      show.value = !show.value;
    };

    // const getComment = async () => {
    //   await store.despatch"("comments/getComments")
    // };
    const comments = computed(() => store.getters["comments/ALL_COMMENTS"]);

    const SendComment = async () => {
      await store.dispatch("comments/submitComment", Comment.value);
      store.dispatch("comments/getComments");
    };

    return {
      userId,
      SendComment,
      Comment,
      comments,
      store,
      time,
      id,
      EditComment,
      commentID,
      DeleteComment,
      show,
      Admin,
      userName,
    };
  },
};
</script>
