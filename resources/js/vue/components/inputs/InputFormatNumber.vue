<template>
  <input
    @input="this.formattingPrice"
    v-model="this.input"
    type="text"
  />
</template>
<script>
export default {
  data() {
    return {
      input: this.modelValue,
    };
  },
  props: {
    modelValue: {
      type: String,
      default: "",
    },
  },
  methods: {
    formattingPrice(event) {
      let value = event.target.value;

      let newValue = value.replace(",", "");
      newValue = value.replace(/[^\d.]/g, "");

      this.input = newValue;
      this.$emit("update:modelValue", newValue);
    },
  },
};
</script>
<style lang=""></style>
