<template>
  <div>
    <label class="block text-xs text-gray-600 mb-1 uppercase font-medium">{{ this.title }}
    </label>
    <input @input="this.formatting" v-model="this.value" type="text" :class="{
      '!border-red-600': this.isError,
      '!border-blue-600': !this.isError
    }" class="w-full input-field rounded-sm px-4 py-3 text-gray-900 pr-10 placeholder:text-gray-600"
      :placeholder="this.placeholder" :required="this.isRequired" />
  </div>
</template>
<script>
import { useGlobalNotification } from "../../composables/globalNotification";
const { showNotify, closeNotify } = useGlobalNotification();

export default {
  data() {
    return {
      value: "",
      isError: false,
    };
  },
  props: {
    title: {
      type: String,
      default: "",
    },
    modelValue: {
      type: String,
      default: "",
    },
    maxWidth: {
      type: Number,
      default: 0,
    },
    placeholder: {
      type: String,
      default: "",
    },
    isRequired: {
      type: Boolean,
      default: false,
    },
  },
  created() {
    this.value = this.modelValue;
  },
  methods: {
    formatting(event) {
      let value = event.target.value;

      let newValue = this.cleanNumber(value);
      newValue = this.toLocaleNumber(newValue);

      this.value = newValue;
      this.$emit("update:modelValue", newValue);
    },
    cleanNumber(str) {
      let s = str.replace(/[^\d.]/g, "");

      if (this.maxWidth > 0 && s.length > this.maxWidth) {
        s = String(s).split('').splice(0, this.maxWidth).join('');
        this.isError = true;

        showNotify(`Поле ${this.title} должно содержать только ${this.maxWidth} цифры`, 'error', 3000);
      } else {
        this.isError = false;
      }

      const dotIndex = s.indexOf(".");

      let s2 = String(s).split(".");

      if (dotIndex === -1) {
        return s;
      }

      return s;
    },
    toLocaleNumber(number) {
      let str = "";

      if (!Number(number)) {
        return "0";
      }

      str += Number(number).toLocaleString("ru-Ru");

      return str;
    },
  },
};
</script>
<style></style>
