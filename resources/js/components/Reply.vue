<template>
  <div :id="'reply-'+id" class="card mb-2">
    <div class="card-header" :class="isBest ? 'bg-success' : ''">
      <div class="level">
        <h6 class="flex">
          <a :href="'/profiles/'+reply.owner.name" v-text="reply.owner.name"></a>
          <i class="fas fa-chevron-right fa-xs mx-1"></i>
          <span v-text="ago"></span>
        </h6>

        <div class="level">
          <div v-if="signedIn">
            <favorite :reply="reply"></favorite>
          </div>

          <div v-if="authorize('owns', reply)">
            <button
              type="button"
              class="btn btn-outline-dark btn-sm mr-1"
              @click="editing = true"
            >Edit</button>
            <button type="button" class="btn btn-outline-danger btn-sm mr-1" @click="destroy()">
              <i class="far fa-trash-alt"></i>
            </button>
            <button
              type="button"
              class="btn btn-outline-dark btn-sm"
              @click="markBestReply"
              v-if="authorize('owns', reply.thread)"
            >
              <i class="fas fa-check"></i>
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

      <div v-else v-html="body"></div>
    </div>
  </div>
</template>

<script>
import Favorite from "./Favorite.vue";
import moment from "moment";

export default {
  props: ["reply"],

  components: { Favorite },

  data() {
    return {
      editing: false,
      id: this.reply.id,
      body: this.reply.body,
      isBest: this.reply.isBest
    };
  },

  computed: {
    ago() {
      // "Z" uses moment to correct timestapm from UTC
      return moment(this.reply.created_at + "Z").fromNow() + "...";
    }
  },

  created() {
    window.events.$on("best-reply-selected", id => {
      this.isBest = id === this.id;
    });
  },

  methods: {
    update() {
      axios
        .patch("/replies/" + this.id, {
          body: this.body
        })
        .catch(error => {
          this.body = this.reply.body;
          flash(error.response.data, "danger");
        });

      this.editing = false;

      flash("Updated!");
    },
    cancel() {
      this.editing = false;

      this.body = this.reply.body;
    },
    destroy() {
      axios.delete("/replies/" + this.id);

      this.$emit("deleted", this.id);
    },
    markBestReply() {
      axios.post("/replies/" + this.id + "/best");

      window.events.$emit("best-reply-selected", this.id);
    }
  }
};
</script>
