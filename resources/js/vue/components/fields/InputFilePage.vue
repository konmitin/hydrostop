<template>
  <div>
    <label v-if="this.title" class="cursor-pointer relative block text-xs text-gray-600 uppercase font-medium">

      <div class="flex items-center gap-4 w-full">
        <div class="">
          <i v-if="this.icon" :class="this.icon" class="mr-1 text-blue-500"></i>
          {{ this.title }} ({{ this.filesToDownload }})
        </div>

        <div v-if="this.isMulti && this.files.length >= 4" class="text-gray-900 flex gap-2">
          <button type="button" class="cursor-pointer rounded-md bg-blue-600 hover:bg-blue-700 text-white p-1"
            @click="this.offset = this.offset >= 0 ? (this.files.length - 3) * this.widthOffset * -1 : this.offset + this.widthOffset">
            <i class="fa fa-chevron-left"></i>
          </button>
          <button type="button" class="cursor-pointer rounded-md bg-blue-600 hover:bg-blue-700 text-white p-1"
            @click="this.offset = this.offset <= (this.files.length - 3) * this.widthOffset * -1 ? 0 : this.offset - this.widthOffset">
            <i class="fa fa-chevron-right"></i>
          </button>
        </div>
      </div>


      <input :autocomplete="this.name" :id="this.name" :name="this.name" @input="this.addFilesEvent($event)" type="file"
        :accept="this.accept"
        class="cursor-pointer hidden mt-1 w-full h-12 input-field rounded-sm px-4 py-3 text-gray-900 pr-10 placeholder:text-gray-600"
        :placeholder="this.placeholder" :required="this.isRequired" :multiple="this.isMulti" />

      <div v-if="this.files.length <= 0"
        class="cursor-pointer mt-1 w-full h-12 input-field rounded-sm p-4 pr-10 text-gray-600">
        Файл не выбран
      </div>

      <div class="flex relative gap-2 max-h-24 overflow-hidden">
        <template v-for="(image, idx) in this.files" :key="idx">
          <div class="group relative">
            <div v-if="image?.mime && image?.mime.indexOf('pdf') >= 0"
              :style="`transform: translateX(${this.offset}px);`"
              class="transition absolute top-0 z-40 w-56 bg-white text-gray-900 p-2 rounded-md shadow-lg left-6 hidden group-hover:block">
              {{ image.name }}
            </div>

            <div :style="`transform: translateX(${this.offset}px);`"
              class="transition mt-2 flex items-center justify-center relative w-12 h-12 md:w-18 md:h-18 rounded-md border border-gray-300 hover:border-blue-500 overflow-hidden">
              <div class="flex z-10 absolute bottom-0 right-0 w-full text-white">
                <!-- <button @click="rotateImg(idx)" type="button"
                class="flex items-center justify-center cursor-pointer w-full h-6 bg-blue-600 hover:bg-blue-700">
                <i class="fa fa-rotate text-xs text-white"></i>
              </button> -->

                <button @click="this.deleteFile(idx)" type="button"
                  class="flex items-center justify-center cursor-pointer w-full h-5 bg-red-600 hover:bg-red-700">
                  <i class="fa fa-trash text-xs text-white"></i>
                </button>
              </div>

              <div v-if="image?.mime && image?.mime.indexOf('image') >= 0" class="w-full h-full">
                <img :src="image?.path" :style="{
                  transform: `rotate(${image.rotate > 0 ? image.rotate : 0}deg)`,
                }" class="w-full h-full object-cover" :alt="image?.real_name" />
              </div>

              <div v-if="image?.mime && image?.mime.indexOf('pdf') >= 0" class="">
                {{ image.positionDownload }}
                <i class="fa relative z-10 mb-4 fa-file-pdf text-2xl text-red-900 object-cover"
                  :alt="image?.real_name"></i>
              </div>
            </div>
          </div>

        </template>
      </div>
    </label>




  </div>
</template>
<script>
import { imageToBase64 } from "../../composables/imageToBase64.js";

export default {
  data() {
    return {
      value: this.modelValue ?? "",
      files: [],
      filesToDownload: 0,
      offset: 0,
      widthOffset: 72 + 8,
    };
  },
  emits: ['update:modelValue'],
  props: {
    isMulti: {
      type: Boolean,
      default: false,
    },
    typeForModel: {
      type: String,
      default: "",
    },
    accept: {
      type: String,
      default: "",
    },
    icon: {
      type: String,
      default: "",
    },
    name: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      default: "",
    },
    title: {
      type: String,
      default: "",
    },
    placeholder: {
      type: String,
      default: "",
    },
    isRequired: {
      type: Boolean,
      default: false,
    },
    modelValue: {
      type: String,
      default: "",
    },
  },
  created() {
    this.value = this.modelValue;
  },
  methods: {
    async addFilesEvent(event) {
      this.files = [];
      this.filesToDownload = 0;

      let files = event.target.files;

      for (const key in files) {
        if (!Object.hasOwn(files, key)) continue;

        if (this.filesToDownload >= 120) {
          showNotify(
            `Ошибка! За один раз можно прикрепить максимум 120 файлов ${this.filesToDownload}`,
            "error",
            3000,
          );
          break;
        }

        const file = files[key];

        let mediaData = await this.formattingFile(file);
        mediaData.position = key * 10;

        this.files.push(mediaData);

        this.filesToDownload++;
      }

      event.target.value = "";
      this.$emit('update:modelValue', this.files);
    },
    async formattingFile(file) {

      let formattingFile = {
        name: file.name,
        real_name: file.name,
        path: URL.createObjectURL(file),
        type: this.typeForModel,
        position: 0,
        base64: "",
        mime: file.type,
        deleted: 'N',
        positionDownload: this.filesToDownload + 1,
      };

      let base64 = await imageToBase64(file);
      formattingFile.base64 = base64;

      return formattingFile;
    },
    async deleteFile(idx) {
      this.files.splice(idx, 1);

      this.filesToDownload--;
      this.$emit('update:modelValue', this.files);
    },
  }
};
</script>
<style></style>
