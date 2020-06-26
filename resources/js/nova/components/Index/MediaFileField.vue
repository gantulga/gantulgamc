<template>

        <div
            v-if="field.thumbnailUrl"
            class="flex items-center"
            style="max-width:8rem; min-width: 9rem; min-height:5.5rem; margin:0.4rem 0;"
            :style="isImage ? 'background-color:#eeeeeec7;':''"
        >
            <img
                :src="field.thumbnailUrl"
                class="block"
                style="object-fit: cover; margin:0 auto;"
                :style="isImage ? 'max-height:7rem; min-height:3rem;':'max-height:4rem;'"
            />
        </div>
        <span v-else>&mdash;</span>

</template>

<script>
export default {
    props: ['viaResource', 'viaResourceId', 'resourceName', 'field'],
    computed: {
        isImage(){
            if(this.field.thumbnailUrl){
                var file = this.field.value;
                return file.endsWith('.jpg') || file.endsWith('.jpeg') || file.endsWith('.png') || file.endsWith('.bmp') || file.endsWith('.gif') || file.endsWith('.svg');
            }
            return false;
        }
    }
}
</script>
