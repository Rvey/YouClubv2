<template>

  <div class="da-panel">

    <div> <span class="text-5xl font-bold">Hi , </span> <span class="text-2xl font-semibold" >{{ user }}</span></div>
    <div class="space-y-5">
      <div class="font-semibold ">
        Members
      </div>

      <table class="border-collapse w-full rounded-xl">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Username</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Email</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">joined at</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
        </tr>
    </thead>
    <tbody v-for="user in users" :user="user" :key="user.id">
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Username</span>
              <span v-if="!edit">{{ trim(user?.username) }}</span> 
               <input v-if="edit" type="text" v-model="user.username" />
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b  block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Email</span>
             <span v-if="!edit" > {{ trim(user?.email) }}</span> 
             <input v-if="edit" type="text" v-model="user.email" />
            </td>
          	<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b  block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Joined at</span>
                <span class="rounded  py-1 px-3 text-xs ">{{ time(user?.created_at) }}</span>
             
          	</td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b  block lg:table-cell relative lg:static ">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"  >Actions</span>
                <div  class="flex justify-center gap-2">
                <div  class=" w-24 text-white rounded bg-blue-400 py-1 px-3 text-xs font-bold cursor-pointer" v-if="!edit" @click="show()">edit</div>
                <div  class=" w-24 text-white rounded bg-blue-400 py-1 px-3 text-xs font-bold cursor-pointer" v-if="edit" @click="EditUser(user)">save edit</div>
                <div  class="w-24 text-white rounded bg-red-400 py-1 px-3 text-xs font-bold cursor-pointer" @click="DeleteUser(user.id)">Remove</div>
            </div>
            </td>
        </tr>
    </tbody>
</table>
    </div>
       <Tags />
  </div>
 
</template>
<script>

// import Table from "@/components/table.vue";
import { useStore } from "vuex";
import moment from "moment";
import Modal from "@/components/Modals/Modal.vue";
import Tags from "@/components/Misc/tag.vue";
import { computed, onMounted, ref } from "@vue/runtime-core";
export default {
  components: {
 
    Modal,
    Tags
  },
  setup() {
    const store = useStore();
    const edit = ref(false);

    onMounted(() => {
      store.dispatch("user/getUsers");
    });

    const users = computed(() => store.getters["user/ALL_USERS"]);
    const user = computed(() => store.state.auth.user?.username)

    const time = (date) => {
      return moment(date)
        .subtract(10, "days")
        .calendar();
    };

    const show = () => {
      edit.value = !edit.value;
    };

    const DeleteUser = (index) => {
      store.dispatch("user/DeleteUser", index);
    };
    const EditUser = (userData) => {
      store.dispatch("user/editUser", userData);
     show()
    };
      const trim = (text) => {
      return (text.substring(0,15 ) +  "...")
    }

    return {
      users,
      time,
      DeleteUser,
      EditUser,
      show,
      edit,
      trim,
      user
    };
  },
};
</script>
