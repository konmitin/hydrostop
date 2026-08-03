<template>
  <button
    class="bg-blue-600 cursor-pointer hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md transition flex items-center gap-2"
  >
    <i v-if="this.icon" :class="'fas ' + this.icon"></i>
    <span>{{ this.title }}</span>
  </button>
</template>

<script>
export default {
  name: "buttons-primary",
  props: {
    title: {
      type: String,
      Default: "",
    },
    icon: {
      type: String,
      Default: "",
    },
  },
};
</script>
