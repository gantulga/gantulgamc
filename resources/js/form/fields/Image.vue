<template>
  <f-field-wrapper v-bind="{id,name,label,showHelpText,helpText,showErrors,errors,horizontal}">
    <label class="cursor-pointer">
      <input
        type="file"
        :id="id || name"
        :name="name"
        ref="fileInput"
        accept="image/*"
        @change="handleChange($event.target.value)"
        :class="errorClasses"
      />
      <div v-if="!imageData " class="mt-4 p-8 rounded border border-dashed border-grey hover:border-primary text-center">
          <div>
            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="inbox" style="fill:#40af9e" class="svg-inline--fa fa-inbox fa-w-18 w-10 inline-block" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="%2324ACF8" d="M566.819 227.377L462.377 83.768A48.001 48.001 0 0 0 423.557 64H152.443a47.998 47.998 0 0 0-38.819 19.768L9.181 227.377A47.996 47.996 0 0 0 0 255.609V400c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V255.609a47.996 47.996 0 0 0-9.181-28.232zM139.503 102.589A16.048 16.048 0 0 1 152.443 96h271.115c5.102 0 9.939 2.463 12.94 6.589L524.796 224H388.223l-32 64H219.777l-32-64H51.204l88.299-121.411zM544 272v128c0 8.823-7.178 16-16 16H48c-8.822 0-16-7.177-16-16V272c0-8.837 7.163-16 16-16h120l32 64h176l32-64h120c8.837 0 16 7.163 16 16z"></path></svg>
          </div>
          Upload image
      </div>
    </label>
    <img
      v-if="imageData"
      ref="image"
      :src="imageData"
      class="block bg-white border border-grey p-1 rounded mt-4"
    />
  </f-field-wrapper>
</template>

<script>
import FormField from "./Field";
import HandlesValidationErrors from "./HandlesValidationErrors";

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: {
    dragdrop: { type: Boolean, required: false }
  },
  data() {
    return {
      imageData: ""
    };
  },
  methods: {
    handleChange(value) {
      console.log("image field", value);
      this.previewImage();
    },
    previewImage() {
      var files = this.$refs.fileInput.files;
      if (files && files[0]) {
        var reader = new FileReader();
        reader.onload = e => {
          this.imageData = e.target.result;
          //this.$refs.image.src = reader.result;
        };
        reader.readAsDataURL(files[0]);
      } else {
        this.imageData = "";
      }
    }
  }
};
</script>
