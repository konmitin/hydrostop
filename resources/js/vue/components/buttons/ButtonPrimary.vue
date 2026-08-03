<template>
  <button
    class="bg-blue-600 hover:bg-blue-700 cursor-pointer text-white px-4 py-2 rounded-md flex items-center transition-all shadow-lg"
  >
    <i v-if="this.icon" :class="'fas ' + this.icon + ' mr-2'"></i>
    <span>{{ this.title ?? 'Добавить' }}</span>
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
