<template>
  <div class="p-4">
    <extra-attributes v-model="attributes"/>
    <transition-group name="list-transition" tag="div">
      <block-panel
        v-for="(tab,i) in attributes.tabs"
        :key="tab.id"
        :open="attributes.tabs.length==1 || lastAdded==i"
        class="mb-4"
        @remove="removeTabAt(i)"
        @move-up="moveTabUp(i)"
        @move-down="moveTabDown(i)"
      >
        <template slot="header">
          <span class="text-lg flex-grow">{{ __('Tab') + ': ' + tab.name }}</span>
        </template>

        <field-wrapper :label="__('Tab name')">
          <input
            type="text"
            class="w-full form-control form-input form-input-bordered"
            placeholder="Tab name"
            v-model="tab.name"
          >
        </field-wrapper>
        <field-wrapper :label="__('Blocks')">
          <blocks-container v-model="tab.blocks" :resourceId="resourceId" :field="field"/>
        </field-wrapper>
      </block-panel>
    </transition-group>
    <button class="btn btn-default btn-primary mr-3 mb-4" @click.prevent="addTab">Add Tab</button>
  </div>
</template>
<script>
import createBlock from "../createBlock";
import BlockPanel from "../BlockPanel";
import ExtraAttributes from "../ExtraAttributesContainer";
import FieldWrapper from "../../FieldWrapper";
import DeleteButton from "../../../../../../../nova/resources/js/components/DeleteButton";
import genid from "../../../genid";

Array.prototype.move = function(from, to) {
  this.splice(to, 0, this.splice(from, 1)[0]);
};

export default createBlock({
  components: { DeleteButton, BlockPanel, FieldWrapper, ExtraAttributes },
  beforeCreate: function() {
    this.$options.components.BlocksContainer = require("../BlocksContainer.vue");
  },
  attributes: {
    tabs: {
      type: "array",
      required: true,
      default: [
        {
          id: genid(),
          name: "Tab 1",
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
    addTab() {
      this.attributes.tabs.push({
        id: genid(),
        name: "Tab " + (this.attributes.tabs.length + 1),
        blocks: []
      });
      this.lastAdded = this.attributes.tabs.length - 1;
    },

    removeTabAt(index) {
      this.attributes.tabs.splice(index, 1);
    },

    moveTabUp(index) {
      this.attributes.tabs.move(index, index - 1);
    },

    moveTabDown(index) {
      this.attributes.tabs.move(index, index + 1);
    }
  }
});
</script>
