<template>
  <div class>
    <button
      @click="toggle()"
      type="button"
      class="cursor-pointer dim btn btn-link text-primary inline-flex blocks-center text-sm m-4"
    >
      <span class>{{title||__('Extra attributes')}}</span>
    </button>
    <div v-if="isOpen" class="bg-30 border-t border-50">
      <slot>
        <field-wrapper :label="__('Id')">
          <input
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :placeholder="__('Id')"
            v-model="attributes.id"
          >
        </field-wrapper>
        <field-wrapper :label="__('Css class')">
          <input
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :placeholder="__('Css class')"
            v-model="attributes.class"
          >
        </field-wrapper>
        <field-wrapper :label="__('Css style')">
          <input
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :placeholder="__('Css style')"
            v-model="attributes.style"
          >
        </field-wrapper>
      </slot>
    </div>
  </div>
</template>
<script>
import FieldWrapper from "../FieldWrapper";

export default {
  props: ["open", "title", "attributes"],
  components: {FieldWrapper},
  data() {
    return {
      isOpen: this.open
    };
  },
  model: {
    prop: "attributes",
    event: "change"
  },
  watch: {
    attributes: {
      deep: true,
      handler: function(attributes) {
        this.$emit("change", attributes);
      }
    }
  },
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;
    }
  }
};
</script>
