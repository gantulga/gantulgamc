<template>
  <div class="flex-auto flex justify-center text-center md:text-left p-2 md:p-4">
    <div>
      <p>{{title}}</p>
      <h2 class="text-primary text-3xl">{{format ? formatNumber(val) : val }} {{unit}}</h2>
    </div>
  </div>
</template>
<script>
export default {
  props: ["title", "value", "unit", "format"],
  props: {
    title: String,
    value: Number,
    unit: String,
    format: {
      type: Boolean,
      default: true
    }
  },

  data() {
    return {
      val: 0
    };
  },
  mounted() {
    //this.val = this.value;
    window.addEventListener("scroll", this.startCounter);
    setTimeout(() => {
      this.startCounter();
    }, 400);
  },
  methods: {
    requestAnimationFrame(cb) {
      return requestAnimationFrame(cb);
    },
    cancelAnimationFrame(af) {
      cancelAnimationFrame(af);
    },
    startCounter() {
      //console.log("start counter");

      if (!window.requestAnimationFrame) {
        this.val = this.value;
        window.removeEventListener("scroll", this.startCounter);
        return;
      }
      //console.log(this.$el.getBoundingClientRect(), window.innerHeight);
      if (
        this.$el.getBoundingClientRect().top >
          (window.innerHeight || document.documentElement.clientHeight) ||
        this.$el.getBoundingClientRect().bottom < 0
      ) {
        return;
      }

      window.removeEventListener("scroll", this.startCounter);

      this.val = 0;
      var duration = 3000;
      var fps = 20;
      var end = Number.parseInt(this.value);
      var interval = Math.max(
        Math.floor(1000 / fps),
        Math.floor(duration / end)
      );
      var step = duration / interval;
      var diff = Math.max(1, Math.floor(end / step));

      var animationFrameId;

      var count = () => {
        setTimeout(() => {
          if (this.val <= end) {
            this.val += diff;
            animationFrameId = this.requestAnimationFrame(count);
          } else {
            this.cancelAnimationFrame(animationFrameId);
            this.val = this.value;
          }
        }, 1000 / fps - 1000 / 60); // 60 => default fps for requestAnimationFrame
      };

      animationFrameId = this.requestAnimationFrame(count);
    },
    formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
    }
  }
};
</script>
