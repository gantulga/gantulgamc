<template>
  <div
    role="alert"
    class="alert alert-success bg-green-lightest border border-green-light text-green-dark px-4 py-3 rounded relative mb-4"
  >
    <strong v-if="title" class="font-bold">{{ title }}</strong>
    <span class="-block -sm:inline">{{ message }}</span>
  </div>
</template>
<script>
export default {
  props: {
    title: { type: String },
    message: { type: String, required: true }
  },
  mounted() {},
  data() {
    return {};
  },
  methods: {}
};
</script>
