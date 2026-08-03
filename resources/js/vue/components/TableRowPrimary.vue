<template>
  <tr
    data-object
    :class="{ 'cursor-pointer': this.isClickable }"
    class="hover:bg-gray-100 transition-colors"
    :key="this.objectId"
  >
    <TableColumnPrimary key="id">
      {{ this.objectId }}
    </TableColumnPrimary>

    <slot />
  </tr>
</template>
<script>
import TableColumnPrimary from "./TableColumnPrimary.vue";

export default {
  components: {
    TableColumnPrimary,
  },
  props: {
    isClickable: {
      type: Boolean,
      default: true,
    },
    objectId: 0,
    key: "",
  },
};
</script>
<style lang=""></style>
