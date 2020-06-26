<template>
    <span>{{ field.value.map(cur=>cur.display).join(', ') }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
