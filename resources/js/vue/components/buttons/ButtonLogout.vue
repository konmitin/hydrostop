<template>
  <a
    id="logout"
    href="/h-admin/logout"
    @click.prevent="this.logout()"
    class="w-8 h-8 rounded-full bg-sky-600 flex items-center justify-center text-white hover:text-white hover:bg-sky-700 transition-colors"
  >
    <i class="fas fa-sign-out-alt text-sm"></i>
  </a>
</template>

<script>
import axios from "../../axios";

export default {
  methods: {
    async logout() {
      console.log("");
      axios.post("/user/logout").then((response) => {
        console.log(response);
        this.$router.push("/h-admin/auth");
      });
    },
  },
};
</script>
