<template>
  <form method="POST" :action="action" ref="form" @submit.prevent="submit">
    <alert-success v-if="successMessage" :message="successMessage" />
    <slot
      v-else
      :values="fieldValues"
      :errors="{...validationErrors}"
      :options="options"
      :submitting="submitting"
    />
    <div v-if="submitting" class="fixed z-30 pin bg-grey-50 flex items-center"><Loader fill="rgb(64, 175, 158)" style="width:6rem;" /></div>
  </form>
</template>
<script>
import { Errors } from "form-backend-validation";
import Loader from "./../components/Loader";

export default {
  components: { Loader },
  props: {
    action: { type: String, required: true },
    values: { type: Object, required: false, default: () => {} },
    errors: { type: [Object, Array], required: false },
    options: { type: Object, required: false, default: () => {} },
    success: { type: String, required: false }
  },
  created() {
    this.validationErrors = JSON.parse(JSON.stringify(this.errors)); //{...this.errors}; // this.errors instanceof Errors ? this.errors : new Errors(this.errors);
    this.fieldValues = this.values;
    this.successMessage = this.success;
  },
  mounted() {},
  data() {
    return {
      validationErrors: [],
      fieldValues: {},
      successMessage: null,
      submitting: false
    };
  },
  methods: {
    async submit() {
      this.submitting = true;
      var formData = new FormData(this.$refs.form);
      try {
        const response = await axios.post(this.action, formData);
        this.successMessage = response.data.message;
        this.scrollIntoElement(".alert.alert-success");
      } catch (error) {
        if (error.response && error.response.status == 422) {
          this.validationErrors = error.response.data.errors; // new Errors(error.response.data.errors);
          this.scrollIntoElement(".has-error");
        }
      }
      this.submitting = false;
    },
    scrollIntoElement(selector) {
      this.$nextTick(() => {
        var el = this.$el.querySelector(selector);
        if (el) {
          el.scrollIntoView({
            behavior: "smooth",
            block: "center",
            inline: "center"
          });
        }
      });
    }
  }
};
</script>
