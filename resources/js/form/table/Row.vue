<template>
  <tr>
    <td class="border p-1" v-for="(cell,i) in cells" :key="cell.tag + '-' + i">
      <vnodes :vnodes="cell" />
    </td>
  </tr>
</template>
<script>
export default {
  name: "f-table-row",
  components: {
    Vnodes: {
      functional: true,
      render: (h, ctx) => ctx.props.vnodes
    }
  },
  created() {
    this.cells = this.$slots.default.filter(vnode => {
      return vnode.tag != undefined;
    });
  },
  mounted() {},
  data() {
    return {
      cells: []
    };
  },
  methods: {}
};
</script>
