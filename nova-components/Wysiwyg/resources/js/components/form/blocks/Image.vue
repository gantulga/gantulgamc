<template>
  <div>
    <field-wrapper :label="__('Image')">
      <image-field v-model="attributes.image" :field="field" :resourceId="resourceId"/>
    </field-wrapper>

    <field-wrapper :label="__('Size')">
      <image-size-select
        class="w-full form-control form-input form-input-bordered"
        :placeholder="__('Size')"
        v-model="attributes.size"
      >
      </image-size-select>
    </field-wrapper>

    <field-wrapper :label="__('Caption')">
      <textarea
        class="w-full form-control form-input form-input-bordered h-auto"
        placeholder="Caption"
        v-model="attributes.caption"
        rows="4"
      ></textarea>
    </field-wrapper>
    <field-wrapper :label="__('Link')">
      <input
        type="text"
        class="w-full form-control form-input form-input-bordered"
        placeholder="Link"
        v-model="attributes.link"
      />
      <extra-attributes v-model="attributes"/>
    </field-wrapper>

  </div>
</template>
<script>
import { FormField, HandlesValidationErrors, Errors } from "laravel-nova";
import ImageField from "../fields/ImageField";
import TextField from "../fields/TextField";
import createBlock from "../createBlock";
import FieldWrapper from "../../FieldWrapper";
import ExtraAttributes from "../ExtraAttributesContainer";
import ImageSizeSelect from "../ImageSizeSelect";

export default createBlock({
  components: { ImageField, FieldWrapper, ExtraAttributes, ImageSizeSelect },
  attributes: {
    image: {
      type: String,
      required: true,
      default: ""
    }
  }
});
</script>
