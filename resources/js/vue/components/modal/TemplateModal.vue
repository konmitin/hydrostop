<template>
  <div class="fixed inset-0 modal-overlay flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg md:rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] modal-content">
      <div class="p-2 md:p-6 border-b border-gray-100">
        <div class="flex justify-between items-center">
          <h3 class="text-2xl font-bold text-gray-900">
            {{ this.title ?? (this.mode == "add" ? "Новый" : "Редактирование") }}
          </h3>
          <button @click="$emit('close')"
            class="w-10 h-10 cursor-pointer rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-600">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>
      </div>

      <div class="p-2 md:p-6">
        <form @submit.prevent.self="
          $emit(this.mode == 'edit' ? 'save' : 'add', this.modelValue)
          ">
          <div class="grid grid-cols-2 gap-4 md:gap-6">
            <slot />
          </div>

          <div class="mt-8 w-full flex justify-between space-x-4">
            <div class="flex gap-2 w-full">
              <button-primary v-if="
                this.mode == 'edit' &&
                !this.modelValue.deleted &&
                (this.deleteType == 'delete' || this.deleteType == 'disabled')
              " type="button" :title="this.titleDelete" icon="fa-trash" class="bg-red-600 hover:bg-red-700"
                @click="$emit('delete')">
              </button-primary>

              <button-primary v-if="
                this.mode == 'edit' &&
                this.deleteType == 'disabled' &&
                this.modelValue.deleted
              " type="button" title="Восстановить" icon="fa-undo" class="bg-green-600 hover:bg-green-700"
                @click="$emit('recover')">
              </button-primary>
            </div>

            <div class="flex items-center gap-4">
              <button-secondary v-if="this.mode == 'add' || this.isCancel" type="button" title="Отменить"
                @click="this.resetForm()" class="hover:bg-transparent hover:text-gray-800">
              </button-secondary>
              <button-primary :class="{
                'bg-gray-500': !this.isEdit,
              }" :disabled="!this.isEdit" :title="this.mode == 'add' ? 'Добавить' : 'Сохранить'"
                :icon="this.mode == 'add' ? 'fa-plus' : 'fa-save'">
              </button-primary>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Modal",
  data() {
    return {};
  },
  props: {
    mode: {
      type: String,
      default: "add",
      validator: (value) => ["add", "edit"].includes(value),
    },
    modelValue: {
      type: Object,
    },
    title: {
      type: String,
      default: null,
    },
    titleDelete: {
      type: String,
      default: "Удалить",
    },
    deleteType: {
      type: String,
      default: null,
    },
    isEdit: {
      type: Boolean,
      default: false,
    },
    isCancel: {
      type: Boolean,
      default: false,
    },
  },
  emits: ["close", "save", "add", "delete", "recover", "cancel"],
  methods: {
    resetForm() {
      this.$emit("cancel");

      for (const key in this.modelValue) {
        if (!Object.hasOwn(this.modelValue, key)) continue;

        this.modelValue[key] = null;

        this.$emit("update:modelValue", this.modelValue);
        this.$emit("close");
      }
    },
  },
};
</script>
<style lang=""></style>
