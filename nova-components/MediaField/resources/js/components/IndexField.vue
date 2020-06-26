<template>
    <span>{{ field.value }}
        <span v-if="field.value">

            <img v-if="field.thumbnailUrl" :src="field.thumbnailUrl" style="object-fit: cover;" class="rounded-full w-8 h-8" />
            <span v-else>&mdash;</span>

        </span>

        <span v-else>&mdash;</span>
    </span>

</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
