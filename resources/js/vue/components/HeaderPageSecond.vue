<template>
  <div
    class="relative bg-gradient-to-r from-gray-800 to-gray-900 p-6 border-b border-gray-800 w-full"
  >
    <div class="flex items-start gap-6">
      <div class="relative">
        <div
          class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-3xl"
        >
          {{ String(this.client?.name).slice(0, 1) }}
        </div>
        <button
          class="absolute cursor-pointer bottom-0 right-0 w-6 h-6 rounded-full bg-gray-800 border border-gray-600 flex items-center justify-center text-gray-400 hover:text-blue-400 transition"
        >
          <i class="fas fa-camera text-xs"></i>
        </button>
      </div>

      <div class="flex-1">
        <div class="flex items-center gap-3 flex-wrap">
          <h2 class="text-2xl font-bold text-white">
            {{ this.client?.name }}
          </h2>
        </div>
        <div class="flex items-center gap-4 mt-3 text-sm text-gray-400">
          <span
            ><i class="fas fa-calendar-alt mr-1"></i> from
            {{ new Date(this.client?.created_at).getFullYear() }}</span
          >
          <span
            ><i class="fas fa-id-card mr-1"></i># {{ this.client?.id }}</span
          >
        </div>
      </div>

      <!-- BUTTONS -->
      <div class="flex gap-6">
        <!-- EDIT/SAVE -->
        <div
          v-if="this.$store.state.user?.isAdmin"
          class="flex items-center justify-between"
        >
          <div class="flex gap-3">
            <button
              v-if="this.isEdit"
              @click="this.save()"
              class="w-10 h-10 cursor-pointer bg-blue-600 hover:bg-blue-500 text-white p-2 rounded-md transition flex items-center gap-2 text-lg"
            >
              <i class="fas fa-save"></i>
            </button>
            <button
              v-if="!this.isEdit"
              @click="this.isEdit = true"
              class="w-10 h-10 cursor-pointer bg-blue-600 hover:bg-blue-500 text-white p-2 rounded-md transition flex items-center gap-2 text-lg"
            >
              <i class="fas fa-edit"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style></style>
