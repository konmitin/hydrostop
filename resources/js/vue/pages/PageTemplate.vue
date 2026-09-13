<template>
  <wrapper>
    <!-- HEADER -->
    <HeaderPage @edit="this.isEdit = true; this.$emit('edit');" @save="this.save()" @delete="this.delete()"
      :isEdit="this.isEdit" :isDeletable="this.isDeletable"
      :title="(this.object.name ?? this.title) + ` # ${(this.object.id ?? '')}`">
      <template #avatar>
        <div class="w-12 h-12 bg-gray-900 rounded-md flex items-center justify-center">
          <i class="fas fa-city text-lg text-white"></i>
        </div>
      </template>

      <template #subtitle>
        {{ this.subtitle ?? '' }}

        {{ ' ' }}

        {{
          (this.object.created_at
            ? new Date(this.object.created_at).toLocaleString("ru-RU")
            : "")
        }}
      </template>
    </HeaderPage>

    <MainPage>
      <TabsView>
        <Tab v-for="tab in this.tabs" v-model="this.activeTab" :name="tab.title" :tab="tab.tab"></Tab>
      </TabsView>

      <!-- MAIN -->
      <SectionsPage v-for="tab in this.tabs" :key="tab.tab" :active-tab="this.activeTab" :section="tab.tab">


        <template v-for="section in this.sections[tab.tab]">
          <SectionPage v-if="!section.type || section.type == 'fields'" :cols="section.cols ?? 1" :isEdit="this.isEdit"
            :title="section.name">
            <template #view>
              <FieldPage v-for="field in section.fields" :key="field.key.data" :name="field.key.data"
                :title="field.title"> {{field.type == 'select-yes-no' ? this.valuesYesNo.find((obj) => obj.value ==
                  this.getNestedValue(field.key.view))?.label : this.getNestedValue(field.key.view)}} </FieldPage>
            </template>

            <template #edit>
              <template v-for="field in section.fields" :key="field.key">
                <div v-if="field.editable != false">
                  <InputTextPage v-if="field.type == 'text' || field.type == 'email'"
                    :modelValue="this.getNestedValue(field.key.data)"
                    @update:modelValue="(val) => { setNestedValue(field.key.data, val); this.inputText(field, val, section.fields) }"
                    :name="field.key" :title="field.title" />

                  <InputPhonePage v-if="field.type == 'phone'" :modelValue="this.getNestedValue(field.key.data)"
                    @update:modelValue="(val) => setNestedValue(field.key.data, val)" :name="field.key"
                    :title="field.title" />

                  <InputPassword v-if="field.type == 'password'" :modelValue="this.getNestedValue(field.key.data)"
                    @update:modelValue="(val) => setNestedValue(field.key.data, val)" :name="field.key"
                    :title="field.title" />

                  <InputNumberPage v-if="field.type == 'number'" :modelValue="this.getNestedValue(field.key.data)"
                    @update:modelValue="(val) => setNestedValue(field.key.data, val)" :name="field.key"
                    :title="field.title" :maxWidth="field.maxWidth" />

                  <InputDatePage v-if="field.type == 'date'" :modelValue="this.getNestedValue(field.key.data)"
                    @update:modelValue="(val) => setNestedValue(field.key.data, val)" :name="field.key"
                    :title="field.title" />

                  <SelectPage v-if="field.type == 'select' || field.type == 'select-multi'"
                    :modelValue="this.getNestedValue(field.key.data)"
                    @update:modelValue="(val) => setNestedValue(field.key.data, val)"
                    :isMulti="field.type == 'select-multi' ? true : false" :name="field.key.data" :title="field.title"
                    :options="field.values ?? []" :get-option-label="field.option_label"
                    :get-option-value="field.option_value" />

                  <SelectPage v-if="field.type == 'select-yes-no'" :modelValue="this.getNestedValue(field.key.data)"
                    @update:modelValue="(val) => setNestedValue(field.key.data, val)"
                    :isMulti="field.type == 'select-multi' ? true : false" :name="field.key.data" :title="field.title"
                    :options="[{ label: 'Да', value: 'Y' }, { label: 'Нет', value: 'N' }]" />

                  <TextareaPage v-if="field.type == 'textarea'" :modelValue="this.getNestedValue(field.key.data)"
                    @update:modelValue="(val) => setNestedValue(field.key.data, val)" :name="field.key"
                    :title="field.title" />
                </div>


              </template>
            </template>
          </SectionPage>

          <SectionPage v-if="section.type == 'file'" :cols="section.cols ?? 1" :title="section.name">
            <template #view>
              <div class="grid grid-cols-4 gap-2 mb-3">
                <label v-if="!this.object[section.path]"
                  class="w-52 h-52 cursor-pointer input-field hover:!bg-gray-200 rounded-md border border-gray-300 flex items-center justify-center text-gray-500 hover:border-blue-500">
                  <i class="fas fa-plus"></i>
                  <input @input="this.addFileEvent($event, section.path)" class="hidden" type="file"
                    :accept="section.options?.accept" />
                </label>

                <div
                  class="flex group relarive items-center justify-center w-52 h-52 bg-gray-800 rounded-md border border-gray-300 overflow-hidden relative"
                  v-if="this.object[section.path]">
                  <label
                    class="flex items-center justify-center cursor-pointer w-8 h-8 bg-blue-600 hover:bg-blue-700 absolute top-0 right-0">
                    <i class="fa fa-edit text-sm"></i>
                    <input @input="this.addFileEvent($event, section.path)" class="hidden" type="file"
                      :accept="section.options?.accept" />
                  </label>

                  <div v-if="this.object[section.path]?.mime && this.object[section.path]?.mime.indexOf('image') < 0"
                    class="">
                    <i class="fa fa-file text-3xl"></i>
                  </div>

                  <div v-if="this.object[section.path]?.mime && this.object[section.path]?.mime.indexOf('image') < 0"
                    class="transition absolute bottom-0 left-0 z-40 w-56 bg-white text-gray-900 p-2 hidden group-hover:block">
                    {{ this.object[section.path]?.name }}
                  </div>

                  <img v-if="this.object[section.path]?.mime && this.object[section.path]?.mime.indexOf('image') >= 0"
                    :src="this.object[section.path].path" class="w-full h-full object-cover"
                    :alt="this.object[section.path].name" />
                </div>
              </div>
            </template>
          </SectionPage>
        </template>



      </SectionsPage>
    </MainPage>
  </wrapper>
