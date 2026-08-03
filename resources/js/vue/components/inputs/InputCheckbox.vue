<template>
  <div>
    <label class="block text-sm font-medium uppercase text-gray-700 mb-2">
      {{ this.label }}
    </label>
    <input
      :checked="this.modelValue"
      @input="$emit('update:modelValue', $event.target.checked)"
      type="checkbox"
      :name="this.name"
      class="w-6 h-6 rounded-sm text-gray-900 cursor-pointer"
      :placeholder="this.placeholder"
      :required="isRequired"
    />
  </div>
</template>
<script>
export default {
  props: {
    modelValue: {
      type: Boolean,
      default: false,
    },
    label: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      default: "text",
    },
    name: {
      type: String,
      default: "text",
    },
    placeholder: {
      type: String,
      default: "",
    },
    isRequired: {
      type: Boolean,
      default: true,
    },
  },
  emits: ["update:modelValue"],
};
</script>
<style></style>
