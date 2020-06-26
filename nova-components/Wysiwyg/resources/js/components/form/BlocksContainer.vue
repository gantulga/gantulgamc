<template>
  <div>
    <draggable v-model="blocks">
      <transition-group tag="div">
        <!--name="list-transition"-->
        <block-panel
          v-for="(block, i) in blocks"
          :key="block.id"
          :open="blocks.length==1 || lastAdded==i"
          class="mb-4"
          @remove="removeBlockAt(i)"
          @move-up="moveBlockUp(i)"
          @move-down="moveBlockDown(i)"
        >
          <template slot="header">{{ block.type }}</template>

          <component
            :is="blockTypes[block.type]"
            v-model="block.attributes"
            :resourceId="resourceId"
            :field="field"
          />
        </block-panel>
      </transition-group>
    </draggable>

    <div class="flex- flex-wrap-">
      <!--ul class="list-reset">
            <li v-for="(type, i) in Object.keys(blockTypes)"
                :key="'block-'+type+'-'+i">
              <a @click.prevent="addBlock(type)"
                href="#" class="px-4 py-2 block text-black hover:bg-grey-light">{{type}}</a>
            </li>
      </ul-->
      <dropdown-menu :items="blockMenuItems">+ Add Block</dropdown-menu>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";
import blockTypes from "./blocks";
import BlockPanel from "./BlockPanel";
import DropdownMenu from "../DropdownMenu";
import genid from "../../genid";

Array.prototype.move = function(from, to) {
  this.splice(to, 0, this.splice(from, 1)[0]);
};

export default {
  components: { draggable, BlockPanel, DropdownMenu, ...blockTypes },
  props: {
    field: Object,
    resourceId: [Number, String],
    blocks: {
      type: Array,
      required: true
    }
  },
  model: {
    prop: "blocks",
    event: "change"
  },
  watch: {
    blocks: function(blocks) {
      this.$emit("change", blocks);
    }
  },
  data() {
    return {
      lastAdded: -1
    };
  },
  computed: {
    blockTypes: function() {
      return blockTypes;
    },
    blockMenuItems: function() {
      return Object.keys(blockTypes).map(type => {
        return { title: type, click: () => this.addBlock(type) };
      });
    }
  },
  methods: {
    addBlock(type) {
      this.blocks.push({
        id: genid(),
        type: type
      });
      this.lastAdded = this.blocks.length - 1;
    },

    removeBlockAt(index) {
      this.blocks.splice(index, 1);
    },

    moveBlockUp(index) {
      this.blocks.move(index, index - 1);
    },

    moveBlockDown(index) {
      this.blocks.move(index, index + 1);
    }
  }
};
</script>
