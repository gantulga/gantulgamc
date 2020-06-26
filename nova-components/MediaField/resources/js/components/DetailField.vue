<template>
    <panel-item :field="field">
        <template slot="value">
            <div v-for="val in field.value" :key="val.id" class="mb-3"  >
                <ImageLoader :src="field.diskPath + val.file" class="max-w-xs" @missing="(value) => missing = value" />
            </div>
        </template>
    </panel-item>
</template>

<script>
import ImageLoader from '../../../../../nova/resources/js/components/ImageLoader'

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    components: { ImageLoader },
}
</script>
