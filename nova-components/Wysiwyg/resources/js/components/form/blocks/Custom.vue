<template>
  <div>
    <field-wrapper :label="__('View')">
      <select
        class="w-full form-control form-input form-input-bordered"
        placeholder="Custom html"
        v-model="attributes.view"
      >
        <option>-</option>
        <option v-for="(name, view) in field.customBlockViews" :value="view" :key="view">{{name}}</option>
      </select>
      <extra-attributes v-model="attributes"/>
    </field-wrapper>
  </div>
</template>

<script>
import createBlock from "../createBlock";
import FieldWrapper from "../../FieldWrapper";
import ExtraAttributes from "../ExtraAttributesContainer";

export default createBlock({
  components: { FieldWrapper, ExtraAttributes },
  attributes: {
    view: {
      type: "string",
      required: true,
      default: ""
    }
  }
});
</script>
