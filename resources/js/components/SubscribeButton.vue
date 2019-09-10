<template>
  <button class="btn" :class="classes" @click="subscribe" v-text="btnText"></button>
</template>


<script>
export default {
  props: ["active"],

  data() {
    return {
      isActive: this.active
    };
  },
  computed: {
    classes() {
      return ["btn", this.isActive ? "btn-outline-info" : "btn-info"];
    },
    btnText() {
      return this.isActive ? "Unsubscribe" : "Subscribe";
    }
  },
  methods: {
    subscribe() {
      axios[this.isActive ? "delete" : "post"](
        location.pathname + "/subscriptions"
      );
      this.isActive = !this.isActive;
    }
  }
};
</script>
