<template>
  <wrapper class="text-gray-200">
    <HeaderPage :title="this.pageTitle" :is-editable="false">
      <template #buttons>
        <button-primary v-if="this.fields.length > 0" @click="this.showAddModal()" icon="fa-plus"
          title="Добавить"></button-primary>
      </template>
    </HeaderPage>

    <MainPage>
      <HeaderFilters :title="this.listTitle" :filters="this.filters" :active="this.activeFilters"
        @filter="this.filter(filters)" @cancel="this.filter(filters)" @openFilter="$emit('showFilter')" />

      <TablePrimary class="" :properties="this.properties" :showObjects="this.objects?.length"
        :countObjects="this.count" :currentPage="this.page" @page="
          (page) => {
            this.page = page;
            this.getObjects();
          }
        ">
        <TableRowPrimary @click="this.isLinked ? this.$router.push(`/h-admin/${apiName}/${object.id}`) : ''"
          class="cursor-pointer" :objectId="object.id" v-for="object in objects">
          <TableColumnPrimary v-for="(property, pIdx) in this.properties" :key="pIdx">
            {{ property["type"] == 'yes-no' ? (this.getNestedValue(object, property["code"]) == 'Y' ? 'Да' : 'Нет') :
              (this.getNestedValue(object, property["code"]) ?? '') }}

            {{ (property["type"] == 'price' ? ' ₽' : '') }}
          </TableColumnPrimary>
        </TableRowPrimary>
      </TablePrimary>
    </MainPage>

    <AddModalTemplate v-if="this.isShowAddModal && this.fields.length > 0" @close="this.isShowAddModal = false"
      @add="add" mode="add" :isEdit="!this.isBlockAdd" :fields="this.fields" />
  </wrapper>
</template>
<script>
import { ref } from "vue";
import axios from "../axios.js";
import { currentTimezoneDate } from "../composables/getTimezoneDate.js";
import AddModalTemplate from "../components/modal/AddModalTemplate.vue";

import { useGlobalNotification } from "../composables/globalNotification.js";
const { showNotify, closeNotify } = useGlobalNotification();

export default {
  components: {
    AddModalTemplate,
  },
  emits: ["showAddModal", 'showFilter'],
  props: {
    apiName: {
      type: String,
      default: "",
    },
    pageTitle: {
      type: String,
      default: "",
    },
    listTitle: {
      type: String,
      default: "",
    },
    properties: {
      type: Array,
      default: [
        {
          name: "Название",
          code: "name",
        },
      ],
    },
    filters: {
      type: Object,
      default: {
        name: {
          title: "Название",
          type: "text",
          model: "",
        },
      },
    },
    fields: {
      type: Array,
      default: [],
    },
    isLinked: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      objects: [],
      count: 0,
      inPage: 20,
      page: 1,
      modalMode: ref("add"),
      isShowAddModal: ref(false),
      isBlockAdd: false,
      showDeleteModal: ref(false),
      selectedObject: ref(null),
      activeFilters: {},
    };
  },
  mounted() {
    document.title = this.pageTitle + " | ГидроСтоп";
  },
  async created() {
    await this.getObjects();
  },
  async updated() {
    await this.getObjects();
  },
  watch: {
    async activeFilters() {
      await this.getObjects();
    },
  },
  methods: {
    async getObjects() {
      await axios
        .get(`/api/${this.apiName}`, {
          params: {
            page: this.page,
            filters: this.activeFilters,
          },
        })
        .then((response) => {
          this.objects = response.data.data;
          this.count = response.data.count;
        })
        .catch((error) => {
          let data = error.response.data;

          if (error.response.status == 404 || data == null) {
            showNotify("Not found", "error", 3000);
            return;
          }

          for (const key in data.errors) {
            if (!Object.hasOwn(data.errors, key)) continue;

            const error = data.errors[key];

            showNotify(error[0], "error", 3000);
          }
        });
    },
    async getObject(objectId) {
      await axios.get(`api/${this.apiName}/${objectId}`).then((response) => {
        this.selectedObject = response.data.data;
      });
    },
    async save(data) {
      this.selectedObject = data;
    },
    async add(data) {
      this.isBlockAdd = true;

      let body = {};

      data.forEach((field) => {
        body[field.name] = field.model;
      });

      await axios
        .post(`/api/${this.apiName}`, body)
        .then((res) => {
          this.getObjects();
          this.isShowAddModal = false;

          data.forEach((field) => {
            field.model = "";
          });

          this.isBlockAdd = false;
        })
        .catch((error) => {
          this.isBlockAdd = false;
        });
    },
    async filter(filters) {
      this.activeFilters = {};
      this.page = 1;

      for (const filterKey in filters) {
        const filter = filters[filterKey];

        if ((filter.type == 'text' || filter.type == 'select-multi') && filter.model.length <= 0) {
          continue;
        }


        if ((filter.type == 'number' || filter.type == 'select') && filter.model <= 0) {
          continue;
        }

        this.filters[filterKey].model = filter.model;
        this.activeFilters[filter.name] = filter.model;
      }

      // await this.getObjects();
    },
    showAddModal() {
      this.isShowAddModal = true;
      this.modalMode = "add";
      this.$emit("showAddModal");
    },
    hideViewModal() {
      this.isShowViewModal = false;
      this.$router.push(`/h-admin/${apiName}`);
    },
    getTimezoneDateStr(date, isTime = false) {
      let params = {
        year: "numeric",
        month: "long",
        day: "numeric",
      };

      if (isTime) {
        params.hour = "numeric";
        params.minute = "numeric";
      }

      let stringDate = currentTimezoneDate(date).toLocaleString(
        "en-US",
        params,
      );

      return stringDate;
    },
    getNestedValue(obj, path) {
      return path.split('.').reduce((current, key) => current?.[key], obj)
    },
  },
};
</script>
<style></style>
