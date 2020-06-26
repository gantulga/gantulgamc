<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
export default {
    data() {
        return { panels: [] };
    },
    mounted() {
        this.panels = this.$children;
        console.log('accordion mounted')
    },
    methods: {
        selectPanel(selectedPanel){
            this.panels.forEach(panel => {
                panel.isActive = (panel.name == selectedPanel.name);
            });
        }
    },
}
</script>
