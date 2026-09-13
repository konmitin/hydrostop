<template>
  <wrapper>
    <!-- HEADER -->
    <HeaderPage @edit="
      this.isEdit = true;
    this.getOptions();
    " @save="this.save()" @delete="this.delete()" :isEdit="this.isEdit" :isRequestDelete="isRequestDelete" :isDeletable="true"
      :title="this.product.name ?? ''">
      <template #avatar>
        <div class="w-12 h-12 bg-gray-900 rounded-md flex items-center justify-center">
          <i class="fas fa-city text-lg text-white"></i>
        </div>
      </template>

      <template #subtitle>
        {{
          (this.product.created_at
            ? new Date(this.product.created_at).toLocaleString("ru-RU")
            : "") + (this.product.rate ? " Рейтинг: " + this.product.rate : "")
        }}
      </template>
    </HeaderPage>

    <MainPage>
      <TabsView>
        <Tab v-model="this.activeTab" name="Основное" tab="main"></Tab>
        <Tab v-model="this.activeTab" name="SEO" tab="seo"></Tab>
        <Tab v-model="this.activeTab" name="Картинки и документы" tab="files"></Tab>
        <Tab v-model="this.activeTab" name="Свойства" tab="properties"></Tab>
      </TabsView>

      <!-- MAIN -->
      <SectionsPage :active-tab="this.activeTab" section="main">

        <SectionPage cols="2" :isEdit="this.isEdit" title="Основное">
          <template #view>
            <FieldPage title="Название"> {{ this.product.name }} </FieldPage>
            <FieldPage title="Позиция (число)"> {{ this.product.position }} </FieldPage>
            <FieldPage title="Цена"> {{ this.product.price }} ₽ </FieldPage>
            <FieldPage title="Единица измерения">
              {{ this.product.unit?.name }}
            </FieldPage>

            <FieldPage title="Категория">
              {{ this.product.category?.name }}
            </FieldPage>

            <FieldPage title="Статус">
              {{ this.product.status?.name }}
            </FieldPage>

            <FieldPage title="Код"> {{ this.product.slug }} </FieldPage>
            <FieldPage title="Артикул"> {{ this.product.sku }} </FieldPage>
            <FieldPage title="Кол-во"> {{ this.product.count }} </FieldPage>

            <FieldPage title="Город">
              {{ this.product.branch?.name }}
            </FieldPage>

            <FieldPage title="Описание">
              {{ this.product.description }}
            </FieldPage>
          </template>

          <template #edit>
            <InputTextPage @update:modelValue="(value) => inputName(value)" v-model="this.product.name" name="name"
              title="Название" />
            <InputNumberPage v-model="this.product.position" title="Позиция" />
            <InputNumberPage v-model="this.product.price" title="Цена" />

            <SelectPage title="Единица измерения" v-model="this.product.unit.id" :options="this.units" />

            <SelectPage title="Категория" v-model="this.product.category.id" :options="this.categories" />

            <SelectPage title="Статус" v-model="this.product.status.id" :options="this.statuses" />

            <InputTextPage @input="inputSlug($event.target.value)" v-model="this.product.slug" name="slug" title="Код" />
            <InputTextPage v-model="this.product.sku" name="sku" title="Артикул" />
            <InputTextPage v-model="this.product.count" name="count" title="Кол-во" />

            <SelectPage title="Город" v-model="this.product.branch.id" :options="this.branches" />

            <TextareaPage v-model="this.product.description" name="description" title="Описание" />
          </template>
        </SectionPage>
      </SectionsPage>

      <!-- SEO -->
      <SectionsPage :active-tab="this.activeTab" section="seo">

        <SectionPage cols="1" :isEdit="this.isEdit" title="Основное">
          <template #view>
            <FieldPage title="Meta Title"> {{ this.product.seo_name }} </FieldPage>

            <FieldPage title="Meta Description">
              {{ this.product.seo_description }}
            </FieldPage>
          </template>

          <template #edit>
            <InputTextPage v-model="this.product.seo_name" name="seo_name" title="Meta Title" />
            <TextareaPage v-model="this.product.seo_description" name="seo_description" title="Meta Description" />
          </template>
        </SectionPage>
      </SectionsPage>

      <!-- FILES -->
      <SectionsPage :active-tab="this.activeTab" section="files">
        <SectionPage cols="1" title="Главная картинка">
          <template #view>
            <div class="grid grid-cols-4 gap-2 mb-3">
              <label v-if="!this.product.frontImage"
                class="w-52 h-52 cursor-pointer input-field hover:!bg-gray-200 rounded-md border border-gray-300 flex items-center justify-center text-gray-500 hover:border-blue-500">
                <i class="fas fa-plus"></i>
                <input @input="addFrontImage" class="hidden" type="file" accept="image/*" />
              </label>

              <div
                class="cursor-pointer w-52 h-52 bg-gray-800 rounded-md border border-gray-300 overflow-hidden relative"
                v-if="this.product.frontImage">
                <label
                  class="flex items-center justify-center cursor-pointer w-8 h-8 bg-blue-600 hover:bg-blue-700 absolute right-0">
                  <i class="fa fa-edit text-sm"></i>
                  <input @input="addFrontImage" class="hidden" type="file" accept="image/*" />
                </label>
                <img :src="this.product.frontImage.path" class="w-full h-full object-cover"
                  :alt="this.product.frontImage.name" />
              </div>
            </div>
          </template>
        </SectionPage>

        <!-- PHOTOS -->
        <SectionPage :title="`Фотографии (Макс. 120 за раз) - ${this.product.images?.length}`" icon="fa-camera">
          <template #view>
            <div class="flex items-center flex-wrap gap-2 mb-3">
              <label
                class="w-38 h-38 md:w-52 md:h-52 cursor-pointer input-field hover:!bg-gray-200 rounded-md border border-gray-300 flex items-center justify-center text-gray-500 hover:border-blue-500">
                <i class="fas fa-plus"></i>
                <input @input="addFilesEvent" class="hidden" type="file" accept="image/*" multiple />
              </label>

              <template v-for="(image, idx) in this.product.images" :key="idx">
                <div :draggable="true" @dragstart="onDragStart(idx, this.product.images)" v-if="image.deleted != 'Y'"
                  @dragover.prevent="onDragOver(idx)" @drop="onDrop(idx)"
                  class="cursor-pointer w-38 h-38 md:w-52 md:h-52 input-field hover:!bg-gray-200 rounded-md border border-gray-300 hover:border-blue-500 relative overflow-hidden">
                  <div class="flex justify-end absolute right-0 z-10 w-full">
                    <button v-if="!image.id"
                      class="flex items-center justify-center cursor-pointer w-6 h-6 md:w-8 md:h-8 bg-green-600">
                      +
                    </button>
                    <button @click="rotateImg(idx)"
                      class="flex items-center justify-center shrink-0 cursor-pointer w-6 h-6 md:w-8 md:h-8 bg-blue-600 hover:bg-blue-700">
                      <i class="fa fa-rotate text-xs md:text-sm text-white"></i>
                    </button>

                    <button @click="deleteMedia(idx, 'image')"
                      class="flex items-center justify-center shrink-0 cursor-pointer w-6 h-6 md:w-8 md:h-8 bg-red-600 hover:bg-red-700">
                      <i class="fa fa-trash text-xs md:text-sm text-white"></i>
                    </button>
                  </div>

                  <img v-if="image?.mime && image?.mime.indexOf('image') >= 0" :src="image?.path" :style="{
                    transform: `rotate(${image.rotate > 0 ? image.rotate : 0}deg)`,
                  }" class="w-full h-full object-cover" :alt="image?.real_name" />
                </div>
              </template>
            </div>
          </template>
        </SectionPage>

        <!-- DOCS -->
        <SectionPage title="Документы" icon="fa fa-file-alt">
          <template #buttons>
            <label
              class="flex items-center justify-center h-8 w-8 bg-green-600 cursor-pointer hover:bg-green-700 text-white text-sm rounded-md transition ">
              <i class="fas fa-plus-circle"></i>
              <input @input="addFilesEvent" type="file" multiple="" class="hidden" hidden
                accept="application/pdf, .pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, .docx" />
            </label>
          </template>
          <template #view>
            <div class="flex flex-col gap-2" v-if="this.product.documents">

              <template v-for="(document, index) in this.product.documents" :key="index">


                <div class="flex items-center h-12" v-if="document.deleted != 'Y'">
                  <div v -if=" !document.rename"
                    class="font-medium flex items-center w-full max-w-96 truncate text-gray-700 h-full text-white px-4 py-2 bg-blue-600 rounded-l-md">
                    {{ document.name }}
                  </div>

                  <div v-if="document.rename"
                    class="font-medium w-full max-w-96 truncate text-gray-700 h-full text-white bg-blue-600 rounded-l-md">
                    <InputTextPage v-model="document.name" class="h-full" />
                  </div>

                  <div class="flex items-center gap-3 h-full bg-gray-600 px-3 py-2 rounded-r-md">
                    <button v-if="!document.rename" @click="document.rename = true;"
                      class="cursor-pointer flex items-center justify-center text-white hover:text-blue-600 transition">
                      <i class="fas fa-pen"></i>
                    </button>

                    <button v-if="document.rename" @click="document.rename = false; this.isEdit = true;"
                      class="cursor-pointer flex items-center justify-center text-white hover:text-blue-600 transition">
                      <i class="fas fa-save"></i>
                    </button>

                    <a :href="document.path"
                      class="cursor-pointer flex items-center justify-center text-white hover:text-green-500 transition"
                      :download="document.name">
                      <i class="fas fa-download text-lg"></i>
                    </a>

                    <button @click="this.deleteMedia(index, 'document')"
                      class="cursor-pointer flex items-center justify-center text-white hover:text-red-600 transition">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </div>
              </template>

            </div>


            <div v-if="this.product.documents.length <= 0">
              <div class="flex items-center justify-between text-gray-600">
                Документы не прикреплены
              </div>
            </div>
          </template>
        </SectionPage>
      </SectionsPage>

      <!-- PROPERTIES -->
      <SectionsPage :active-tab="this.activeTab" section="properties">
        <!-- TESTS -->

        <SectionPage :isEdit="this.showHiddenTest">
          <template #view>
            <button @click="this.showHiddenTest = true"
              class="flex items-center justify-center gap-1 w-56 bg-blue-600 cursor-pointer hover:bg-blue-700 text-white text-sm p-2 rounded-md transition">
              <i class="fas fa-plus-circle"></i>
              <span>Прикрепить свойство</span>
            </button>
          </template>

          <template #edit>
            <button @click="this.showHiddenTest = false"
              class="flex items-center justify-center gap-1 w-56 bg-red-600 cursor-pointer hover:bg-red-700 text-white text-sm p-2 rounded-md transition">
              <i class="fas fa-close"></i>
              <span>Закрыть</span>
            </button>
          </template>
        </SectionPage>

        <SectionPage cols="1" :isEdit="this.showHiddenTest" title="Свойства">
          <template #view>
            <template v-for="(property, propertyIndex) in this.product.properties">
              <PropertyRow v-if="property.is_hidden == 'N'"
                @edit="(property) => doEditProperty(property, propertyIndex)" :property="property" />
            </template>
          </template>

          <template #edit>
            <div class="flex flex-col gap-2">
              <template v-for="property in this.properties">
                <div v-if="
                  !this.product.properties.find(
                    (p) => p.property_id == property.id && p.is_hidden == 'N',
                  )
                " class="flex flex-col gap-4">
                  <div class="flex items-center justify-between w-full gap-8 text-gray-900 hover:text-orange-600">
                    <span class="text-md uppercase">{{ property.name }}</span>

                    <div class="">
                      <label
                        class="flex items-center gap-1 cursor-pointer text-sky-600 hover hover:underline uppercase">
                        <input type="radio" :name="property.name.toLowerCase() + property.id" @click="
                          addProperty(property, property.id);
                        this.isEdit = true;
                        " class="hidden" />
                        <span class="text-sm">Добавить</span>
                      </label>
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </template>
        </SectionPage>
      </SectionsPage>
    </MainPage>
  </wrapper>
