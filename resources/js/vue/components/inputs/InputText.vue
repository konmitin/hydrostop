<template>
  <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">
      {{ this.label }}
    </label>
    <input
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :type="this.type"
      :name="this.name"
      class="w-full input-field rounded-sm px-4 py-3 text-gray-900"
      :placeholder="this.placeholder"
      :required="isRequired"
    />
  </div>
</template>
<script>
export default {
  name: "InputText",
  props: {
    modelValue: {
      type: String,
      default: "",
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
<style lang=""></style>
