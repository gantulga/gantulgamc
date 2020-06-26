<script>
import { Slide } from "vue-carousel";

export default {
  extends: Slide,
  mounted(){
      var inner = this.$el.getElementsByClassName('VueCarousel-slide-inner');
      if(inner.length){
          inner[0].classList.remove('hidden');
      }
  }
};
</script>
