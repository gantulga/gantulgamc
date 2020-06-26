<template>
  <div class="flex flex-col" >
    <div>
      <slot name="header" :toggle="getToggleAccordion()" :isOpen="isOpen"></slot>
    </div>
    <transition name="accordion"
        v-on:before-enter="beforeEnter"
        v-on:enter="enter"
        v-on:after-enter="afterEnter"
        v-on:before-leave="beforeLeave"
        v-on:leave="leave">
        <div v-if="isOpen" style="transition-timing-function: ease-in-out">
            <slot :toggle="toggleAccordion" :isOpen="isOpen"></slot>
        </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isOpen: false
    };
  },
  methods: {
    toggleAccordion(){
        this.isOpen = !this.isOpen;
    },
    getToggleAccordion(){
        return this.toggleAccordion;
    },
    beforeEnter: function(el) {
        el.style.overflow = 'hidden';
        el.style.height = '0';
    },
    enter: function(el) {
        el.style.transitionDuration = this.getTransitionDuration(el);
        el.style.height = el.scrollHeight + 'px';
    },
    afterEnter: function(el) {
        el.style.overflow = 'visible';
        el.style.height = 'auto';
    },
    beforeLeave: function(el) {
        el.style.height = el.scrollHeight + 'px';
        el.style.transitionDuration = this.getTransitionDuration(el);
        el.style.overflow = 'hidden';
    },
    leave: function(el) {
        el.style.height = '0';
    },
    getTransitionDuration(el) {
        return Math.min(el.scrollHeight * 3, 500) + 'ms'
    },
  },
};
</script>
