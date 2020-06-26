<template>
  <f-field-wrapper v-bind="{id,name,label,showHelpText,helpText,showErrors,errors,horizontal}">
    <flat-pickr
      :id="id || name"
      :name="name"
      :placeholder="placeholder || label"
      v-model="fieldValue"
      :config="config"
      :class="[inputClasses, errorClasses]"
    ></flat-pickr>
  </f-field-wrapper>
</template>

<script>
import FormField from "./Field";
import HandlesValidationErrors from "./HandlesValidationErrors";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: {
    config: {
      type: [Object, Array],
      required: false,
      default: () => {
        return { allowInput: false };
      }
    }
  },
  components: {
    flatPickr
  }
};
</script>
