<template>

  <Nav />
  <Hero />
  
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/navbar.vue";
import Hero from "@/components/hero.vue";
export default {
  name: "Home",
  components: {
    Nav,
    Hero,
  },

};
</script>
