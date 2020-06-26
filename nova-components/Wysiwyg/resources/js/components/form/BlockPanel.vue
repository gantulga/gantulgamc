<template>
  <div class="rounded border border-50">
    <div class="bg-40 p-4 flex">
      <div class="text-lg flex flex-grow items-center cursor-pointer" @click="toggle" >
        <svg style="fill:#bbb" class=" -ml-2 mr-2 cursor-move"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
        <slot name="header"></slot>
      </div>
      <DeleteButton @click="$emit('remove')" class="ml-4">
        <span class="ml-2 mt-1">{{__('Remove')}}</span>
      </DeleteButton>
      <button
        @click="$emit('move-up')"
        type="button"
        class="cursor-pointer dim btn btn-link text-primary inline-flex blocks-center ml-4"
      >
        <span class>{{__('Move Up')}}</span>
      </button>
      <button
        @click="$emit('move-down')"
        type="button"
        class="cursor-pointer dim btn btn-link text-primary inline-flex blocks-center ml-4"
      >
        <span class>{{__('Move Down')}}</span>
      </button>
    </div>
    <div v-if="isOpen" class="bg-30 border-t border-50">
      <slot/>
    </div>
  </div>
</template>
<script>
import DeleteButton from "../../../../../../nova/resources/js/components/DeleteButton";

export default {
  components: { DeleteButton },
  props: ["open"],
  data() {
    return {
      isOpen: this.open
    };
  },
  watch: {
    /*
    open: function(value) {
      this.isOpen = value;
    }
    */
  },
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;
    }
  }
};
</script>
