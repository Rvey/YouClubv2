<template>
  <div class="all-tags gap-4">
    <div class=" text-black font-semibold">
      Category
    </div>
    <div class="text-gray-700 md:flex md:items-center gap-2 ">
      <div class="md:w-2/3 md:flex-grow ">
        <input
          class="w-full mt-2 h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline"
          type="text"
          placeholder="Enter category name"
          v-model="tag.tagName"
        />
      </div>
      <button
        class="p-2 px-3 mt-2 rounded-md bg-blue-400 text-white font-medium hover:bg-blue-500"
        @click.prevent="submitTag(tag)"
      >
        Submit
      </button>
    </div>

    <div class="flex flex-row gap-2 flex-wrap">
      <div v-for="tag in tags" :key="tag.id">
        <div
          class="bg-gray-300 rounded-md  text-gray-700 m-2 flex gap-2 align justify-center max-w-max p-2"
          @click.prevent="show"
        >
          {{ tag?.tagName }}
          <button class="text-gray-700 font-bold " @click="deleteTag(tag?.id)">
            x
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useStore } from "vuex";
import { ref, computed, onMounted } from "vue";
export default {
  setup() {
    const store = useStore();

    const tag = ref({
      tagName: "",
    });
    onMounted(() => {
      store.dispatch("tags/getTags");
    });

    const Admin = computed(() => store.getters["auth/Admin"]);

    const tags = computed(() => store.getters["tags/ALL_TAGS"]);

    const valid = ref(false);

    const show = () => {
      valid.value = !valid.value;
      console.log(valid.value);
    };

    const ehe = () => {
      // console.log('sdfsdf')
      store.dispatch("tags/getTags");
    };
    const submitTag = async (data) => {
      await store.dispatch("tags/submitTag", data);
      //  store.dispatch("getTags");
    };
    const deleteTag = async (id) => {
      await store.dispatch("tags/deleteTag", id);
      console.log(id);
    };

    return {
      submitTag,
      tags,
      tag,
      ehe,
      deleteTag,
      valid,
      show,
      Admin,
    };
  },
};
</script>
