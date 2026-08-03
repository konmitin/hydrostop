<template>
  <header
    class="h-24 bg-gray-800 shadow-lg p-6 flex items-center justify-between border-b border-gray-700"
  >
    <div>
      <h2 class="text-2xl font-bold text-white">{{ this.title }}</h2>
      <p class="text-gray-400 text-sm">{{ this.subtitle ?? "" }}</p>
    </div>

    <div class="flex items-center gap-4">
      <div class="relative">
        <x-admin.buttons.notify
          :notifyCount="$notifyCount"
        ></x-admin.buttons.notify>
      </div>

      <div class="flex gap-4">
        <slot />
      </div>
    </div>
  </header>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: "",
    },
    subtitle: {
      type: String,
      default: "",
    },
    notice: {
      type: String,
      default: "",
    },
  },
};
</script>
