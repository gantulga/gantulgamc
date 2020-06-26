<template>
  <div>
    <ul data-turbolinks="false" class="tabs flex list-reset no-underline text-xs font-bold uppercase mb-4 border-b border-grey" >
      <li
        v-for="(tab, i) in tabs"
        :key="tab.name"
        class="flex"
        :class="{'border-primary border-b-3': tab.isActive}"
      >
        <a
          :class="{'text-primary': tab.isActive}"
          class="block flex-auto leading-tight p-5 text-lg w-3/4"
          :href="tab.href"
          @click="selectTab(tab)"
          v-html="tab.name"
        ></a>
      </li>
    </ul>
    <div class="mb-4">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return { tabs: [] };
  },
  mounted() {
    this.tabs = this.$children;
  },
  methods: {
    wrapName(name) {
      return name.replace(" ", "<br>");
    },
    selectTab(selectedTab) {
      this.tabs.forEach(tab => {
        tab.isActive = tab.name == selectedTab.name;
      });
    }
  }
};
</script>
