<template>
  <div
    class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200"
  >
    <div class="overflow-x-auto">
      <table class="w-screen md:w-full">
        <thead class="bg-white text-gray-900 border-b border-gray-300">
          <tr>
            <th class="py-3 px-6 text-left font-medium">ID</th>
            <th
              v-for="property in this.properties"
              class="py-3 px-6 font-medium"
              :class="{
                'text-left': property.align == 'left' || !property.align,
                'text-center': property.align == 'center',
                'text-right': property.align == 'right',
              }"
            >
              {{ property.name }}
            </th>
            <th v-if="this.showBars" class="py-3 px-6 text-right font-medium">
              <i class="fa fa-bars"></i>
            </th>
          </tr>
        </thead>
        <tbody class="text-gray-900 divide-y divide-gray-300">
          <slot />
        </tbody>
      </table>
    </div>

    <div class="p-6 border-t border-gray-300 flex flex-col gap-4 md:flex-row md:justify-between md:items-center">
      <div class="text-gray-900">
        Show
        <span class="font-medium text-blue-600">{{ this.showObjects }}</span>
        from
        <span class="font-medium text-blue-600">{{ this.countObjects }}</span>
      </div>

      <div class="flex space-x-2">
        <button
          @click="this.editPage(this.currentPage - 1)"
          class="w-10 h-10 flex shrink-0 items-center justify-center border border-gray-800 hover:border-gray-800 cursor-pointer rounded-lg hover:bg-gray-800 text-gray-800 hover:text-white transition-colors"
        >
          <i class="fas fa-chevron-left"></i>
        </button>
        <div class="flex items-center pb-2 md:pb-0 gap-2 overflow-y-scroll md:overflow-auto w-full">
          <button
            v-for="page in this.pages"
            @click="this.editPage(page)"
            :class="{
              'bg-blue-600 text-white border-blue-600':
                page == this.currentPage,
              'border-gray-800': page != this.currentPage,
            }"
            class="w-10 h-10 flex shrink-0 cursor-pointer items-center justify-center border hover:border-blue-600 hover:bg-blue-600 hover:text-white text-gray-800 rounded-lg"
          >
            {{ page }}
          </button>
        </div>

        <button
          @click="this.editPage(this.currentPage + 1)"
          class="w-10 h-10 flex shrink-0 items-center justify-center border border-gray-800 hover:border-gray-800 rounded-lg hover:bg-gray-800 text-gray-800 cursor-pointer hover:text-white transition-colors"
        >
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    type: "",
    showBars: true,
    showObjects: 0,
    countObjects: 0,
    inPage: {
      type: Number,
      default: 20,
    },
    currentPage: {
      type: Number,
      default: 1,
    },
    properties: [],
  },
  methods: {
    editPage(page) {
      if (page < 1) {
        page = 1;
      }

      if (page > this.pages) {
        page = this.pages;
      }

      this.$emit("page", page);
    },
  },
  computed: {
    pages() {
      return Math.ceil(this.countObjects / this.inPage);
    },
  },
};
</script>
<style lang=""></style>
