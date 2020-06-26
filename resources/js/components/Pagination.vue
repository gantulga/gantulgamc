<template>
    <div v-show="carousel.pageCount > 1" class="VueCarousel-pagination absolute pin-b mb-4 md:mb-6 mx-auto px-6 w-full">
        <div class="container mx-auto px-4">
            <ul class="flex items-center justify-center md:justify-end list-reset" role="tablist">
            <li
                class="mx-1"
                v-bind:class="{ 'active': isCurrentDot(index) }"
                aria-hidden="false"
                role="presentation"
                v-for="(page, index) in paginationCount"
                :key="`${page}_${index}`"
                v-on:click="goToPage(index)"
            >
                <button
                type="button"
                role="button"
                aria-label="`Item ${index}`"
                :title="`Item ${index}`"
                class="h-1 w-3 rounded-full md:w-12 md:rounded-none"
                :class="(isCurrentDot(index) ? 'bg-secondary' : 'bg-grey-lightest')"
                :tabindex="0"

                ></button>
            </li>
            </ul>
        </div>
    </div>
</template>

<script>
import Pagination from '../../../node_modules/vue-carousel/src/Pagination.vue';

export default {
    extends: Pagination,
};
</script>

<style>

</style>
