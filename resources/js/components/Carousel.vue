<script>
import { Carousel } from "vue-carousel";
import Pagination from "./Pagination.vue";

export default {
  extends: Carousel,
  components: {
    ...Carousel.components,
    Pagination
  },
};
</script>
