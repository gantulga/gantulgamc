<template>
  <div>
    <field-wrapper :label="__('Title')">
      <input
        type="text"
        class="w-full form-control form-input form-input-bordered"
        :placeholder="__('Title')"
        v-model="attributes.title"
      >
      <extra-attributes v-model="attributes"/>
    </field-wrapper>
    <field-wrapper>
      <form-label class="pt-0 mb-4">{{__('Blocks')}}</form-label>
      <blocks-container v-model="attributes.blocks" :resourceId="resourceId" :field="field"/>
    </field-wrapper>
  </div>
</template>
<script>
import { FormField, HandlesValidationErrors, Errors } from "laravel-nova";
import createBlock from "../createBlock";
import FieldWrapper from "../../FieldWrapper";
import ExtraAttributes from "../ExtraAttributesContainer";

export default createBlock({
  components: { FieldWrapper, ExtraAttributes },
  beforeCreate: function() {
    this.$options.components.BlocksContainer = require("../BlocksContainer.vue");
  },
  attributes: {
    blocks: {
      type: Array,
      required: true,
      default: []
    }
  }
});
</script>
