<template>
 <div class="flex flex-col gap-6">
          <label class="text-lg font-bold" for="Post title">Category</label>
          <div class="flex gap-6">
            <div v-for="tag in tags" :key="tag.id">
              <div class="flex items-center gap-8">
                <label class="inline-flex items-center">
                  <input
                    type="radio"
                    class="h-5 w-5 text-red-600"
                    v-bind:value="tag.tagName"
                    v-model="post.tags"
                    @click="checkone"
                  />
                  <span class="ml-2 text-gray-700">
                    <label for="{{ tag.tagName }}">{{ tag.tagName }}</label>
                  </span>
                </label>
              </div>
            </div>
          </div>
 </div>
</template>
<script>
import { onMounted } from "vue";
export default {
  setup() {
       onMounted(() => {
      store.dispatch("tags/getTags");
      console.log(tag.tagName);
    });
  },
}
</script>