<template>
  <div>

    <text-field v-model="attributes.content" :field="field" :resourceId="resourceId"></text-field>
    <extra-attributes v-model="attributes"/>

  </div>
</template>
<script>
import TextField from "../fields/TextField";
import createBlock from "../createBlock";
import FieldWrapper from "../../FieldWrapper";
import ExtraAttributes from "../ExtraAttributesContainer";

export default createBlock({
  components: { FieldWrapper, TextField, ExtraAttributes },
  attributes: {
    content: {
      type: String,
      required: true,
      default: ""
    }
  }
});
</script>