</template>
<script>
import { ref } from "vue";
import TextareaPage from "../components/fields/TextareaPage.vue";
import PropertyRow from "../components/modal/PropertyRow.vue";
import { imageToBase64 } from "../composables/imageToBase64.js";
import { url_slug } from "../composables/slug.js";

export default {
  components: {
    TextareaPage,
    PropertyRow,
  },
  data() {
    return {
      activeTab: "main",
      isShowModal: false,
      isEdit: false,
      showHiddenTest: false,
      filesToDownload: 0,
      settings: {},
      object: {},
      valuesYesNo: [{ label: 'Да', value: 'Y' }, { label: 'Нет', value: 'N' }]
    };
  },
  emits: ['edit'],
  props: {
    title: {
      type: String,
      default: ''
    },
    subtitle: {
      type: String,
      default: ''
    },
    apiName: {
      type: String,
      default: ''
    },
    mainPage: {
      type: String,
      default: `/h-admin/${this?.apiName}`
    },
    tabs: {
      type: Array,
      default: [
        {
          title: 'Основное',
          tab: 'main',
        }
      ]
    },
    sections: {
      type: Object,
      default: [
        {
          name: 'Основное',
          fields: {},
        }
      ]
    },
    isDeletable: {
      type: Boolean,
      default: false
    },
    objectId: {
      type: Number,
      default: null
    }
  },
  async created() {
    await this.getObject();

    document.title = `${this.object.name ?? (this.title + ' #' + (this.object.id ?? ''))} | ГидроСтоп`;
  },
  methods: {
    async getObject() {
      await axios
        .get(`/api/${this.apiName}/${(this.objectId ?? this.$route.params.id)}`)
        .then((res) => {
          this.object = res.data.data;
        })
        .catch((res) => { });
    },
    async save() {
      await axios
        .patch(`/api/${this.apiName}/${(this.objectId ?? this.$route.params.id)}`, this.object)
        .then((res) => {
          this.isEdit = false;
          this.object = res.data.data;
        })
        .catch((res) => { });
    },
    async delete() {
      await axios
        .delete(`/api/${this.apiName}/${this.$route.params.id}`)
        .then((res) => { this.$router.push(this.mainPage) })
        .catch((res) => { });
    },
    getNestedValue(path) {
      return path.split('.').reduce((current, key) => current?.[key], this.object)
    },
    setNestedValue(path, value) {
      const keys = path.split('.')
      const lastKey = keys.pop()
      const target = keys.reduce((current, key) => {
        if (!current[key]) {
          current[key] = {}
        }
        return current[key]
      }, this.object)
      target[lastKey] = value;


    },
    async addFileEvent(event, path) {
      let downloadFile = event.target.files[0];

      let mediaData = await this.formattingFile(downloadFile);

      this.object[path] = mediaData;

      this.filesToDownload++;

      event.target.value = "";
      this.isEdit = true;

      return file;
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
    inputText(field, value, fields) {
      let fieldSlug;

      console.log(fields);

      if (field.key.data == 'name') {

        // this.object['slug'] = url_slug(value);
        // this.object['code'] = url_slug(value);
        // this.$forceUpdate();
      }

      return field;
    },
  },
  watch: {
  },
};
</script>
<style scoped></style>
