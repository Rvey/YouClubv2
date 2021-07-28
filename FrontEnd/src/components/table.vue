<template>
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
    <tbody>
      <tr>
        <td data-label="Username">1</td>
        <td data-label="Email">red@gmail.com</td>
        <td data-label="Joined at">12/23/2025</td>
        <td data-label="Action">
          <div class="actions">
              <i  class="bx bx-x-circle delete"></i>
           
            <i class="bx bx-edit edit"></i>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  </div>
</template>
<style></style>

<script>
export default {
  setup() {},
};
</script>
