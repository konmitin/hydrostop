<template>
  <div class="sticky text-gray-900 top-0 bg-white z-20 border-b border-gray-300 p-4 flex flex-col gap-4 md:flex-row md:justify-between md:items-center">
    <div class="">
      <div class="flex gap-2">
        <h2 v-if="!this.isEditNumber" class="text-2xl font-bold flex items-center gap-2">
          {{ this.title }}
        </h2>


        <input v-if="this.isEditNumber" v-model="this.numberEdit" type="text" />

        <div class="">
          <button @click="this.isEditNumber = false; $emit('saveNumber', this.numberEdit)"
            class="text-blue-600 hover:text-blue-700 cursor-pointer" v-if="this.editableNumber && this.isEditNumber">
            <i class="fa fa-save"></i>
          </button>
          <button @click="this.isEditNumber = true" class="text-blue-600 hover:text-blue-700 cursor-pointer"
            v-if="this.editableNumber && !this.isEditNumber">
            <i class="fa fa-edit"></i>
          </button>
        </div>
      </div>

      <div class="flex items-center gap-2 text-sm text-gray-700 mt-1">
        <slot name="subtitle"></slot>
      </div>
    </div>

    <div class="flex items-center gap-2">
      <slot name="buttons"></slot>

      <button v-if="this.isEdit" @click="$emit('save')" class="button-primary flex items-center justify-center">
        <i class="fas fa-save"></i>
      </button>
      <button v-if="!this.isEdit" @click="$emit('edit')" class="button-primary flex items-center justify-center">
        <i class="fas fa-edit"></i>
      </button>
      <button @click="$emit('close')" class="button-delete flex items-center justify-center">
        <i class="fas fa-close"></i>
      </button>
    </div>
  </div>
</template>
<script>
export default {
  emits: ["edit", "save", "close", 'saveNumber'],
  data() {
    return {
      isEditNumber: false,
      numberEdit: this.number,
    }
  },
  props: {
    title: {
      type: String,
      default: "N/A",
    },
    number: {
      type: String,
      default: "",
    },
    isEdit: {
      type: Boolean,
      default: false,
    },
    editableNumber: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
<style scoped>
.button-primary,
.button-delete {
  font-size: var(--text-lg);
  line-height: var(--tw-leading, var(--text-lg--line-height));
  width: calc(var(--spacing) * 10);
  height: calc(var(--spacing) * 10);
  cursor: pointer;
  color: var(--color-white);
  transition: all var(--default-transition-duration);
  border-radius: var(--radius-lg);
}

.button-primary {
  background: var(--color-blue-600);
}

.button-primary:hover {
  background: var(--color-blue-700);
}

.button-delete {
  background: var(--color-red-600);
}

.button-delete:hover {
  background: var(--color-red-700);
}
</style>
