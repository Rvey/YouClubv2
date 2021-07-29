<template>
  <div class="t">
    <h4>77 Comments</h4>

  <CommentForm />

    <div class="comments">
      <div class="user-avatar">
        <img src="./../assets/bg.jpg" alt="" />
      </div>

      <div class="com-wrapper">
        <div class="user-com">
          <div class="user-name">RedOne</div>
          <div class="time">3 days ago</div>
        </div>
        <div class="com">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus,
          libero iure quo debitis temporibus placeat autem alias cupiditate
          officiis excepturi consequuntur, sit molestias consequatur numquam
          sequi et rem impedit saepe ipsam nostrum neque sint illum ducimus!
          Explicabo deserunt optio reiciendis?
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CommentForm from "@/components/Posts/Form/commentForm.vue";
export default {
components : {
CommentForm
},
setup() {},
};
</script>
<style></style>
