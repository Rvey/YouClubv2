<template>
  <div class="body">
    <h2>Top trending</h2>

    <!-- card -->
    <div class="post-card">
      <div>
        <img class="img" src="../assets/bg.jpg" alt=""/>
      </div>
      <div class="card_content">
        <div class="info">
          <h5>by RedOne</h5>
          <h5>Time</h5>
          <h5>category</h5>
        </div>
        <div class="card_body">
          <h2>article title</h2>
          <p>
            article body <br/>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis
            dolore, neque tempora minus consequuntur pariatur laborum quam nihil
            assumenda, praesentium illum minima aspernatur, deleniti quod.
          </p>
        </div>
        <div class="socialize">
          <div class="More">
            <a href="">Read More</a>
          </div>

          <div class="btns">
            <div class="add" @click="bonk" :class="add ? 'plus' : 'minos '"><i
                class="bx bx-bookmark-alt-plus green"></i>
            </div>
            <div class="remove" @click="bonk" :class="add ? 'minos ' : 'plus'"><i
                class="bx bx-bookmark-alt-minus red"></i>
            </div>
            <div class="like">
              <div class="like"><i @click="like" :class="isLiked ? 'bx-like' : 'bxs-like '" class="bx " ></i></div>
            </div>
            <div class="likes-counter">{{ count }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {ref} from "vue";

export default {
  setup() {
    const add = ref(true);
    const count = ref(0);
    const isLiked = ref(true);
    const bonk = () => {
      add.value = !add.value;
    };

    const like = () => {
      if (count.value === 0) {
        count.value++
      } else {
        count.value--
      }
      isLiked.value = !isLiked.value

    }
    return {
      count,
      isLiked,
      add,
      like,
      bonk,

    }
  }
};

</script>