<template>
  <div class="p-4">
    <transition-group name="list-transition" tag="div">
      <block-panel
        v-for="(slide,i) in attributes.slides"
        :key="slide.id"
        :open="attributes.slides.length==1 || lastAdded==i"
        class="mb-4"
        @remove="removeSlideAt(i)"
        @move-up="moveSlideUp(i)"
        @move-down="moveSlideDown(i)"
      >
        <template slot="header">
          <span class="text-lg flex-grow">{{ __('Slide') + ': ' + slide.title }}</span>
        </template>

        <field-wrapper :label="__('Title')">
          <input
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :placeholder="__('Title')"
            v-model="slide.title"
          >
        </field-wrapper>
        <field-wrapper :label="__('Link')">
          <input
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :placeholder="__('Link')"
            v-model="slide.link"
          >
        </field-wrapper>
        <field-wrapper :label="__('Caption')">
          <textarea
            type="text"
            class="w-full form-control form-input form-input-bordered h-auto"
            :placeholder="__('Caption')"
            v-model="slide.caption"
            rows="4"
          ></textarea>
        </field-wrapper>
        <field-wrapper :label="__('Image')">
          <image-field v-model="slide.image" :field="field" :resourceId="resourceId"/>
        </field-wrapper>
      </block-panel>
    </transition-group>
    <button class="btn btn-default btn-primary mr-3 mb-4" @click.prevent="addSlide">Add Slide</button>

    <extra-attributes v-model="attributes"/>
  </div>
</template>

<script>
import ImageField from "../fields/ImageField";
import createBlock from "../createBlock";
import BlockPanel from "../BlockPanel";
import FieldWrapper from "../../FieldWrapper";
import ExtraAttributes from "../ExtraAttributesContainer";
import genid from "../../../genid";

Array.prototype.move = function(from, to) {
  this.splice(to, 0, this.splice(from, 1)[0]);
};

export default createBlock({
  components: {
    BlockPanel,
    FieldWrapper,
    ImageField,
    ExtraAttributes
  },
  attributes: {
    slides: {
      type: "array",
      required: true,
      default: [
        {
          id: genid(),
          title: "Slide 1",
          link: "#",
          image: "",
          caption: ""
        }
      ]
    }
  },
  data() {
    return {
      lastAdded: -1
    };
  },
  methods: {
    addSlide() {
      this.attributes.slides.push({
        id: genid(),
        title: "Slide " + (this.attributes.slides.length + 1),
        link: "#",
        image: "",
        caption: ""
      });
      this.lastAdded = this.attributes.slides.length - 1;
    },

    removeSlideAt(index) {
      this.attributes.slides.splice(index, 1);
    },

    moveSlideUp(index) {
      this.attributes.slides.move(index, index - 1);
    },

    moveSlideDown(index) {
      this.attributes.slides.move(index, index + 1);
    }
  }
});
</script>
