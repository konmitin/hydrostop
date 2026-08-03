<template>
  <div class="flex items-center justify-between">
    <div class="flex gap-3">
      <button
        v-if="this.isEdit"
        @click="$emit('save')"
        class="w-10 h-10 cursor-pointer bg-blue-600 hover:bg-blue-500 text-white p-2 rounded-md transition flex items-center gap-2 text-lg"
      >
        <i class="fas fa-save"></i>
      </button>
      <button
        v-if="!this.isEdit"
        @click="$emit('edit')"
        class="w-10 h-10 cursor-pointer bg-blue-600 hover:bg-blue-500 text-white p-2 rounded-md transition flex items-center gap-2 text-lg"
      >
        <i class="fas fa-edit"></i>
      </button>
    </div>
  </div>
</template>
<script>
export default {
  emits: ["save", "edit"],
  props: {
    isEdit: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
<style></style>
