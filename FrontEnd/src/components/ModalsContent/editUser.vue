<template>
  <div class="editModal">
      <h4>EDIT USER</h4>
      <form @click.prevent="submit" action="">
    <div class="field">
      <label for="username">Username</label>
      <!-- <input type="text" v-model="user.email" /> -->
    </div>
       <div class="field">
      <label for="username">Email</label>
      <!-- <input type="text" v-model="user.email" /> -->
       </div>
    <button type="submit" @click="editUser(user)">Confirm</button>
    <button>Cancel</button>
    </form>
  </div>
</template>

<script>
import { useStore , ref } from 'vuex'
export default {
    props: ["data"],
    setup(props, {emit}) {
        const store = useStore();
        // const user = ref({
        //     email: data.email,
        //     username : data.username
        // });
        console.log(props)
        // console.log(data)

        const editUser = async () => {
            await store.dispatch("post/editUser" , userData.value)
            console.log(userData);
        }
        return {
            editUser,
            // user
        }
    },
}
</script>
