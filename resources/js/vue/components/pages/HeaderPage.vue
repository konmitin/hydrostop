<template>
  <!-- HEADER -->
  <div class="relative md:h-20 bg-white px-4 py-4 md:py-0 border-b border-gray-300 flex items-center w-full">
    <div class="w-full flex flex-col gap-4 md:flex-row md:items-center md:justify-between gap-2">

      <div class="flex items-center justify-between gap-2">
        <div class="relative">
          <slot class="w-16 h-16" name="avatar"></slot>
        </div>

        <div class="flex-1">
          <h2 class="text-2xl font-bold text-gray-900">
            {{ this.title ?? '' }}
          </h2>
          <div class="flex items-center gap-4 text-sm text-gray-900/80">
            <slot name="subtitle"></slot>
          </div>
        </div>
      </div>


      <!-- BUTTONS -->
      <div class="flex gap-2">
        <slot name="buttons"></slot>

        <HeaderEditSave :is-edit="this.isEdit" @save="$emit('save')" @edit="$emit('edit')" v-if="this.isEditable"/>
        <HeaderDelete @delete="$emit('delete')" v-if="this.isDeletable"/>
      </div>
    </div>
  </div>
</template>
<script>
import HeaderDelete from "../buttons/HeaderDelete.vue";
import HeaderEditSave from "../buttons/HeaderEditSave.vue";

export default {
  components: {
    HeaderEditSave,
    HeaderDelete,
  },
  data() {
    return {
      isShowModal: false,
    };
  },
  // emits: ["save", "edit"],
  props: {
    title: {
      type: String,
      default: "Title",
    },
    isEdit: {
      type: Boolean,
      default: false,
    },
    isDeletable: {
      type: Boolean,
      default: false,
    },
    isEditable: {
      type: Boolean,
      default: true,
    },
  },
};
</script>
<style scoped></style>
