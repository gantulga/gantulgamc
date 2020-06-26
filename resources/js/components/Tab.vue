<template>
  <div v-if="isActive" class="md:flex md:w-full">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    name: { required: true },
    selected: { default: false },
    bg: { required: false }
  },
  data() {
    return {
      isActive: false
    };
  },
  created() {
    this.isActive = this.selected;
  },
  computed: {
    href() {
      return "#" + this.name.toLowerCase().replace(/ /g, "-");
    }
  }
};
</script>
