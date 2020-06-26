<template>
  <div>
    <div class="p-4">
        <transition-group name="accordion-transition" tag="div">
            <block-panel
                v-for="(panel,i) in attributes.panels"
                :key="panel.id"
                :open="attributes.panels.length==1 || lastAdded==i"
                class="mb-4"
                @remove="removeItemAt(i)"
                @move-up="moveItemUp(i)"
                @move-down="moveItemDown(i)"
            >
                <template slot="header">
                <span class="text-lg flex-grow">{{ __('Panel') + ': ' + panel.title }}</span>
                </template>

                <field-wrapper :label="__('Title')">
                <input
                    type="text"
                    class="w-full form-control form-input form-input-bordered"
                    placeholder="Title"
                    v-model="panel.title"
                />
                </field-wrapper>
                <field-wrapper :label="__('Sub title')">
                <input
                    type="text"
                    class="w-full form-control form-input form-input-bordered"
                    placeholder="Sub title"
                    v-model="panel.subtitle"
                />
                </field-wrapper>
                <field-wrapper :label="__('Header Image')">
                <image-field
                    v-model="panel.headerImage"
                    :field="field"
                    :resourceId="resourceId"
                    :removable="true"
                />
                </field-wrapper>
                <field-wrapper :label="__('Blocks')">
                    <blocks-container v-model="panel.blocks" :resourceId="resourceId" :field="field"/>
                </field-wrapper>
            </block-panel>
        </transition-group>
        <button class="btn btn-default btn-primary mr-3" @click.prevent="addPanel">Add Panel</button>
    </div>
    <extra-attributes v-model="attributes"/>
  </div>
</template>
<script>
import createBlock from "../createBlock";
import BlockPanel from "../BlockPanel";
import ExtraAttributes from "../ExtraAttributesContainer";
import FieldWrapper from "../../FieldWrapper";
import DeleteButton from "../../../../../../../nova/resources/js/components/DeleteButton";
import genid from "../../../genid";
import ImageField from "../fields/ImageField";

Array.prototype.move = function(from, to) {
  this.splice(to, 0, this.splice(from, 1)[0]);
};

export default createBlock({
  components: { DeleteButton, BlockPanel, FieldWrapper, ExtraAttributes, ImageField },
  beforeCreate: function() {
    this.$options.components.BlocksContainer = require("../BlocksContainer.vue");
  },
  attributes: {
    panels: {
      type: "array",
      required: true,
      default: [
        {
          id: genid(),
          title: "Panel 1",
          blocks: []
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
    addPanel() {
      this.attributes.panels.push({
        id: genid(),
        title: "Panel " + (this.attributes.panels.length + 1),
        blocks: []
      });
      this.lastAdded = this.attributes.panels.length - 1;
    },

    removeItemAt(index) {
      this.attributes.panels.splice(index, 1);
    },

    moveItemUp(index) {
      this.attributes.panels.move(index, index - 1);
    },

    moveItemDown(index) {
      this.attributes.panels.move(index, index + 1);
    }
  }
});
</script>
