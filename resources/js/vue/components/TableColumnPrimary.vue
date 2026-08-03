<template>
  <td
    :key="this.key"
    class="py-4 px-6 max-w-96 overflow-hidden"
    :class="{
      'text-left': textAlign == 'left',
      'text-center': textAlign == 'center',
      'text-right': textAlign == 'right',
    }"
  >
    <slot />
  </td>
</template>
<script>
export default {
  props: {
    key: "",
    textAlign: {
      type: String,
      default: "left",
    },
  },
};
</script>
<style lang=""></style>
