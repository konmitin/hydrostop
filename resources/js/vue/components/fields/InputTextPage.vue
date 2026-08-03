<template>
  <div>
    <label :for="this.name" v-if="this.title" class="block text-xs text-gray-600 mb-1 uppercase font-medium">
      <i v-if="this.icon" :class="this.icon" class="mr-1 text-blue-500"></i>
      {{ this.title }}
    </label>
    <input :autocomplete="this.name" :id="this.name" :name="this.name"
      @input="this.$emit('update:modelValue', $event.target.value)"  :value="this.modelValue" :type="this.type ?? 'text'"
      class="w-full h-12 input-field rounded-sm px-4 py-3 text-gray-900 pr-10 placeholder:text-gray-600"
      :placeholder="this.placeholder" :required="this.isRequired" />
  </div>
</template>
<script>
export default {
  data() {
    return {
      value: this.modelValue ?? "",
    };
  },
  emits: ['update:modelValue'],
  props: {
    icon: {
      type: String,
      default: "",
    },
    name: {
      type: String,
      default: "",
    },
    type: {
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
    modelValue: {
      type: String,
      default: "",
    },
  },
  method: {
    created() {
      this.value = this.modelValue;
    },
  }
};
</script>
<style></style>
