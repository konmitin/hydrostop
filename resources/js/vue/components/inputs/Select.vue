<template>
  <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">
      {{ this.label }}
    </label>
    <VueSelect
      class="select cursor-pointer"
      v-model="this.value"
      @optionSelected="
        $emit('update:modelValue', this.value);
        $emit('optionSelected');
      "
      @optionDeselected="
        $emit('update:modelValue', this.value);
        $emit('optionDeselected');
      "
      :is-multi="this.isMulti"
      :options="this.options"
      :get-option-label="this.getOptionLabel"
      :get-option-value="this.getOptionValue"
      :required="isRequired"
      :placeholder="this.placeholder"
    />
  </div>
</template>
<script>
import VueSelect from "vue3-select-component";

export default {
  name: "Select",
  emits: ["optionSelected"],
  components: {
    VueSelect,
  },
  data() {
    return {
      value: this.modelValue,
    };
  },
  props: {
    modelValue: null,
    label: {
      type: String,
      default: "",
    },
    placeholder: {
      type: String,
      default: "",
    },
    isRequired: {
      type: Boolean,
      default: false,
    },
    options: [],
    getOptionLabel: null,
    getOptionValue: null,
    isMulti: {
      type: Boolean,
      default: false,
    },
  },
  emits: ["update:modelValue"],
};
</script>
<style scoped>
.select {
  --vs-background-color: #f9fafb;
  --vs-padding: calc(var(--spacing) * 3) calc(var(--spacing) * 4);
}
</style>
