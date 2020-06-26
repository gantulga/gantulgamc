<template>
  <f-field-wrapper v-bind="$props">
    <input
      :id="id || name"
      :name="name"
      :type="type || 'text'"
      :placeholder="placeholder || label"
      v-model="fieldValue"
      :class="[inputClasses, errorClasses]"
    />
  </f-field-wrapper>
</template>

<script>
import FormField from "./Field";
import HandlesValidationErrors from "./HandlesValidationErrors";

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: {
    type: { type: String, required: false }
  }
};
</script>
