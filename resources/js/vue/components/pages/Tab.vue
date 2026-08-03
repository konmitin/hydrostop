<template>
  <button
    @click="this.$emit('update:modelValue', this.tab)"
    :class="{
      'text-gray-900 border-b-gray-900': this.modelValue == this.tab,
    }"
    class="px-6 py-3 text-gray-400 hover:text-gray-900 cursor-pointer border-b border-b-gray-400 hover:border-b-gray-900"
  >
    {{ this.name }}
  </button>
</template>
<script>
export default {
  emits: ["tab"],
  props: {
    name: {
      type: String,
      default: "",
    },
    tab: {
      type: String,
      default: "",
    },
    modelValue: {
      type: String,
      default: "",
    },
  },
};
</script>
<style></style>
