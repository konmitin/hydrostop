<template>
  <wrapper>
    <!-- HEADER -->
    <HeaderPage @edit="
      this.isEdit = true;
    " @save="this.save()" :isEdit="this.isEdit" :title="this.title">
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
            <FieldPage title="Краткое наименование"> {{ this.object.name }} </FieldPage>
            <FieldPage title="Полное наименование"> {{ this.object.full_name }} </FieldPage>
            <FieldPage title="Юридический Адрес"> {{ this.object.legal_address }} </FieldPage>
            <FieldPage title="Фактический Адрес"> {{ this.object.actual_address }} </FieldPage>

            <FieldPage title="ИНН"> {{ this.object.inn }} </FieldPage>
            <FieldPage title="КПП"> {{ this.object.kpp }} </FieldPage>
            <FieldPage title="ОГРН"> {{ this.object.ogrn }} </FieldPage>
            <FieldPage title="ОКПО"> {{ this.object.okpo }} </FieldPage>

          </template>

          <template #edit>
            <InputTextPage v-model="this.object.name" title="Краткое наименование" />
            <InputTextPage v-model="this.object.full_name" title="Полное наименование" />
            <InputTextPage v-model="this.object.legal_address" title="Юридический Адрес" />
            <InputTextPage v-model="this.object.actual_address" title="Фактический Адрес" />

            <InputNumberPage v-model="this.object.inn" title="ИНН" :maxWidth="12" />
            <InputNumberPage v-model="this.object.kpp" title="КПП" />
            <InputNumberPage v-model="this.object.ogrn" title="ОГРН" />
            <InputNumberPage v-model="this.object.okpo" title="ОКПО" />
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
      object: {},
      title: "Реквизиты компании",
    };
  },
  async created() {
    await this.getCompany();

    document.title = `${this.title} | ГидроСтоп`;
  },
  methods: {
    async getCompany() {
      await axios
        .get(`/api/companies/1`)
        .then((res) => {
          this.object = res.data.data;
        })
        .catch((res) => { });
    },
    async save() {
      await axios
        .patch(`/api/companies/1`, this.object)
        .then((res) => {
          this.isEdit = false;
          this.getCompany();
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
