<template>
  <div class="dropdown" v-if="notifications.length">
    <a
      id="notificationMenuButton"
      class="btn btn-link dropdown-toggle"
      href="#"
      role="button"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      v-pre
    >
      <i class="fas fa-bell fa-lg text-danger"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationMenuButton">
      <div v-for="notification in notifications">
        <a class="dropdown-item"
            :href="notification.data.link"
            v-text="notification.data.message"
            @click="markAsRead(notification)"
        ></a>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        data() {
            return { notifications: false }
        },
        created() {
            axios.get('/profiles/' + window.App.user.name + '/notifications')
                .then(response => this.notifications = response.data);
        },
        methods: {
            // "/profiles/{$user->name}/notifications/" . $user->unreadNotifications->first()->id

            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }
    }
</script>
