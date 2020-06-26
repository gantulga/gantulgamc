<template>
  <div class="p-4">
    <transition-group name="list-transition" tag="div">
      <block-panel
        v-for="(column,i) in attributes.columns"
        :key="column.id"
        :open="attributes.columns.length==1 || lastAdded==i"
        class="mb-4"
        @remove="removeColumnAt(i)"
        @move-up="moveColumnUp(i)"
        @move-down="moveColumnDown(i)"
      >
        <template slot="header">
          <span class="text-lg flex-grow">{{ __('Column') }}</span>
        </template>

        <field-wrapper :label="__('Column width')">
          <select
            class="w-full form-control form-input form-input-bordered"
            placeholder="Column width"
            v-model="column.width"
          >
            <option v-for="width in widths" :value="width" :key="width">{{width}}</option>
          </select>
          <extra-attributes v-model="attributes.columns[i]"/>
        </field-wrapper>

        <field-wrapper>
            <blocks-container v-model="column.blocks"  :resourceId="resourceId" :field="field" />
        </field-wrapper>

      </block-panel>
    </transition-group>
    <button class="btn btn-default btn-primary mr-3 mb-4" @click.prevent="addColumn">Add Column</button>
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

Array.prototype.move = function(from, to) {
  this.splice(to, 0, this.splice(from, 1)[0]);
};

export default createBlock({
  components: { DeleteButton, BlockPanel, FieldWrapper, ExtraAttributes },
  beforeCreate: function() {
    this.$options.components.BlocksContainer = require("../BlocksContainer.vue");
  },
  attributes: {
    columns: {
      type: Array,
      required: true,
      default: [
        {
          id: genid(),
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
  computed: {
      widths: () => ['full','1/2', '1/3','2/3','1/4','3/4','1/5','2/5','3/5','4/5','1/6']
  },
  methods: {
    addColumn() {
      this.attributes.columns.push({
        id: genid(),
        blocks: []
      });
      this.lastAdded = this.attributes.columns.length - 1;
    },

    removeColumnAt(index) {
      this.attributes.columns.splice(index, 1);
    },

    moveColumnUp(index) {
      this.attributes.columns.move(index, index - 1);
    },

    moveColumnDown(index) {
      this.attributes.columns.move(index, index + 1);
    }
  }
});
</script>
