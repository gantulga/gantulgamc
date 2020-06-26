<template>
  <div>
    <select class="form-control form-select" v-model="selected">
      <option value="false">-Select-</option>
      <option
        v-for="(item, i) in items"
        :key="'item-'+item.title+'-'+i"
        :value="item.click"
      >{{item.title}}</option>
    </select>
    <button type="button" class="btn btn-default btn-primary" @click="select">+Add Block</button>
  </div>
  <!--div class="relative group">
    <div class="flex items-center cursor-pointer py-1">
      <button class="btn-default btn-primary" type="button">
        <slot></slot>
      </button>
    </div>
    <div class="items-center absolute border border-t-0 bg-white invisible- group-hover:visible">
      <ul class="list-reset">
        <li v-for="(item, i) in items" :key="'item-'+item.title+'-'+i">
          <a
            @click.prevent="item.click"
            href="#"
            class="px-4 py-2 block text-black hover:bg-grey-light"
          >{{item.title}}</a>
        </li>
      </ul>
    </div>
  </div-->
</template>
<script>
export default {
  props: {
    items: {
      type: Array,
      required: true
    }
  },
  mounted(){
      if(this.items[0])
        this.selected = this.items[0].click;
  },
  data() {
    return {
      selected: null
    };
  },
    methods: {
        select: function(){
            console.log(this.selected)
            if(this.selected)
                this.selected();
        }
    }
};
</script>

