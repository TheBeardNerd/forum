<template>
  <div>
    <label for="avatar-input" class="d-flex align-items-center flex-column">
      <img
        class="rounded-circle"
        :class="classes"
        :src="avatar"
        alt="profile-avatar"
        width="100"
        height="100"
      />
    </label>

    <!-- Avatar Form -->
    <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <h5>Change Avatar</h5>
        <image-upload id="avatar-input" name="avatar" @loaded="onLoad"></image-upload>
      </div>
    </form>
  </div>
</template>
<script>
import ImageUpload from "./ImageUpload.vue";

export default {
  props: ["user"],

  components: { ImageUpload },

  data() {
    return {
      avatar: "/storage/" + this.user.avatar_path,
      changeAvatar: this.authorize(user => user.id === this.user.id)
    };
  },

  computed: {
    classes() {
      return [this.changeAvatar ? "change-avatar" : ""];
    },
    canUpdate() {
      return this.authorize(user => user.id === this.user.id);
    }
  },

  methods: {
    onLoad(avatar) {
      this.avatar = avatar.src;

      this.persist(avatar.file);
    },

    persist(avatar) {
      let data = new FormData();

      data.append("avatar", avatar);

      axios
        .post(`/api/users/${this.user.name}/avatar`, data)
        .then(() => flash("Avatar uploaded!"));
    }
  }
};
</script>

<style>
.change-avatar {
  cursor: pointer;
}
.change-avatar:hover {
  opacity: 0.8;
}
</style>
