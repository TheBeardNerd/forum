<template>
  <div>
    <!-- @if (auth()->check()) -->
    <!-- <form method="POST" action="{{ $thread->path() . '/replies' }}"> -->
    <!-- @csrf -->
    <div v-if="signedIn">
      <form @submit="addReply">
        <div class="form-group">
          <textarea
            name="body"
            class="form-control"
            id="body"
            placeholder="Leave a reply"
            rows="5"
            required
            v-model="body"
          ></textarea>
        </div>
        <button type="submit" class="btn btn-info text text-white">Reply</button>
      </form>
    </div>
    <!-- </form>
    @else-->
    <p class="text-center mt-4" v-else>
      Please
      <a href="/login">sign in</a> to participate in this discussion.
    </p>
    <!-- @endif -->
  </div>
</template>


<script>
import "jquery.caret";
import "at.js";

export default {
  data() {
    return {
      body: ""
    };
  },

  mounted() {
    $("#body").atwho({
      at: "@",
      delay: 750,
      callbacks: {
        remoteFilter: function(query, callback) {
          $.getJSON("/api/users", { name: query }, function(usernames) {
            callback(usernames);
          });
        }
      }
    });
  },

  methods: {
    addReply() {
      axios
        .post(location.pathname + "/replies", { body: this.body })
        .catch(error => {
          flash(error.response.data, "danger");
        })
        .then(({ data }) => {
          this.body = "";

          flash("Your reply has been posted.");

          this.$emit("created", data);
        });
    }
  }
};
</script>
