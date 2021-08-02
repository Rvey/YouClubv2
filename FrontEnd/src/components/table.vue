<template>
  <div>
        <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      :data="user"
      @close="handleClose()"
    />
    <div class="da-title">
      Members
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Joined at</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td data-label="Username">{{ user?.username }}</td>
          <td data-label="Email">{{ user?.email }}</td>
          <td data-label="Joined at">{{ time(user?.created_at) }}</td>
          <td data-label="Action">
            <div class="actions">
              <i class="bx bx-x-circle delete" @click="DeleteUser(user.id)"></i>

              <i class="bx bx-edit edit" @click="openModal('editUserModal')"></i>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<style></style>

<script>
import { useStore } from "vuex";
import moment from "moment";
import Modal from "@/components/Modals/Modal.vue";
import { computed, onMounted , ref } from "@vue/runtime-core";
export default {
  components:{
    Modal
  },
   props: ["user"],
  setup(props) {
    const store = useStore();
    const modalContent = ref("");
     const user = props.user;
     const modalOpen = ref(false);
    onMounted(() => {
      store.dispatch("user/getUsers");
    });

    const users = computed(() => store.getters["user/ALL_USERS"]);

     const openModal = (modal) => {
      modalContent.value = modal;
      modalOpen.value = true;
    };
    
     const handleClose = () => {
      modalOpen.value = false;
    };

    const time = (date) => {
      //   return moment(date).format("MMM Do YY, h:mm:ss a");
      // return moment(date).startOf("day").fromNow();
      return moment(date)
        .subtract(10, "days")
        .calendar();
    };
    const DeleteUser = (index) => {
      store.dispatch("user/DeleteUser" , index)
    }
    const EditUser =(userData) => {
      // store.dispatch("user/EditUser" , userData)
      console.log(userData);
    }

    return {
      modalOpen,
      users,
      time,
      DeleteUser,
      EditUser,
      openModal,
      handleClose,
      modalContent,
      user
    };
  },
};
</script>
