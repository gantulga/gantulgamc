<template>
  <f-field-wrapper v-bind="{id,name,label,showHelpText,helpText,showErrors,errors,horizontal}">
    <select
      :id="id || name"
      :name="name"
      :placeholder="placeholder || label"
      v-model="fieldValue"
      :class="[inputClasses, errorClasses, {'text-grey-dark': fieldValue==null}]"
    >
      <option :value="null" disabled>-{{placeholder||label}}-</option>
      <option
        v-for="(option, key) in options"
        :value="getValue(option, key)"
        :key="getValue(option, key)"
      >{{getLabel(option, key)}}</option>
    </select>
  </f-field-wrapper>
</template>

<script>
import FormField from "./Field";
import HandlesValidationErrors from "./HandlesValidationErrors";
import HasOptions from "./HasOptions";

export default {
  mixins: [FormField, HandlesValidationErrors, HasOptions],
  props: {
    options: { type: [Array, Object], required: true }
  },
  watch: {
    options(newOptions, oldOptions) {
      if (!this.fieldValue) {
        return;
      }
      if (Array.isArray(newOptions)) {
        for (var i = 0; i < newOptions.length; i++) {
          if (this.fieldValue == this.getValue(newOptions[i], i)) {
            return;
          }
        }
      } else if(typeof newOptions == "object") {
        for (var i in newOptions) {
          if (this.fieldValue == this.getValue(newOptions[i], i)) {
            return;
          }
        }
      }
      this.fieldValue = null;
      //console.log("options changed", this.name, val, val2, val==val2);
    }
  }
};
</script>
