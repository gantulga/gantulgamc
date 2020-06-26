<template>
  <loading-card :loading="loading" class="metric px-6 py-4 relative">
    <div class="flex mb-4">
      <h3 class="mr-3 text-base text-80 font-bold">{{ card.name }}</h3>
    </div>
    <div class="flex items-center text-4xl mb-4">
      {{ formattedValue }}
      <span
        v-if="suffix"
        class="ml-2 text-sm font-bold text-80"
      >{{ formattedSuffix }}</span>
    </div>

    <star-rating
      :read-only="true"
      :id="card.name"
      :name="card.name"
      :rating="value || 0"
      :max-rating="card.max"
      :increment="card.increment"
      :show-rating="card.showRating || false"
      :star-size="card['star-size'] || 25"
      :inactive-color="card['inactive-color']"
      :active-color="card['active-color']"
      :border-color="card['border-color']"
      :border-width="card['border-width']"
      :padding="card['padding']"
      :rounded-corners="card['rounded-corners']"
      :inline="card['inline']"
      :glow="card['glow']"
      :glow-color="card['glow-color']"
      :text-class="card['text-class']"
    />
  </loading-card>
</template>

<script>
import { Minimum } from 'laravel-nova'
import StarRating from "vue-star-rating";

export default {
  components: { StarRating },
  props: {
    card: {
      type: Object,
      required: true
    },
    resourceName: {
      type: String,
      default: ""
    },
    resourceId: {
      type: [Number, String],
      default: ""
    },
    loading: { default: true },
    value: { default: 0 }
  },
  data() {
    return {
      prefix: "",
      suffix: "",
      format: ""
    };
  },

  mounted() {
    this.fetch();
  },

  methods: {
    fetch() {
      this.loading = true;

      Minimum(Nova.request().get(this.metricEndpoint)).then(
        ({
          data: {
            value: { value, prefix, suffix, format }
          }
        }) => {
          this.value = Math.round(value*100)/100;
          this.format = format || this.format;
          this.prefix = prefix || this.prefix;
          this.suffix = suffix || this.suffix;
          this.loading = false;
        }
      );
    },

  },
  computed: {
    formattedValue() {
      return this.prefix + this.value;
    },
    formattedSuffix() {
      return this.suffix || "";
    },
    metricEndpoint() {
      if (this.resourceName && this.resourceId) {
        return `/nova-api/${this.resourceName}/${this.resourceId}/metrics/${
          this.card.uriKey
        }`;
      } else if (this.resourceName) {
        return `/nova-api/${this.resourceName}/metrics/${this.card.uriKey}`;
      } else {
        return `/nova-api/metrics/${this.card.uriKey}`;
      }
    }
  }
};
</script>
