<template>
  <VuePerfectScrollbar class="scroll-area" v-once :settings="settings" @ps-scroll-y="scrollHanle">
    <slot></slot>
  </VuePerfectScrollbar>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";

export default {
  components: {
    VuePerfectScrollbar
  },
  data() {
    return {
      settings: {
        maxScrollbarLength:1
      }
    };
  },
  methods: {
    scrollHanle(evt) {
      console.log(evt);
    }
  }
};
</script>
