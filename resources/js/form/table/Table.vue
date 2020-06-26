<template>
  <div class="mb-6 overflow-x-auto">
    <p v-if="label" class="my-3">{{label}}</p>
    <table class="table-auto w-full">
      <thead v-if="$slots.header">
        <tr class="leading-tight text-xs">
          <slot name="header"></slot>
          <th class="border w-1"></th>
        </tr>
      </thead>
      <transition-group name="f-table" tag="tbody">
        <f-table-row
          v-for="(row, key, i) in rows"
          :key="key+'-'+JSON.stringify(errors)"
          class="f-table-row"
        >
          <slot :row="row" :i="i"></slot>
          <button
            type="button"
            @click="remove(key)"
            class="btn btn-danger btn-outline"
            tooltip="Хасах"
          >x</button>
        </f-table-row>
      </transition-group>
    </table>
    <p class="help-text mt-2 text-xs italic" v-if="showHelpText && helpText">{{ helpText }}</p>
    <button type="button" @click="add" class="btn btn-primary btn-outline my-2">+ Нэмэх</button>
  </div>
</template>

<script>
import HandlesValidationErrors from "../fields/HandlesValidationErrors";
export default {
  mixins: [HandlesValidationErrors],
  props: {
    value: { required: false },
    label: { required: false, type: String },
    helpText: { required: false, type: String },
    showHelpText: { type: Boolean, default: true }
  },
  created() {
    if (Array.isArray(this.value)) {
      this.rows = this.value.reduce((obj, item, idx) => {
        obj["row_" + idx] = item;
        return obj;
      }, {});
      this.rowCount = this.value.length;
    } else if (this.value) this.rows = this.value;
  },
  mounted() {},
  data() {
    return {
      rows: {},
      rowCount: 0
    };
  },
  watch: {
    rows(val) {
      this.$emit("input", val);
    }
  },
  methods: {
    add() {
      var key = "row_" + this.rowCount++;
      Vue.set(this.rows, key, {});
      /*
      this.rows.push({});
      var row = this.$slots.row[0];
      */
    },
    remove(key) {
      //this.rows.splice(key, 1);
      Vue.delete(this.rows, key);
    }
  }
};
</script>
<style>
.f-table-row,
.f-table-row td {
  transition: all 0.6s;
  /*
  display: block;
  margin-bottom: 10px;
  */
}
.f-table-enter,  .f-table-leave-to
/* .table-leave-active below version 2.1.8 */ {
  opacity: 0;
  /*transform: translateX(10px);*/
}
.f-table-leave-active {
  /*position: absolute;*/
  opacity: 1;
  display: none;
}
td .mb-4 {
  margin-bottom: 0;
}
</style>
