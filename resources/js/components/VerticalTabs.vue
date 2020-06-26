<template>
  <div class="md:flex -mx-3">
    <div class="w-full md:w-1/4 px-3 md:mb-4">
      <ul data-turbolinks="false" class="tabs list-reset no-underline text-xs font-bold uppercase flex md:flex-col">
        <li
          v-for="(tab, i) in tabs"
          :key="tab.name"
          class="border-b border-grey bg-no-repeat bg-cover md:flex"
          :style="tab.bg && tab.isActive ? {backgroundImage: 'url('+tab.bg+')'} : {}"
        >
          <div class="md:flex w-full" :class="{'bg-white-70': tab.isActive}">
            <span
              :class="{'text-primary': tab.isActive, 'text-grey-lighter': !tab.isActive}"
              class="text-5xl px-4 py-0 pt-0 mt-5 h-16 overflow-hidden leading-none w-1/4 hidden md:block"
              style="font-size: 6rem; line-height: 1; "
            >{{i+1}}</span>
            <a
              class="block leading-tight p-5 text-lg w-3/4"
              :href="tab.href"
              @click="selectTab(tab)"
              v-html="wrapName(tab.name)"
            ></a>
          </div>
        </li>
      </ul>
    </div>
    <div class="w-full md:w-3/4 px-3 mb-4 flex">
        <slot></slot>
    </div>
  </div>
</template>

<script>
import Tabs from "./Tabs.vue";

export default {
  extends: Tabs,

  methods: {
    wrapName(name) {
      return name.replace(" ", "<br>");
    }
  }
};
</script>
