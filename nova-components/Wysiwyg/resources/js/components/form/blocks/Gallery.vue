<template>
  <div>
    <field-wrapper>
      <div
        v-for="(img, i) in attributes.images"
        :key="img.id+'-'+i"
        class="inline-block mr-2 mb-4 relative"
      >
        <input
          type="button"
          class="btn btn-primary hover:bg-danger rounded-tr-lg cursor-pointer p-2 pt-1 h-6 w-6 flex items-center justify-center absolute pin-t pin-r z-10"
          style="top:1;right:1;"
          @click.prevent="removeImageAt(i)"
          :tabindex="i+1000"
          value="X"
        >
        <ImageLoader
          :src="getImageUrl(img.image)"
          class="max-w-xs"
          @missing="(value) => missing = value"
        />
        <input
          type="text"
          class="w-full form-control form-input form-input-bordered"
          :placeholder="__('Caption')"
          v-model="img.caption"
          :tabindex="i+10"
        >
      </div>
      <div>
        <input
          type="button"
          @click="browseMedia"
          class="btn btn-default btn-primary cursor-pointer"
          value="Browse"
        >
      </div>
      <resource-browser
        :field="field"
        resource-name="media"
        :via-resource-id="resourceId"
        :load-cards="false"
        @select="selected"
        :open="browseModalOpen"
        v-if="browseModalOpen"
        @onClose="closeMedia"
        />
    </field-wrapper>
    <field-wrapper :label="__('Columns')">
      <select
        class="w-full form-control form-input form-input-bordered"
        :placeholder="__('Columns')"
        v-model="attributes.columns"
      >
        <option v-for="col in [1,2,3,4,5,6]" :value="col" :key="col">{{col}}</option>
      </select>
      <extra-attributes v-model="attributes"/>
    </field-wrapper>
  </div>
</template>

<script>
import { FormField, HandlesValidationErrors, Errors } from "laravel-nova";
import ImageLoader from "../../../../../../../nova/resources/js/components/ImageLoader";
import TextField from "../fields/TextField";
import createBlock from "../createBlock";
import FieldWrapper from "../../FieldWrapper";
import ExtraAttributes from "../ExtraAttributesContainer";
import genid from "../../../genid";

export default createBlock({
  components: { ImageLoader, FieldWrapper, ExtraAttributes, TextField },
  attributes: {
    images: {
      type: Array,
      required: true,
      default: []
    },
    columns: {
        type: Number,
        default: 3,
    }
  },
  data() {
    return {
      browseModalOpen: false,
      removeMediaId: 0,
      uploadErrors: new Errors()
    };
  },
  computed: {
    sizes() {
      return {
        "16:9": [
          "320x180",
          "640x360",
          "960*540",
          "1280x720",
          "1600x900",
          "1920x1080"
        ],
        "4:3": [
          "256x192",
          "512x384",
          "768x576",
          "1024x768",
          "1280x960",
          "1536x1152"
        ],
        "3:2": [
          "270x180",
          "540x360",
          "810x540",
          "1080x720",
          "1350x900",
          "1620x1080"
        ],
        "1:1": ["100x100", "200x200", "400x400", "800x800", "1000x1000"]
      };
    }
  },
  methods: {
    getImageUrl(image) {
      return this.field.diskPath + image + "?w=200&h=200&fit=crop";
    },
    /**
     * Show media browser modal.
     */
    browseMedia() {
      this.browseModalOpen = true;
    },

    /**
     * Close media browser modal.
     */
    closeMedia() {
      this.browseModalOpen = false;
    },

    /**
     * Handle the select event.
     */
    selected(selectedResources) {
      if (selectedResources.length) {
        this.closeMedia();
        setTimeout(() => {
          selectedResources.forEach(image => {
            this.attributes.images.push({
              id: image.id,
              image: image.file
            });
          });
          //this.$emit("change", this.attributes);
        }, 100);
      }
    },

    removeImageAt(i) {
      this.attributes.images.splice(i, 1);
    }
  }
});
</script>
