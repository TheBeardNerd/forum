<template>
  <div>
    <!-- @if (auth()->check()) -->
    <!-- <form method="POST" action="{{ $thread->path() . '/replies' }}"> -->
    <!-- @csrf -->
    <div v-if="signedIn">
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
      <button type="submit" class="btn btn-info text text-white" @click="addReply">Reply</button>
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
export default {
  props: ["endpoint"],

  data() {
    return {
      body: ""
    };
  },

  computed: {
    signedIn() {
      return window.App.signedIn;
    }
  },

  methods: {
    addReply() {
      axios.post(this.endpoint, { body: this.body }).then(response => {
        this.body = "";

        flash("Your reply has been posted.");

        this.$emit("created", response.data);
      });
    }
  }
};
</script>
