<template>
  <div>
    <field-wrapper class="flex">
      <div
        class="py-6 px-8 flex-1"
        v-if="(hasError && showErrors) || (showHelpText && field.helpText)"
      >
        <help-text
          class="error-text mt-2 text-danger"
          v-if="hasError && showErrors"
        >{{ firstError }}</help-text>

        <help-text class="help-text mt-2" v-if="showHelpText">{{ field.helpText }}</help-text>
      </div>
    </field-wrapper>
    <blocks-container v-model="blocks" :resourceId="resourceId" :field="field" class="m-4"/>
  </div>
</template>
<script>
import BlocksContainer from "./form/BlocksContainer";
import DefaultField from "../../../../../nova/resources/js/components/Form/DefaultField";
import { FormField, HandlesValidationErrors } from "laravel-nova";
import genid from "../genid";

export default {
  mixins: [DefaultField, FormField],
  components: { BlocksContainer },

  props: ['resourceName', 'resourceId', 'field'],

  data: () => {
    return {
      blocks: [],
      history: []
    };
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.blocks = this.field.value || [{ id: genid(), type: "Text" }];
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      /*
        this.blocks.forEach(val => {
            formData.append(this.field.attribute+'[]', val.id);
        });
      */
      // TODO: JSON.stringify-g boliulj this.blocks-g form-data bolgoj yavuulah
      formData.append(this.field.attribute, JSON.stringify(this.blocks));
    }
  }
};
</script>

