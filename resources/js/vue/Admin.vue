<template>
  <GlobalNotification />
  <router-view
    @vue:before-update="this.$store.dispatch('getUser')"
  ></router-view>
</template>

<script>
import GlobalNotification from "./components/GlobalNotification.vue";

export default {
  name: "Admin",
  components: {
    GlobalNotification,
  },
  async beforeCreate() {
    await this.$store.dispatch("getUser");
  },
};
</script>
