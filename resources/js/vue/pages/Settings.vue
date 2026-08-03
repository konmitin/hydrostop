<template>
  <wrapper>
    <!-- HEADER -->
    <HeaderPage @edit="
      this.isEdit = true;
    " @save="this.save()" :isEdit="this.isEdit" title="Параметры">
      <template #avatar>
        <div class="w-12 h-12 bg-gray-900 rounded-md flex items-center justify-center">
          <i class="fas fa-gear text-lg text-white"></i>
        </div>
      </template>

      <template #subtitle>
      </template>
    </HeaderPage>

    <MainPage>
      <TabsView>
        <Tab v-model="this.activeTab" name="Основное" tab="main"></Tab>
      </TabsView>

      <!-- MAIN -->
      <SectionsPage :active-tab="this.activeTab" section="main">

        <SectionPage cols="2" :isEdit="this.isEdit" title="Основное">
          <template #view>
            <!-- <FieldPage title="Название"> {{ this.product.name }} </FieldPage> -->
          </template>

          <template #edit>
            <!-- <InputTextPage v-model="this.product.name" title="Название" /> -->
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
      settings: {},
    };
  },
  async created() {
    await this.getSettings();

    document.title = `Параметры | ГидроСтоп`;
  },
  methods: {
    async getSettings() {
      await axios
        .get(`/api/settings`)
        .then((res) => {
        })
        .catch((res) => { });
    },
    async save() {
      await axios
        .patch(`/api/settings`, this.product)
        .then((res) => {
          this.isEdit = false;
          this.getProduct();
        })
        .catch((res) => { });
    },
  },
  watch: {
    isEdit() {
    },
  },
};
</script>
<style scoped></style>
