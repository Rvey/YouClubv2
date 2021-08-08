<template>
  <div class="da-title">
        Category
      </div>
      <div class="all-tags" >



  <div class="input">
  <input type="text" v-model="tag.tagName" />
  <button @click.prevent="submitTag(tag)">submit</button>
<button @click.prevent="ehe()">ehe</button>
</div>

  <div class="bt"  v-for="tag in tags" :key="tag.id" >
    <button @click.prevent="show">{{ tag?.tagName }}</button>
    <button @click="deleteTag(tag?.id)">delete</button>
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
     store.dispatch("tags/getTags")
    });

     const Admin = computed(() => store.getters["auth/Admin"]);

    const tags = computed(() => store.getters["tags/ALL_TAGS"]);

    const valid = ref(false);
    
    const show = () => {
      valid.value = !valid.value;
      console.log(valid.value)
    }

    const ehe = () => {
      // console.log('sdfsdf')
      store.dispatch("tags/getTags");
      
    }
    const submitTag = async (data) => {
      await store.dispatch("tags/submitTag", data);
          //  store.dispatch("getTags");
    };
    const deleteTag = async (id) => {
      await store.dispatch("tags/deleteTag" , id)
      console.log(id)
    }

    return {
      submitTag,
      tags,
      tag,
      ehe,
      deleteTag,
      valid,
      show,
      Admin
    };
  },
};
</script>
