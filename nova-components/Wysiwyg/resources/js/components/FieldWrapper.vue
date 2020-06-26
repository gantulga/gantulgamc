<template>
  <field-wrapper>
    <div v-if="hasLabel" class="w-1/6 p-4">
      <slot name="label">
        <form-label class="pt-2">{{ label }}</form-label>
      </slot>
    </div>
    <div class="p-4" :class="hasClass">
      <slot />
    </div>
  </field-wrapper>
</template>
<script>
export default {
    props: ['label'],
    computed: {
        hasLabel() {
            return !!this.$slots.label || !!this.label
        },
        hasClass() {
            return this.hasLabel ? 'w-5/6' : 'w-full';
        }
    }
}
</script>
