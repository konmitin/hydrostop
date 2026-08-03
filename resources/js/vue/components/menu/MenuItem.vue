<template>
  <router-link :to="this.link" class="flex gap-2 items-center h-12 w-full rounded-lg transition-all duration-200">
    <i :class="'fas fa-solid ' + this.icon + ' text-md'"></i>
    <span v-if="this.showTitle" class="font-medium text-sm">{{ this.title }}</span>
  </router-link>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: ""
    },
    link: {
      type: String,
      default: ""
    },
    icon: {
      type: String,
      default: ""
    },
    activeTab: {
      type: String,
      default: ""
    },
    showTitle: {
      type: Boolean,
      default: true
    },
  }
}
</script>
