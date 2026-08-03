<template>
  <router-link
    :to="link"
    class="w-8 h-8 rounded-full cursor-pointer bg-sky-500 bg-opacity-20 text-blue-400 flex items-center justify-center hover:bg-sky-600 hover:text-white transition-colors"
  >
    <i class="fas fa-eye text-sm text-gray-100"></i>
  </router-link>
</template>
<script>
export default {
  props: {
    link: {
      type: String,
      default: "",
    },
  },
};
</script>
<style lang=""></style>
