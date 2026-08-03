<template>
  <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">
      {{ this.label }}
    </label>
    <VueDatePicker
      class="date-input"
      :model-value="this.modelValue ? this.modelValue : new Date().setMinutes(15)"
      :time-config="{
        enableSeconds: false,
        is24: false,
        minutesIncrement: 15,
      }"
      @update:model-value="(value) => $emit('update:modelValue', value)"
    ></VueDatePicker>
  </div>
</template>
<script>
import { VueDatePicker } from "@vuepic/vue-datepicker";

export default {
  name: "InputText",
  components: {
    VueDatePicker,
  },
  props: {
    modelValue: {
      type: String,
      default: "",
    },
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
      default: true,
    },
  },
  emits: ["update:modelValue"],
};
</script>
<style scoped>
.date-input {
  --dp-background-color: #f9fafb;
  --dp-input-padding: calc(var(--spacing) * 3) calc(var(--spacing) * 4);
}

.select {
  --vs-background-color: #f9fafb;
  --vs-padding: calc(var(--spacing) * 3) calc(var(--spacing) * 4);
}
</style>
