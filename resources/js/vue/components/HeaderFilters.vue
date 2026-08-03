<template>
  <div class="bg-white p-6 rounded-md border border-gray-200">
    <div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center">
      <h3 class="text-xl font-bold text-gray-900">{{ this.title }}</h3>
      <div class="flex gap-4 relative">
        <ButtonSecondary
          v-if="Object.keys(this.filters).length > 0"
          @click="
            this.isShowModal = true;
            this.$emit('openFilter');
          "
          icon="fa-filter"
          title="Фильтры"
          :isCountable="true"
          :count="Object.keys(this.active).length"
        />
        <ButtonSecondary icon="fa-sort" title="Сортировка" :isCountable="true" />
      </div>
    </div>
  </div>

  <FilterModal
    v-if="this.isShowModal"
    :filters="this.filters"
    @save="
      (filters) => {
        this.$emit('filter', filters);
        this.isShowModal = false;
      }
    "
    @cancel="(filters) => {
      this.$emit('filter', filters);
      this.isShowModal = false;
    }"
    @close="this.isShowModal = false"
  />
</template>
<script>
import FilterModal from "./modal/FilterModal.vue";

export default {
  data() {
    return {
      isShowModal: false,
    };
  },
  emits: ["openFilter", "filter"],
  components: {
    FilterModal,
  },
  props: {
    title: {
      type: String,
      default: "",
    },
    active: {
      type: Object,
      default: {},
    },
    filters: {
      type: Object,
      default: {},
    },
  },
};
</script>
<style></style>
