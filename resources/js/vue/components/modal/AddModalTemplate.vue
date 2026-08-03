<template>
  <div class="fixed inset-0 modal-overlay flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg md:rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] modal-content">
      <div class="p-2 md:p-6 border-b border-gray-100">
        <div class="flex justify-between items-center">
          <h3 class="text-2xl font-bold text-gray-900">
            {{ this.title ?? (this.mode == "add" ? "Добавить" : "Изменить") }}
          </h3>

          <button type="button" @click="$emit('close')"
            class="w-10 h-10 cursor-pointer rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-600">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>
      </div>

      <div class="p-2 md:p-6">
        <form @submit.prevent.self="
          $emit(this.mode == 'edit' ? 'save' : 'add', this.fields)
          ">
          <div class="grid grid-cols-2 gap-4 md:gap-6">
            <template v-for="(field, fIdx) in this.fields" :key="field.name">
              <InputTextPage v-if="field.type == 'text' || field.type == 'email'" :title="field.title"
                v-model="field.model" @update:modelValue="(modelValue) => this.inputText(field, modelValue)"
                :type="field.type" :placeholder="field.placeholder ?? field.title" :isRequired="field.required"
                :name="field.name" />

              <InputFilePage v-if="field.type == 'file' || field.type == 'file-multi'" :title="field.title" :isMulti="field.type == 'file-multi'" :accept="field.accept" :typeForModel="field.typeForModel" v-model="field.model"
                :placeholder="field.placeholder ?? field.title" :isRequired="field.required" />

              <InputPassword v-if="field.type == 'password'" :title="field.title" v-model="field.model" :placeholder="field.placeholder ?? field.title" :isRequired="field.required" />

              <InputNumberPage v-if="field.type == 'number'" :title="field.title" v-model="field.model" :placeholder="field.placeholder ?? field.title" :isRequired="field.required" />

              <InputPhonePage v-if="field.type == 'phone'" :title="field.name" v-model="field.model"
                :placeholder="field.placeholder ?? field.title" :isRequired="field.required" />

              <SelectPage v-if="field.type == 'select'" :title="field.title" v-model="field.model"
                :placeholder="field.placeholder ?? field.title" :options="field.values" :isRequired="field.required" />

              <SelectPage v-if="field.type == 'select-multi'" :title="field.title" v-model="field.model"
                :placeholder="field.placeholder ?? field.title" :options="field.values" :is-multi="true"
                :isRequired="field.required" />

              <SelectPage v-if="field.type == 'select-yes-no'" v-model="field.model" :title="field.title"
                :options="[{ label: 'Да', value: 'Y' }, { label: 'Нет', value: 'N' }]" />

              <TextareaPage v-if="field.type == 'textarea'" :title="field.title" v-model="field.model"
                :placeholder="field.placeholder ?? field.title" />
            </template>
          </div>

          <div class="mt-8 w-full flex justify-end space-x-4">
            <div class="flex items-center gap-4">
              <button-secondary type="button" title="Cancel" @click="this.resetForm()"
                class="hover:bg-transparent hover:text-gray-800">
              </button-secondary>
              <button-primary :class="{
                'bg-gray-500': !this.isEdit,
              }" :disabled="!this.isEdit" title="Add" icon="fa-plus">
              </button-primary>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { url_slug } from "../../composables/slug.js";
import TextareaPage from "../fields/TextareaPage.vue";

export default {
  name: "Modal",
  components: {
    TextareaPage,
  },
  data() {
    return {};
  },
  props: {
    mode: {
      type: String,
      default: "add",
      validator: (value) => ["add", "edit"].includes(value),
    },
    fields: {
      type: Array,
      default: [],
    },
    title: {
      type: String,
      default: null,
    },
    titleDelete: {
      type: String,
      default: "Delete",
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
  emits: ["close", "add", "cancel"],
  methods: {
    inputText(field, value) {
      let fieldSlug;

      if (field.name == 'name') {

        fieldSlug = this.fields.find((p) => p.name == 'slug' || p.name == 'code');

        if (fieldSlug) {
          fieldSlug.model = url_slug(field.model);
          this.$forceUpdate();
        }
      }

      return field;
    },
    resetForm() {
      this.$emit("cancel");

      for (const key in this.fields) {
        if (!Object.hasOwn(this.fields, key)) continue;

        this.fields[key].model = null;

        this.$emit("close");
      }
    },
  }
};
</script>
<style lang=""></style>
