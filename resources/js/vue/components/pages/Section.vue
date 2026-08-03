<template>
  <div class="bg-white rounded-md p-5 border border-gray-200">
    <div v-if="this.title || this.icon" class="flex items-center gap-4 mb-4">
      <h3
        v-if="this.title"
        class="text-sm font-semibold text-blue-600 uppercase tracking-wider flex items-center gap-2"
      >
        <i v-if="this.icon" :class="`fas ${this.icon}`"></i> {{ this.title }}
      </h3>

      <div class="">
        <slot name="buttons"></slot>
      </div>
    </div>

    <div class="">
      <div v-if="!this.isEdit" :class="`grid grid-cols-1 md:grid-cols-${this.cols} gap-4`">
        <slot name="view"></slot>
      </div>

      <div v-if="this.isEdit" :class="`grid grid-cols-1 md:grid-cols-${this.cols} gap-4`">
        <slot name="edit"></slot>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      default: "",
    },
    icon: {
      type: String,
      default: "",
    },
    cols: {
      type: Number,
      default: 1,
    },
    isEdit: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
<style></style>
