<template>
  <div class="editModal">
    <div>
      <h4>EDIT USER</h4>
      <form @click.prevent="submit" action="">
        <div class="field">
          <label for="username">Username</label>
          <!-- <input type="text" v-model="user.username" /> -->
        </div>
        <div class="field">
          <label for="username">Email</label>
          <!-- <input type="text" v-model="user.email" /> -->
        </div>
        <button type="submit" @click="editUser(user)">Confirm</button>
        <button>Cancel</button>
      </form>
    </div>
  </div>
</template>

<script>
import { useStore } from "vuex";
import { computed, ref } from "@vue/runtime-core";
export default {
props:['user'],
  setup(props ) {
      const store = useStore();
    //   const zab = user;
    //  console.log(zab);

    // const user = ref({
    //     email: data.email,
    //     username : data.username
    // });
    const editUser =  () => {
    //   await store.dispatch("post/editUser", userData.value);
      console.log('yep cock' , props.users);
    };
    // const openModal = (modal) => {
    //   modalContent.value = modal;
    //   modalOpen.value = true;
    // };

    const users = computed(() => store.getters["user/ALL_USERS"]);
    
    


    // console.log(users);

    const handleClose = () => {
      modalOpen.value = false;
    };
    return {
      editUser,
      // user,
      // zab
    };
  },
};
</script>
