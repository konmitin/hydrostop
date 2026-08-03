<template>
  
  <div class="bg-white text-gray-200">
    <div class="flex h-screen overflow-hidden">
      <KeepAlive>
        <left-aside @show="(val) =>{ this.showMenu = val}">
          <menu-view :showTitle="this.showMenu"></menu-view>
        </left-aside>
      </KeepAlive>

      <div class="flex-1 flex flex-col bg-white pl-20 md:pl-0 w-full">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      showMenu: false,
    }
  },
  props: {
    class: "",
  },
};
</script>
