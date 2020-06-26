<template>
  <div>
    <field-wrapper :label="__('Image')">
      <image-field v-model="attributes.image" :field="field" :resourceId="resourceId"/>
    </field-wrapper>
    <field-wrapper :label="__('Image size')">
      <select
        class="w-full form-control form-input form-input-bordered"
        placeholder="Size"
        v-model="attributes.size"
      >
        <option>-</option>
        <optgroup v-for="(sizes,ratio) in sizes" :label="ratio" :key="ratio">
          <option v-for="size in sizes" :value="size" :key="size">{{size}}</option>
        </optgroup>
      </select>
      <extra-attributes v-model="attributes"/>
    </field-wrapper>
    <field-wrapper>
        <blocks-container v-model="attributes.blocks"  :resourceId="resourceId" :field="field" />
    </field-wrapper>
  </div>
</template>
<script>
import { FormField, HandlesValidationErrors, Errors } from "laravel-nova";
import ImageField from "../fields/ImageField";
import createBlock from "../createBlock";
import FieldWrapper from "../../FieldWrapper";
import Image from "./Image";
import TtextField from "../fields/TextField";
import ExtraAttributes from "../ExtraAttributesContainer";

export default createBlock({
  extends: Image,
  components: { ImageField, FieldWrapper, ExtraAttributes },
  beforeCreate: function() {
    this.$options.components.BlocksContainer = require("../BlocksContainer.vue");
  },
  attributes: {
    image: {
      type: String,
      required: true,
      default: ""
    },
    blocks: {
      type: Array,
      required: true,
      default: []
    }
  }
});
</script>
