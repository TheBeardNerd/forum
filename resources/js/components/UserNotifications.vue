<template>
  <div class="dropdown" v-if="notifications.length">
    <a
      id="notificationMenuButton"
      class="nav-link"
      href="#"
      role="button"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      v-pre
    >
      <i class="fas fa-bell fa-lg text-danger"></i>
    </a>
    <div class="dropdown-menu" aria-labelledby="notificationMenuButton">
      <div v-for="notification in notifications">
        <a class="dropdown-item" href="#">Foobar</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notifications: ["asdf"]
    };
  },

  created() {
    axios
      .get("/profiles/" + window.App.user.name + "/notifications")
      .then(response => this.notifications = response.data);
  }
};
</script>
