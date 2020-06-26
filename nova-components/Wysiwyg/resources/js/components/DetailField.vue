<template>
    <div class="flex border-b border-40">
        <div class="flex-2 py-4" v-if="field.value" v-html-="field.value">
            <excerpt :content="field.value" :should-show="false" />
        </div>
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
