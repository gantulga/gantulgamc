<template>
  <f-field-wrapper v-bind="{id,name,label,showHelpText,helpText,showErrors,errors,horizontal}">
    <label class="cursor-pointer">
      <input
        type="file"
        :id="id || name"
        :name="name"
        ref="fileInput"
        :accept="accept"
        @change="handleChange($event.target.value)"
        :class="errorClasses"
      />
    </label>
  </f-field-wrapper>
</template>

<script>
import FormField from "./Field";
import HandlesValidationErrors from "./HandlesValidationErrors";

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: {
    accept: "",
    dragdrop: { type: Boolean, required: false }
  },
  data() {
    return {};
  },
  methods: {
    handleChange(value) {

    },
  }
};
</script>