</template>
<script>
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
      isRequestDelete: false,
      product: {},
      units: [],
      categories: [],
      properties: [],
      branches: [],
      statuses: [],
    };
  },
  async created() {
    await this.getProduct();
    await this.getProperties();

    document.title = `${this.product.name} | ГидроСтоп`;
  },
  methods: {
    async getProduct() {
      await axios
        .get(`/api/products/${this.$route.params.id}`)
        .then((res) => {
          this.product = res.data.data;

          this.product.branch = this.product.branch ?? { id: 0 };
          this.product.category = this.product.category ?? { id: 0 };
          this.product.status = this.product.status ?? { id: 0 };
          this.product.unit = this.product.unit ?? { id: 0 };
        })
        .catch((res) => {
          console.log(res);
        });
    },
    async getCategories() {
      await axios.get("/api/categories").then((response) => {
        let categories = response.data.data;

        this.categories = [];

        for (const key in categories) {
          if (!Object.hasOwn(categories, key)) continue;

          const category = categories[key];

          this.categories.push({
            label: category.name,
            value: category.id,
          });
        }
      });
    },
    async getBranches() {
      await axios.get("/api/branches").then((response) => {
        let branches = response.data.data;

        this.branches = [];

        for (const key in branches) {
          if (!Object.hasOwn(branches, key)) continue;

          const branch = branches[key];

          this.branches.push({
            label: branch.name,
            value: branch.id,
          });
        }
      });
    },
    async getStatuses() {
      await axios.get("/api/statuses").then((response) => {
        let statuses = response.data.data;

        this.statuses = [];

        for (const key in statuses) {
          if (!Object.hasOwn(statuses, key)) continue;

          const status = statuses[key];

          this.statuses.push({
            label: status.name,
            value: status.id,
          });
        }
      });
    },
    async getProperties() {
      await axios.get("/api/properties").then((response) => {
        let properties = response.data.data;

        this.properties = [];

        for (const key in properties) {
          if (!Object.hasOwn(properties, key)) continue;

          const property = properties[key];

          this.properties.push(property);
        }
      });
    },
    async getUnits() {
      await axios.get("/api/units").then((response) => {
        let units = response.data.data;

        this.units = [];

        for (const key in units) {
          if (!Object.hasOwn(units, key)) continue;

          const unit = units[key];

          this.units.push({
            label: unit.name,
            value: unit.id,
          });
        }
      });
    },
    getOptions() {
      this.getCategories();
      this.getBranches();
      this.getStatuses();
      this.getUnits();
    },
    async save() {
      await axios
        .patch(`/api/products/${this.product.id}`, this.product)
        .then((res) => {
          this.isEdit = false;
          this.getProduct();
        })
        .catch((res) => { });
    },
    async delete() {

      this.isRequestDelete = true;

      await axios
        .delete(`/api/products/${this.product.id}`)
        .then((res) => {
          this.isEdit = false;
          this.isRequestDelete = false;

          this.$router.push("/h-admin/products");
        })
        .catch((res) => {
          this.isRequestDelete = false;
        });
    },
    doEditProperty(property, propertyIndex) {
      try {
        this.isEdit = true;
        this.product.properties[propertyIndex].value = property.value;
        this.product.properties[propertyIndex].is_hidden = property.is_hidden;
      } catch (error) {
        console.log(error);
      }
    },
    addProperty(property, propertyId) {
      try {
        let oldProperty = this.product.properties.find(
          (p) => p.property_id == property.id,
        );

        if (oldProperty) {
          oldProperty.is_hidden = "N";
        } else {
          this.product.properties.push({
            name: property.name,
            product_id: this.product.id,
            property_id: property.id,
            value: "",
            is_hidden: "N",
          });
        }
      } catch (error) {
        console.log(error);
      }

      console.log(this.product.properties);
    },
    async addFrontImage(event) {
      let files = event.target.files;

      const file = files[0];
      const reader = new FileReader();

      this.product.frontImage = {
        name: file.name,
        real_name: file.name,
        path: URL.createObjectURL(file),
        type: "front",
        position: 0,
        base64: "",
        mime: file.type,
      };

      imageToBase64(file).then((base64) => {
        this.product.frontImage.base64 = base64;
      });

      this.product.frontImage.file_id = null;

      this.isEdit = true;
    },
    async addFilesEvent(event) {
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
        let images = this.product.images;
        let videos = this.product.videos;
        let docs = this.product.documents;

        let mediaData = await this.formattingFile(file);
        mediaData.position = key * 10;

        if (file.type.indexOf("image") >= 0) {
          images.push(mediaData);

          this.updateMediaPosition(images);

          this.$emit("update:images", images);
        } else if (file.type.indexOf("video") >= 0) {
          videos.push(mediaData);

          this.updateMediaPosition(videos);
        } else {
          docs.push(mediaData);

          this.updateMediaPosition(docs);
        }

        this.filesToDownload++;
      }

      event.target.value = "";
      this.isEdit = true;
    },
    async formattingFile(file) {
      let formattingFile = {
        name: file.name,
        real_name: file.name,
        path: URL.createObjectURL(file),
        type: "front",
        position: 0,
        base64: "",
        mime: file.type,
        deleted: 'N',
      };

      let base64 = await imageToBase64(file);
      formattingFile.base64 = base64;

      console.log(formattingFile);

      return formattingFile;
    },
    async rotateImg(imgIndex) {
      let img = this.product.images[imgIndex];

      if (img.rotate) {
        img.rotate += 90;
      } else {
        img.rotate = 90;
      }

      if (img.rotate > 360) {
        img.rotate = 0;
      }

      this.isEdit = true;
    },
    async deleteMedia(mediaIndex, type) {
      let media;

      let images = this.product.images;
      let videos = this.product.videos;
      let docs = this.product.documents;

      if (type == "image") {
        media = images[mediaIndex];
      } else if (type == "video") {
        media = videos[mediaIndex];
      } else {
        media = docs[mediaIndex];
      }

      media.deleted = 'Y';
      media.base64 = '';

      console.log(media);

      this.filesToDownload--;
      this.isEdit = true;
    },
    updateMediaPosition(medias) {
      medias.map((item, idx) => {
        item.position = idx * 10;
        return item;
      });
    },
    onDragStart(idx, list) {
      this.dragItems = list;
      this.dragStartIndex = idx;
    },
    onDragOver(idx) {
      this.dragOverIndex = idx;
    },
    onDrop(idx) {
      if (this.dragStartIndex === null) return;

      const movedItem = this.dragItems[this.dragStartIndex];

      this.dragItems.splice(this.dragStartIndex, 1);
      this.dragItems.splice(idx, 0, movedItem);

      this.dragStartIndex = null;
      this.dragOverIndex = null;

      this.updateMediaPosition(this.dragItems);
      this.dragItems = null;


      this.isEdit = true;
    },

    inputSlug(value) {
      this.product.slug = url_slug(value);
    },
    inputName(value) {

      // this.product.slug = url_slug(value);
    },
  },
  watch: {
    isEdit() {
    },
  },
};
</script>
<style scoped></style>
