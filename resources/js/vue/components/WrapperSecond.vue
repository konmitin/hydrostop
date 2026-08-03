<template>
  <div class="bg-gray-100 text-gray-200">
        <slot />
  </div>
</template>

<script>
export default {
  props: ["class"],
};
</script>
