<template>
  <transition name="fade">
    <div class="alert alert-success alert-flash" role="alert" v-show="show">
      <strong>Success!</strong>
      {{ body }}
    </div>
  </transition>
</template>

<script>
import { setTimeout } from "timers";
export default {
  props: ["message"],

  data() {
    return {
      body: "",
      show: false
    };
  },

  created() {
    if (this.message) {
      this.flash(this.message);
    }

    window.events.$on("flash", message => this.flash(message));
  },

  methods: {
    flash(message) {
      this.body = message;
      this.show = true;

      this.hide();
    },
    hide() {
      setTimeout(() => {
        this.show = false;
      }, 3000);
    }
  }
};
</script>

<style>
.alert-flash {
  position: fixed;
  bottom: 25px;
  right: 25px;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
