<template>
  <div :class="{ 'vue-lightbox' : !resetstyles }">
    <div
      class="lightbox-overlay fixed pin bg-black-70 px-4 md:px-32 flex items-center justify-center z-50"
      v-if="overlayActive"
      @click.self="closeOverlay"
    >
      <div class="holder relative">
        <img class="block max-h-screen" :src="images[currentImage].src">
        <div class="nav text-white text-3xl md:text-4xl cursor-pointer static" v-if="nav">
          <a
            class="prev absolute pin-t pin-b pin-l font-bold text-white w-1/2 flex items-center justify-start"
            nohref
            @click="prevImage"
          >
            <span class="m-2">&#8592;</span>
          </a>
          <a
            class="next absolute pin-t pin-b pin-r font-bold text-white w-1/2 flex items-center justify-end"
            nohref
            @click="nextImage"
          >
            <span class="m-2">&#8594;</span>
          </a>
          <a class="close absolute pin-r pin-t text-white m-3" style="line-height:1rem;" nohref @click="closeOverlay">
            &times;
          </a>
        </div>
        <p
          class="bg-primary-light text-white p-2" cl="absolute pin-b pin-l pin-r p-4 bg-black-50 text-white"
          v-if="caption && images[currentImage].caption"
        >{{ images[currentImage].caption }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import ImageLoader from "./ImageLoader";

export default {
  components: { ImageLoader },
  props: {
    resetstyles: {
      default: false,
      type: Boolean
    },
    images: {
      type: Array
    },
    loop: {
      default: true,
      type: Boolean
    },
    nav: {
      default: true,
      type: Boolean
    },
    caption: {
      default: true,
      type: Boolean
    }
  },
  data() {
    return {
      currentImage: null,
      overlayActive: false
    };
  },
  mounted() {
    const self = this;
    window.addEventListener("keydown", e => {
      self.handleGlobalKeyDown(e);
    });
  },
  methods: {
    test(arg) {
      console.log("from lightbox: ", arg);
    },

    clickImage(index) {
      this.currentImage = index;
      this.overlayActive = true;
      console.log(this.currentImage, this.images);
    },
    nextImage() {
      if (this.currentImage === this.images.length - 1) {
        if (this.loop) {
          this.currentImage = 0;
        }
      } else {
        this.currentImage += 1;
      }
    },
    prevImage() {
      if (this.currentImage === 0) {
        if (this.loop) {
          this.currentImage = this.images.length - 1;
        }
      } else {
        this.currentImage -= 1;
      }
    },
    closeOverlay() {
      this.overlayActive = false;
    },
    handleGlobalKeyDown(e) {
      switch (e.keyCode) {
        case 37:
          this.prevImage();
          break;
        case 39:
          this.nextImage();
          break;
        case 27:
          this.closeOverlay();
          break;
        default:
          break;
      }
    }
  }
};
</script>

<!--style scoped lang="scss">
.vue-lightbox ul {
  list-style: none;
  margin: 0 auto;
  padding: 0;
  display: block;
  max-width: 780px;
  text-align: center;

  li {
    display: inline-block;
    padding: 5px;
    background: ghostwhite;
    margin: 10px;

    img {
      display: block;
      width: 200px;
    }
  }
}
.lightbox-overlay {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.9);
  text-align: center;
  padding: 20px;
  box-sizing: border-box;

  .holder {
    max-width: 100%;
    margin: 0 auto;
    position: relative;
    max-height: 100vh;

    img {
      width: 100%;
      max-width: 600px;
      cursor: pointer;
      box-sizing: border-box;
      display: block;
      max-height: 100vh;
    }

    p {
      color: #ffffff;
      margin: 0;
      background-color: rgba(0, 0, 0, 0.4);
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      box-sizing: border-box;
      padding: 10px;
    }
    .nav {
      max-width: 600px;
      margin: 0 auto;
      font-size: 14px;
      a {
        color: white;
        opacity: 0.3;
        -webkit-user-select: none;
        cursor: pointer;
        &:hover {
          opacity: 1;
        }
      }

      .next,
      .prev {
        position: absolute;
        top: 0;
        bottom: 0;
        padding: 10px;
        width: 50%;
        box-sizing: border-box;
        font-size: 40px;
        span {
          top: 50%;
          transform: translateY(50%);
          position: relative;
        }
      }
      .next {
        right: 0;
        text-align: right;
      }
      .prev {
        left: 0;
        text-align: left;
      }
      .close {
        right: 10px;
        top: 0;
        font-size: 30px;
        opacity: 0.6;
        z-index: 1000000;
        position: absolute;
        text-align: left;
        box-sizing: border-box;

        &:hover {
          opacity: 1;
        }
      }
    }
  }
}
</style>
