<template>
  <div>
    <label class="block text-xs text-gray-600 mb-1 uppercase font-medium">
      {{ this.title }}
    </label>
    <textarea
      @input="this.$emit('update:modelValue', this.value); console.log(this.value);"
      rows="3"
      class="w-full input-field rounded-sm px-4 py-3 text-gray-900 pr-10"
      :placeholder="this.placeholder"
      v-model="this.value"
    >
      {{ this.value }}
      </textarea
    >
  </div>
</template>
<script>
export default {
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
    placeholder: {
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
