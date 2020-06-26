<template>
  <div class="p-4">
    <transition-group name="list-transition" tag="div">
      <block-panel
        v-for="(event,i) in attributes.events"
        :key="event.id"
        :open="attributes.events.length==1 || lastAdded==i"
        class="mb-4"
        @remove="removeEventAt(i)"
        @move-up="moveEventUp(i)"
        @move-down="moveEventDown(i)"
      >
        <template slot="header">
          <span class="text-lg flex-grow">{{ __('Event') + ': ' + event.datetime + ' - ' + event.title }}</span>
        </template>

        <field-wrapper :label="__('Datetime')">
          <input
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :placeholder="__('Datetime')"
            v-model="event.datetime"
          >
        </field-wrapper>

        <field-wrapper :label="__('Title')">
          <input
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :placeholder="__('Title')"
            v-model="event.title"
          >
        </field-wrapper>

        <field-wrapper :label="__('Description')">
          <text-field v-model="event.description" :field="field" :resourceId="resourceId"></text-field>
        </field-wrapper>

        <field-wrapper :label="__('Image')">
          <image-field v-model="event.image" :field="field" :resourceId="resourceId"/>
        </field-wrapper>
      </block-panel>
    </transition-group>
    <button class="btn btn-default btn-primary mr-3 mb-4" @click.prevent="addEvent">Add Event</button>

    <extra-attributes v-model="attributes"/>
  </div>
</template>

<script>
import ImageField from "../fields/ImageField";
import TextField from "../fields/TextField";
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
    TextField,
    ExtraAttributes
  },
  attributes: {
    events: {
      type: "array",
      required: true,
      default: [
        {
          id: genid(),
          title: "Event 1",
          image: "",
          description: ""
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
    addEvent() {
      this.attributes.events.push({
        id: genid(),
        title: "Event " + (this.attributes.events.length + 1),
        image: "",
        description: ""
      });
      this.lastAdded = this.attributes.events.length - 1;
    },

    removeEventAt(index) {
      this.attributes.events.splice(index, 1);
    },

    moveEventUp(index) {
      this.attributes.events.move(index, index - 1);
    },

    moveEventDown(index) {
      this.attributes.events.move(index, index + 1);
    }
  }
});
</script>
