<template>
  <div class="fixed inset-0 flex justify-end z-50 pointer-events-none">
    <div
      class="absolute inset-0 bg-black/40 pointer-events-auto z-30 cursor-default"
    ></div>

    <div
      class="z-40 relative w-full md:max-w-[50vw] bg-gray-100 shadow-lg h-full pointer-events-auto modal-slide border-l border-gray-300"
    >
      <button
        @click="this.$router.back()"
        class="absolute w-12 h-12 rounded-full top-4 -left-16 z-40 flex items-center justify-center bg-blue-600 hover:bg-blue-700 cursor-pointer"
      >
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="overflow-y-auto w-full h-full">
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  emits: ["edit", "save", "close"],
};
</script>
<style scoped></style>
