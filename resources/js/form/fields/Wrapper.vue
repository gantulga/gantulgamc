<template>
  <div :class="{'md:flex': horizontal}">
    <div v-if="showLabel" :class="{'md:w-1/3': horizontal}" class="py-1 pr-3">
      <slot name="label">
        <label :for="name" :class="{ 'mb-2': showHelpText && helpText }">{{ fieldLabel }}</label>
      </slot>
    </div>
    <div :class="{'md:w-2/3': showLabel && horizontal  }" class="w-full mb-4">
      <slot />
      <p class="error-text mt-2 text-red text-xs" v-if="showErrors && hasError">{{ firstError }}</p>
      <p class="help-text mt-2 text-xs" v-if="showHelpText && helpText">{{ helpText }}</p>
    </div>
  </div>
</template>

<script>
import HandlesValidationErrors from "./HandlesValidationErrors";

export default {
  mixins: [HandlesValidationErrors],
  props: {
    id: { type: [String, Number], required: false },
    name: { type: [String, Number], required: false, default: '' },
    label: { type: [String, Boolean], required: false },
    showHelpText: { type: Boolean, default: true },
    helpText: { type: String, required: false },
    showErrors: { type: Boolean, default: true },
    horizontal: { type: Boolean, default: true }
  },

  computed: {
    fieldLabel() {
      return this.label || this.name;
    },
    showLabel() {
      return !(this.label === false);
    }
  }
};
</script>
