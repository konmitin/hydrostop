<template>
  <div>
    <label class="block text-xs text-gray-600 mb-1 uppercase font-medium"
      >{{ this.title }}
    </label>
    <InputPhone
      @input="this.$emit('update:modelValue', this.value)"
      v-model="this.value"
      placeholder="(123) 456-78-90"
      class="w-full input-field rounded-sm px-4 py-3 text-gray-900 pr-10"
    />
  </div>
</template>
<script>
import InputPhone from "../inputs/InputPhone.vue";

export default {
  components: {
    InputPhone,
  },
  data() {
    return {
      value: "",
    };
  },
  props: {
    title: {
      type: String,
      default: "",
    },
    modelValue: {
      type: String,
      default: "",
    },
  },
  created() {
    this.value = this.modelValue;
  },
};
</script>
<style></style>
