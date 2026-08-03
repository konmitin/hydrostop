<template>
  <button
    class="px-4 py-2 cursor-pointer relative border border-gray-600 rounded-lg bg-gray-600 hover:bg-gray-700 text-white transition-colors"
  >
    <i v-if="this.icon" :class="'fas ' + this.icon + ' mr-2'"></i>
    <span>{{ this.title }}</span>

    <div
      v-if="this.isCountable"
      class="absolute -top-3 -right-4 bg-gray-800 p-1 w-7 h-7 rounded-full text-white text-sm font-medium"
    >
      {{ this.count }}
    </div>
  </button>
</template>

<script>
export default {
  name: "buttons-secondary",
  props: {
    title: {
      type: String,
      default: "",
    },
    icon: {
      type: String,
      default: "",
    },
    count: {
      type: Number,
      default: 0,
    },
    isCountable: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
