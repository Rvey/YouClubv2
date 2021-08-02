<template>
  <div class="da-panel">
    <Modal
      v-if="modalOpen"
      :modalContent="modalContent"
      @close="handleClose()"
    />
    <div>
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
        <tbody v-for="user in users" :user="user" :key="user.id">


          <tr :class="toggle ? 'block' : 'hidden'">

            <td data-label="Username">  {{ user?.username }} </td>

            <td data-label="Email"> {{ user?.email }} </td>

            <td data-label="Joined at">{{ time(user?.created_at) }}</td>
            <td data-label="Action">
              <div class="actions">
                <i
                  class="bx bx-x-circle delete"
                  @click="DeleteUser(user.id)"
                ></i>
                <i class="bx bx-edit edit" @click="EditUser(user)"></i>
              </div>
            </td>
          </tr>



          <tr  :class="toggle ? 'hidden' : 'block'">
            <td data-label="Username">
              <input type="text" v-model="user.username" />
            </td>

            <td data-label="Email">
              <input type="text" v-model="user.email" />
            </td>
            <td data-label="Joined at">{{ time(user?.created_at) }}</td>
            <td data-label="Action">
              <div class="actions">
                <i
                  class="bx bx-x-circle delete"
                  @click="DeleteUser(user.id)"
                ></i>
                <i class="bx bx-edit edit" @click="show()"></i>
                <i class='bx bx-save' @click="EditUser(user)" ></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import Stats from "@/components/Cards/statsCard.vue";
// import Table from "@/components/table.vue";
import { useStore } from "vuex";
import moment from "moment";
import Modal from "@/components/Modals/Modal.vue";
import { computed, onMounted, ref } from "@vue/runtime-core";
export default {
  components: {
    Stats,
    Modal,
  },
  setup() {
    const store = useStore();
    // const user = props.user;
    const modalContent = ref("");
    const modalOpen = ref(false);
    const toggle = ref(true);

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
      return moment(date)
        .subtract(10, "days")
        .calendar();
    };

    const show = () => {
      toggle.value = !toggle.value;
    };

    const DeleteUser = (index) => {
      store.dispatch("user/DeleteUser", index);
    };
    const EditUser = (userData) => {
      store.dispatch("user/editUser", userData);
      show();
    };

    return {
      modalOpen,
      users,
      time,
      DeleteUser,
      EditUser,
      openModal,
      handleClose,
      modalContent,
      show,
      toggle,
      // user,
    };
  },
};
</script>
