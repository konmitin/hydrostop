<template>
  <div
    @mousemove="this.toggleShow(true)"
    @mouseleave="this.toggleShow(false)"
    :class="{
      'show min-w-64 shadow-2xl': this.isShow && this.isMobile,
      'w-20 min-w-none hover:min-w-64': !this.isShow,
      'bg-white h-full text-gray-900 md:min-w-64 flex flex-col border-r border-gray-300 absolute md:relative z-40': true,
    }"
  >
    <div class="min-h-20 h-20 p-4 border-b border-gray-300 relative">
      <div class="flex items-center space-x-3">
        <div
          class="w-10 h-10 flex items-center justify-center"
        >
          <img class="object-cover" v-show="this.isShow" :src="'/storage/img/logo_icon_dark.png'" alt="" />
          <i
            @click="this.toggleShow(true)"
            v-if="!this.isShow"
            class="fa fa-bars"
          ></i>
        </div>
        <div v-if="this.isShow">
          <h1 class="text-xl font-bold text-gray-900">ГидроСтоп</h1>
          <p class="text-xs text-gray-700">Админ Панель</p>
        </div>
      </div>
    </div>

    <div class="overflow-y-scroll">
      <slot />
    </div>

    <!-- Profile -->
    <div class="p-4 border-t border-gray-300 bg-white">
      <div class="flex gap-4 items-center">
        <router-link id="profile" :to="`/h-admin/profile`" class="flex flex-1">
          <div
            id="avatar"
            class="w-10 h-10 bg-sky-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg"
          >
            {{ String(this.$store.state.user?.name).slice(0, 1) }}
          </div>
          <div v-if="this.isShow" class="ml-4">
            <p class="font-medium text-gray-900">
              {{ this.$store.state.user?.name }}
            </p>
            <p class="text-xs text-gray-700">
              {{ this.$store.state.user?.email }}
            </p>
          </div>
        </router-link>

        <div v-if="this.isShow" class="flex space-x-1">
          <button-logout></button-logout>
        </div>
      </div>
    </div>

    <button
      @click="this.toggleShow(false)"
      v-if="this.isShow && this.isMobile"
      class="absolute w-8 h-8 rounded-lg top-4 -right-12 z-50 flex items-center justify-center bg-blue-600 hover:bg-gray-700 cursor-pointer"
    >
      <i class="fas text-white text-sm fa-chevron-left"></i>
    </button>
  </div>
</template>

<script>
export default {
  emits: ["show"],
  data() {
    return {
      isShow: false,
      isMobile: false,
    };
  },
  created() {
    this.isMobile = window.matchMedia(
      "only screen and (max-width: 768px)",
    ).matches;
    
    this.isShow = this.isMobile ? false : true;

    this.$emit("show", this.isShow);
  },
  methods: {
    toggleShow(val) {

      if (!this.isMobile) {
        return;
      }

      console.log(this.isMobile);
      this.isShow = val;
      this.$emit("show", this.isShow);
    },
  },
};
</script>
