<template>
  <User v-if="this.user" :objectId="this.user.id" />
</template>
<script>
import User from "./User.vue";

export default {
  components: {
    User,
  },
  async created() {
    document.title = "Profile | CarAdmin";
  },
  computed: {
    user() {
      return this.$store.state.user;
    },
  },
};
</script>
<style scoped>
.thin-scroll::-webkit-scrollbar {
  width: 5px;
}

.thin-scroll::-webkit-scrollbar-track {
  background: #1f2937;
}

.thin-scroll::-webkit-scrollbar-thumb {
  background: #4b5563;
  border-radius: 12px;
}

@keyframes slideIn {
  from {
    transform: translateX(100%);
    opacity: 0;
  }

  to {
    transform: translateX(0);
    opacity: 1;
  }
}

.modal-slide {
  animation: slideIn 0.3s ease-out forwards;
}

input:focus,
select:focus,
textarea:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
}

/* Стили для переключателя ролей */
.role-switch {
  transition: all 0.2s ease;
}
</style>
