<template>
  <button
    @click="this.$emit('delete')"
    class="w-10 h-10 rounded-lg cursor-pointer bg-red-600 flex items-center justify-center text-white hover:bg-red-700 hover:text-white transition"
  >
    <i class="fas fa-trash text-lg"></i>
  </button>
</template>
<script>
export default {
  emits: ["delete"],
};
</script>
<style lang=""></style>
