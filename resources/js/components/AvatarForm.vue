<template>
  <div>
    <img class="rounded-circle" :src="avatar" alt="profile-avatar" width="100" height="100" />

    <!-- Avatar Form -->
    <form v-if="canUpdate" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <input
          name="avatar"
          type="file"
          class="form-control-file mb-2"
          accept="image/*"
          @change="onChange"
        />
        <button type="submit" class="btn btn-info">Add Avatar</button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props: ["user"],

  data() {
    return {
      avatar: this.user.avatar_path
    };
  },

  computed: {
    canUpdate() {
      return this.authorize(user => user.id === this.user.id);
    }
  },

  methods: {
    onChange(e) {
      if (!e.target.files.length) return;

      let avatar = e.target.files[0];

      let reader = new FileReader();

      reader.readAsDataURL(avatar);

      reader.onload = e => {
        this.avatar = e.target.result;
      };

      this.persist(avatar);
    },

    persist() {
      let data = new FormData();

      data.append("avatar", avatar);

      axios
        .post(`/api/users/${this.user.name}/avatar`, data)
        .then(() => flash("Avatar uploaded!"));
    }
  }
};
</script>
