<template>
  <div>
    <field-wrapper :label="__('Image')">
      <image-field v-model="attributes.image" :field="field" :resourceId="resourceId"/>
    </field-wrapper>

    <field-wrapper v-if="selectImageSize" :label="__('Image size')">
      <image-size-select
        class="w-full form-control form-input form-input-bordered"
        :placeholder="__('Image size')"
        v-model="attributes.imageSize"
      />
    </field-wrapper>

    <field-wrapper :label="__('Title')">
      <input
        type="text"
        class="w-full form-control form-input form-input-bordered"
        placeholder="Title"
        v-model="attributes.title"
      />
    </field-wrapper>
    <field-wrapper :label="__('Text')">
        <text-field v-model="attributes.text" :field="field" :resourceId="resourceId" :config="{height:200}"></text-field>
    </field-wrapper>
    <field-wrapper :label="__('Link')">
      <input
        type="text"
        class="w-full form-control form-input form-input-bordered"
        :placeholder="__('Link')"
        v-model="attributes.link"
      />
    </field-wrapper>
    <extra-attributes v-model="attributes"/>
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
  components: { ImageField, TextField, FieldWrapper, ExtraAttributes , ImageSizeSelect},
  props: {selectImageSize:{default:true}},
  attributes: {
    image: {
        type: String,
        required: false,
        default: ""
    },
    title: {
        type: String,
        required: true,
        default: ""
    },
    text: {
        type: String,
    },
    link: {
        type: String,
    },
    imageSize: {
        type: String
    }
  }
});
</script>
