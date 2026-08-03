<template>
  <div>
    <label class="block text-xs text-gray-600 mb-1 uppercase font-medium">
      {{ this.label || this.title}}
    </label>
    <VueSelect
      class="select cursor-pointer"
      v-model="this.value"
      @optionCreated="
        (value) => {
          $emit('update:modelValue', this.value);
          $emit('optionCreated', value);
          $emit('optionSelected', value);
        }
      "
      @optionSelected="
        (value) => {
          $emit('update:modelValue', this.value);
          $emit('optionSelected', value);
        }
      "
      @optionDeselected="
        (value) => {
          $emit('update:modelValue', this.value);
          $emit('optionDeselected', value);
        }
      "
      :is-multi="this.isMulti"
      :is-taggable="this.isTaggable"
      :options="this.options"
      :get-option-label="this.getOptionLabel"
      :get-option-value="this.getOptionValue"
      :required="this.isRequired"
      :placeholder="this.placeholder"
    />
  </div>
</template>
<script>
import VueSelect from "vue3-select-component";

export default {
  emits: ["optionSelected", "optionDeselected", "optionCreated"],
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
    title: {
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
    isTaggable: {
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
