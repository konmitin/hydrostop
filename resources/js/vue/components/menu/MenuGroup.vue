<template>
  <div>
    <div
      class="flex cursor-pointer items-center justify-between text-gray-600 hover:text-gray-900 gap-2 text-xs font-semibold mb-2"
    >
      <h3 class="uppercase tracking-wider overflow-hidden w-full text-nowrap">{{ this.title }}</h3>
      <i class="fa fa-angle-right"></i>
    </div>
    <div class="space-y-1">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
    props: ['title', 'activeGroup'],
}
</script>
