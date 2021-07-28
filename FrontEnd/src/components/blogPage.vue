<template>
  <div class="body">
    <div>
      <div class="socials">
        <Comment />
        <Like />
      </div>
      <div class="blog-wrapper">
        <div class="blog">
          <div class="blog-category">
            Tech
          </div>
          <div class="blog-title">
            HMMMMMMMMMM
          </div>

          <div class="blog-p">
            <div class="blog-author">
              By RedOne
            </div>
            <div class="blog-time">
              12/12/28 at 18:33
            </div>
          </div>

          <div class="a-i">
            <div class="blog-image">
              <img src="../assets/bg.jpg" alt="" />
            </div>

            <div class="blog-article">
              
            </div>
          </div>
        </div>
      </div>
      <Scomment />
    </div>
  </div>
</template>
<script>
import Like from "@/components/Misc/comment.vue";
import Comment from "@/components/Misc/like.vue";
import Scomment from "@/components/commentSection.vue";

export default {
  name: "editPostModal",
  props: ["data"],
  components: {
    Like,
    Comment,
    Scomment,
  },
  setup() {},
};
</script>
<style></style>
