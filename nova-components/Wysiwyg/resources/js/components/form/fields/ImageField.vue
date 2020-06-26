<template>
  <div>
    <ImageLoader
      v-if="image"
      :src="imageUrl"
      class="max-w-xs"
      @missing="(value) => missing = value"
    />
    <input
      type="button"
      @click="browseMedia"
      class="btn btn-default btn-primary cursor-pointer"
      value="Browse"
    />
    <DeleteButton v-if="removable && image" @click="removeImage" >
        <span class="class ml-2 mt-1">
            {{__('Remove')}}
        </span>
    </DeleteButton>
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
    <transition name="fade">
      <!--modal v-if="browseModalOpen" @modal-close="closeMedia">
        <div
          class="bg-white rounded-lg shadow-lg overflow-hidden p-8"
          style="width: 1024px; min-width: 1024px;"
        >
          <media-resource-index
            :field="field"
            resource-name="media"
            :via-resource-id="resourceId"
            :load-cards="false"
            mime-type="image"
            @select="selected"
          />
        </div>
      </modal-->
    </transition>
  </div>
</template>

<script>
import { FormField, HandlesValidationErrors, Errors } from "laravel-nova";
import ImageLoader from "../../../../../../../nova/resources/js/components/ImageLoader";
import DeleteButton from '../../../../../../../nova/resources/js/components/DeleteButton'

export default {
  components: { ImageLoader, DeleteButton },
  props: ["value", "field", "resourceId", "removable"],
  data() {
    return {
      image: this.value,
      browseModalOpen: false,
      uploadErrors: new Errors()
    };
  },
  computed: {
    imageUrl() {
      return this.field.diskPath + this.image + "?w=270&h=180&fit=crop";
    },
    hasRemoveListener(){
        return this.$listeners && this.$listeners.remove
    }
  },
  methods: {
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
     * Remove image.
     */
    removeImage() {
      this.image = null;
      this.$emit("input", null);
    },


    /**
     * Handle the select event.
     */
    selected(selectedResources) {
      if (selectedResources.length) {
        this.image = false;
        this.closeMedia();
        setTimeout(() => {
          this.image = selectedResources[0].file;
          this.$emit("input", this.image);
        }, 100);
      }
    }
  }
};
</script>
