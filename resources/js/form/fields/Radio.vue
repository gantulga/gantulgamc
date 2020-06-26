<template>
  <f-field-wrapper v-bind="{id,name,label,showHelpText,helpText,showErrors,errors,horizontal}">
    <div class="flex my-1">
      <label class="flex items-start mb-1 mr-6" v-for="(option, key) in options" :key="key">
        <div class="w-6 align-top">
          <input
            type="radio"
            :id="id || name"
            :name="name"
            :value="getValue(option, key)"
            :checked="fieldValue==getValue(option, key)"
            v-model="fieldValue"
            :class="errorClasses"
          />
        </div>
        <span class="flex-1">{{getLabel(option, key)}}</span>
      </label>
    </div>
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
  }
};
</script>
