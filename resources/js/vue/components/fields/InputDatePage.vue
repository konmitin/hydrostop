<template>
  <div>
    <label class="block text-xs text-gray-600 mb-1 uppercase font-medium">
      {{ this.title }}
    </label>
    <VueDatePicker class="date-input" :model-value="this.modelValue ? this.modelValue : new Date().setMinutes(15)
      " :time-config="{
        enableSeconds: false,
        is24: true,
        minutesIncrement: 15,
      }" @update:model-value="(value) => $emit('update:modelValue', value)"></VueDatePicker>
  </div>
</template>
<script>
export default {
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
