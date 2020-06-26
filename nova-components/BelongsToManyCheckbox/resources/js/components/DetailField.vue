<template>
    <panel-item :field="fieldFormmatted" />
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    computed: {
        fieldFormmatted() {
            return {
               ...this.field, value: this.field.value.map(cur=>cur.display).join(', ')
            }
        }
    }
}
</script>
