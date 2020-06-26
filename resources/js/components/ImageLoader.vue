<template>
  <div ref="img">
    <div v-if="loading" class="flex items-center w-full" style="height: 100px">
      <Loader class="text-sm text-grey-darker" style="width:60px:"/>
    </div>
  </div>
</template>

<script>
const Minimum = function(originalPromise, delay = 300) {
  return Promise.all([
    originalPromise,
    new Promise(resolve => {
      //setTimeout(() => resolve(), delay);
      resolve();
    })
  ]).then(result => result[0]);
};

import Loader from "./Loader.vue";

export default {
  components: { Loader },
  props: {
    src: String,
    maxWidth: {
      type: Number,
      default: 320
    }
  },

  data: () => ({
    loading: true,
    missing: false
  }),

  computed: {},

  mounted() {
    Minimum(
      new Promise((resolve, reject) => {
        let image = new Image();

        image.addEventListener("load", () => resolve(image));
        image.addEventListener("error", () => reject());
        image.src = this.src;
      })
    )
      .then(image => {
        image.className = "block w-full";
        image.draggable = false;

        this.$refs.img.appendChild(image);
      })
      .catch(() => {
        this.missing = true;
        this.$emit("missing", true);
      })
      .finally(() => {
        this.loading = false;
      });
  }
};
</script>
