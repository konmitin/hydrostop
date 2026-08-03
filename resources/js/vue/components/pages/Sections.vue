<template>
  <div v-if="this.activeTab == this.section" class="flex flex-col gap-4">
    <slot></slot>
  </div>
</template>
<script>
export default {
  props: {
    section: {
      type: String,
      default: "",
    },
    activeTab: {
      type: String,
      default: "",
    },
  },
};
</script>
<style></style>
