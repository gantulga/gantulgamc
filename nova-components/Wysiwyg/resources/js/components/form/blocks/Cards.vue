<template>
    <div>

        <field-wrapper>
            <transition-group name="cards-transition" tag="div">
                <block-panel
                    v-for="(card,i) in attributes.cards"
                    :key="card.id"
                    :open="attributes.cards.length==1 || lastAdded==i"
                    class="mb-4"
                    @remove="removeItemAt(i)"
                    @move-up="moveItemUp(i)"
                    @move-down="moveItemDown(i)"
                >
                    <template slot="header">
                    <span class="text-lg flex-grow">{{ __('Card') + ': ' + card.attributes.title }}</span>
                    </template>
                    <card
                        v-model="card.attributes"
                        :resourceId="resourceId"
                        :field="field"
                        :selectImageSize="false"
                    />
                </block-panel>
            </transition-group>
            <button class="btn btn-default btn-primary mr-3" @click.prevent="addCard">Add Card</button>
        </field-wrapper>
        <field-wrapper  :label="__('Image size')">
            <image-size-select
                class="w-full form-control form-input form-input-bordered"
                :placeholder="__('Image size')"
                v-model="attributes.imageSize"
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
        </field-wrapper>
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
import Card from "./Card";
import ImageSizeSelect from "../ImageSizeSelect";

Array.prototype.move = function(from, to) {
  this.splice(to, 0, this.splice(from, 1)[0]);
};

export default createBlock({
  components: {
    BlockPanel,
    FieldWrapper,
    ImageField,
    ExtraAttributes,
    Card,
    ImageSizeSelect
  },
  attributes: {
    cards: {
        type: "array",
        required: true,
        default: [{
            id: genid(),
            attributes: {
                title: "Card 1",
            }
        }]
    },
    columns: {
        type: Number,
        default: 3,
    },
    imageSize: {
        type: String
    }
  },
  data() {
    return {
      lastAdded: -1
    };
  },
  methods: {
    addCard() {
        this.attributes.cards.push({
            id: genid(),
            attributes: {
                title: "Card " + (this.attributes.cards.length + 1),
            }
        });
        this.lastAdded = this.attributes.cards.length - 1;
    },

    removeItemAt(index) {
      this.attributes.cards.splice(index, 1);
    },

    moveItemUp(index) {
      this.attributes.cards.move(index, index - 1);
    },

    moveItemDown(index) {
      this.attributes.cards.move(index, index + 1);
    },

  }
});
</script>
