<template>
  <div class="modal-mask" @click.self="$emit('close')">
    <transition name="modal">
      <form method="GET" :action="action" class="relative mt-32 w-3/5 mx-auto flex items-center">
        <input
          :id="id"
          :name="input"
          ref="input"
          autofocus
          class="focus:outline-none border border-transparent focus:bg-grey-lighter focus:border-grey-light placeholder-grey-darkest rounded-full bg-grey-lighter py-6 px-8 pr-12 block w-full appearance-none leading-normal text-base"
          type="text"
          :placeholder="placeholder"
          autocomplete="off"
          spellcheck="false"
          role="combobox"
          aria-autocomplete="list"
          aria-expanded="false"
          aria-label="search input"
          dir="auto"
        />
        <button class="absolute pin-r mr-3 flex items-center">
            <i class="material-icons text-3xl">search</i>
        </button>
      </form>
    </transition>
  </div>
</template>

<script>
export default {
  props: {
    id: { required: true },
    action: { required: true },
    input: { required: true },
    placeholder: { required: false }
  },
  mounted() {
    const self = this;
    window.addEventListener("keydown", e => {
      self.handleGlobalKeyDown(e);
    });
    this.$refs['input'].focus();
  },
  data() {
    return {};
  },
  methods: {
    handleGlobalKeyDown(e) {
      switch (e.keyCode) {
        case 27:
          this.$emit("close");
          break;
        default:
          break;
      }
    }
  }
};
</script>

<style scoped>
/* Modal */

.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

/*
 * Transitions
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter form,
.modal-leave-active form {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
