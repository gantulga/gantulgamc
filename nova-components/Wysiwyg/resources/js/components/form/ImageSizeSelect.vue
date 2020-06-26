<template>
    <select :value="value" @change="handleSelect">
        <option>-</option>
        <optgroup v-for="(sizes,ratio) in sizes" :label="ratio" :key="ratio">
          <option
            v-for="size in sizes"
            :value="size"
            :key="size"
          >{{size}}</option>
        </optgroup>
      </select>
</template>
<script>
export default {
    props: ['value'],
    data(){
        return {
            sizes: {
                '16:9': ['320x180','640x360','960*540','1280x720','1600x900','1920x1080'],
                '3:2': ['270x180','540x360','810x540','1080x720','1350x900','1620x1080'],
                '4:3': ['256x192','512x384','768x576','1024x768','1280x960','1536x1152'],
                '1:1': ['100x100','200x200','400x400','800x800','1000x1000'],
            }
        }
    },
    methods:{
        handleSelect(event){
            this.$emit('input',event.target.value)
        }
    }
}
</script>
