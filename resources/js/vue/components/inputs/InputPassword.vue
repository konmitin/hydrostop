<template>
  <div>
    <label
      :for="this.name"
      class="block text-xs text-gray-600 mb-1 uppercase font-medium"
    >
      <i v-if="this.icon" :class="this.icon" class="mr-1 text-blue-500"></i>
      {{ this.label }}
    </label>
    <div class="relative">
      <input
        :id="this.name"
        :value="modelValue"
        :type="this.showPassword ? 'text' : 'password'"
        @input="$emit('update:modelValue', $event.target.value)"
        class="w-full input-field rounded-sm px-4 py-3 text-gray-900 pr-10 placeholder:text-gray-600"
        placeholder="••••••••"
        :required="isRequired"
        :name="this.name"
      />
      <button
        @click="this.toggleShowPassword"
        type="button"
        class="cursor-pointer absolute right-3 top-3 text-gray-400 hover:text-gray-600 transition-colors"
      >
        <i
          id="password-icon"
          class="fas"
          :class="{
            'fa-eye-slash': this.showPassword,
            'fa-eye': !this.showPassword,
          }"
        ></i>
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: "InputPassword",
  data() {
    return {
      showPassword: false,
    };
  },
  props: {
    modelValue: {
      type: String,
      default: "",
    },
    icon: {
      type: String,
      default: "",
    },
    label: {
      type: String,
      default: "Пароль",
    },
    name: {
      type: String,
      default: "password",
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
  methods: {
    toggleShowPassword() {
      this.showPassword = this.showPassword ? false : true;
    },
  },
};
</script>
<style lang=""></style>
