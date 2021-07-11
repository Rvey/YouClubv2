<template>
  <div class="container" :class="slide ? 'sign-up-mode' : 'sign-in-mode'">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="#" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" placeholder="Email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" required />
          </div>

          <input type="submit" value="Login" class="btn solid" />
        </form>
        <form action="#" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="fullName" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Cornfirm Password" required />
          </div>
          <input type="submit" class="btn" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
            ex ratione. Aliquid!
          </p>
          <button @click.prevent="move()" class="btn transparent">
            Sign up
          </button>
        </div>
        <img src="../assets/Saly-1.svg" class="image" alt="dfghdfgh" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
            laboriosam ad deleniti.
          </p>
          <button @click.prevent="move()" class="btn transparent">
            Sign in
          </button>
        </div>
        <img src="../assets/Saly-1.svg" class="image" alt="gfhdfgh" />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      slide: false,
    };
  },

  methods: {
    move: function () {
      this.slide = !this.slide;
    },
  },
};
</script>

<style lang="scss">
@import "/form.scss";
</style>