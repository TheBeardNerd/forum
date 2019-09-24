<template>
  <div>
    <label for="avatar-input">
      <img class="rounded-circle" :src="avatar" alt="profile-avatar" width="100" height="100" />
    </label>

    <!-- Avatar Form -->
    <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
      <div class="form-group">
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
      avatar: "/storage/" + this.user.avatar_path
    };
  },

  computed: {
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
