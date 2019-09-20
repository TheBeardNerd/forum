<template>
  <div :id="'reply-'+id" class="card mb-2">
    <div class="card-header bg-secondary text-white">
      <div class="level">
        <h6 class="flex">
          <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"></a>
          <i class="fas fa-chevron-right fa-xs mx-1"></i>
          <span v-text="ago"></span>
        </h6>

        <div class="level">
          <div v-if="signedIn">
            <favorite :reply="data"></favorite>
          </div>

          <div v-if="canUpdate">
            <button type="button" class="btn btn-light btn-sm mr-1" @click="editing = true">Edit</button>
            <button type="button" class="btn btn-danger btn-sm" @click="destroy()">
              <i class="far fa-trash-alt"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div v-if="editing">
        <form @submit="update">
          <div class="form-group">
            <textarea class="form-control" v-model="body" required></textarea>
          </div>

          <button type="submit" class="btn btn-info btn-sm">Update</button>
          <button type="button" class="btn btn-danger btn-sm" @click="cancel">
            <i class="fas fa-ban"></i>
          </button>
        </form>
      </div>

      <div v-else v-text="body"></div>
    </div>
  </div>
</template>

<script>
import Favorite from "./Favorite.vue";
import moment from "moment";

export default {
  props: ["data"],

  components: { Favorite },

  data() {
    return {
      editing: false,
      id: this.data.id,
      body: this.data.body
    };
  },

  computed: {
    ago() {
      // "Z" uses moment to correct timestapm from UTC
      return moment(this.data.created_at + "Z").fromNow() + "...";
    },
    signedIn() {
      return window.App.signedIn;
    },

    canUpdate() {
      return this.authorize(user => this.data.user_id == user.id);
    }
  },

  methods: {
    update() {
      axios
        .patch("/replies/" + this.data.id, {
          body: this.body
        })
        .catch(error => {
          this.body = this.data.body;
          flash(error.response.data, "danger");
        });

      this.editing = false;

      flash("Updated!");
    },
    cancel() {
      this.editing = false;

      this.body = this.data.body;
    },
    destroy() {
      axios.delete("/replies/" + this.data.id);

      this.$emit("deleted", this.data.id);
    }
  }
};
</script>
