<template>
  <div>
    <field-wrapper :label="__('Form')">
        <select
        class="w-full form-control form-input form-input-bordered"
        placeholder="Form"
        v-model="attributes.form"
        >
            <option>-</option>
            <option v-for="form in field.forms" :value="form.id" :key="form.id">{{form.title}}</option>
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
    form: {
      type: "number",
      required: true,
      default: ""
    }
  }
});
</script>
