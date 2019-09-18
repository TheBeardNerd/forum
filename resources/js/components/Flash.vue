<template>
  <transition name="fade">
    <div class="alert alert-flash" :class="'alert-'+level" role="alert" v-show="show" v-text="body"></div>
  </transition>
</template>

<script>
import { setTimeout } from "timers";
export default {
  props: ["message"],

  data() {
    return {
      body: "",
      level: "success",
      show: false
    };
  },

  created() {
    if (this.message) {
      this.flash(this.message);
    }

    window.events.$on("flash", data => this.flash(data));
  },

  methods: {
    flash(data) {
      this.body = data.message;
      this.level = data.level;
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
