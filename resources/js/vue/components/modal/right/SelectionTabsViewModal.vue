<template lang>
  <div class="space-y-6">
    <TabsView>
      <Tab v-model="this.selectedTab" name="Main" tab="main"></Tab>
      <Tab v-model="this.selectedTab" name="Inspected Cars" tab="vehicles"></Tab>
      <Tab v-model="this.selectedTab" name="Payments" tab="payments"></Tab>
      <Tab v-model="this.selectedTab" name="Addons" tab="addons"></Tab>
    </TabsView>

    <SectionsPage :active-tab="this.selectedTab" section="main">
      <SectionPage :isEdit="this.isEdit" title="Payment INFO" icon="fa-credit-card" cols="2">
        <template #view>
          <FieldPage title="Service">
            <div>
              {{ this.modelValue.package.name }} (${{
                this.modelValue.package.pivot.price
              }})
            </div>
          </FieldPage>
          <FieldPage title="Total">
            ${{ this.modelValue.order.total }}
          </FieldPage>
          <FieldPage title="Is Payment">
            <span :class="this.modelValue.order.is_payment == 'Y'
              ? 'text-green-600'
              : 'text-red-600'
              " class="text-gray-400 mt-1">
              {{ this.modelValue.order.is_payment == "Y" ? "YES" : "NO" }}
            </span>
          </FieldPage>
          <FieldPage @click="this.onCopy(this.modelValue.payments[0]?.number)" title="Payment ID"
            class="overflow-hidden">
            {{
              this.modelValue.payments[0]?.number
                ? this.modelValue.payments[0]?.number
                : "NO PAYMENT"
            }}
          </FieldPage>
        </template>

        <template #edit>
          <SelectPage label="Service" v-model="this.modelValue.package.id" :options="this.packages" :get-option-label="(option) => option.name + ' ' + (option.last_name ?? '')
            " :get-option-value="(option) => option.id" />
        </template>
      </SectionPage>
      <SectionPage :isEdit="this.isEdit" title="MAIN INFO" icon="fa-car" cols="2">
        <template #view>

          <FieldPage title="Inspector">
            <!-- INSPECTOR -->
            <router-link :to="`/h-admin/user/${this.modelValue.responsible?.id}`" class="hover:text-blue-600">
              <div>
                {{
                  this.modelValue.responsible?.name +
                  " " +
                  this.modelValue.responsible?.last_name
                }}
              </div>
              <div class="text-xs text-gray-400 mt-1">
                {{ this.modelValue.responsible?.email }}
              </div>
            </router-link>
          </FieldPage>

          <FieldPage title="Client">
            <router-link :to="`/h-admin/client/${this.modelValue.client_id}`" class="hover:text-blue-600">
              <div>
                {{
                  this.modelValue.client?.name +
                  " " +
                  (this.modelValue.client?.last_name ?? "")
                }}
              </div>
              <div class="text-xs text-gray-400 mt-1">
                {{
                  this.modelValue.client?.email +
                  " | " +
                  (this.modelValue.client?.phone ?? "")
                }}
              </div>
            </router-link>
          </FieldPage>
          <FieldPage title="Make & Model">
            {{ this.modelValue.make_model }}
          </FieldPage>
          <FieldPage title="Budget">
            {{ this.toLocaleNumber(this.modelValue.budget) }}
          </FieldPage>
          <FieldPage title="Maximum Mileage">
            {{ this.toLocaleNumber(this.modelValue.max_mileage, false) }}
          </FieldPage>
          <FieldPage title="Details">
            {{ this.modelValue.details }}
          </FieldPage>
        </template>

        <template #edit>

          <SelectPage label="Inspector" v-model="this.modelValue.responsible.id" :options="this.users"
            :get-option-label="(option) => option.name + ' ' + (option.last_name ?? '') + ' #' + option.id
              " :get-option-value="(option) => option.id" />

          <SelectPage label="Client" v-model="this.modelValue.client_id" :options="this.clients" :get-option-label="(option) => option.name + ' ' + (option.last_name ?? '') + ' #' + option.id
            " :get-option-value="(option) => option.id" />

          <InputTextPage v-model="this.modelValue.make_model" title="Make & Model" />
          <InputNumberPage v-model="this.modelValue.budget" title="Budget" />
          <InputNumberPage v-model="this.modelValue.max_mileage" title="Maximum Mileage" />
          <InputTextPage v-model="this.modelValue.details" title="Details" />
        </template>
      </SectionPage>

      <SectionPage title="Documents" icon="fa fa-file-alt">
        <template #buttons>
          <button v-if="this.isEditDocs" @click="
            $emit('editDocs');
          this.isEditDocs = false;
          this.saveDocuments();
          "
            class="w-8 h-8 rounded-lg cursor-pointer bg-blue-600 flex items-center justify-center text-white hover:bg-blue-700 hover:text-white transition">
            <i class="fas fa-save text-md"></i>
          </button>
        </template>
        <template #view>
          <div v-if="this.modelValue.documents" v-for="(document, index) in this.modelValue.documents" :key="index">
            <div class="flex items-center justify-between p-4 bg-gray-900 rounded-md">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-900/30 flex items-center justify-center text-green-400">
                  <i class="fas fa-file"></i>
                </div>
                <div>
                  <div class="font-medium text-white">
                    {{ document.name }}
                  </div>
                </div>
              </div>

              <div class="flex items-center gap-3">
                <a :href="document.path"
                  class="w-10 h-10 rounded-lg cursor-pointer bg-blue-600 flex items-center justify-center text-white hover:bg-blue-700 hover:text-white transition"
                  :download="document.name">
                  <i class="fas fa-download"></i>
                </a>

                <button @click="this.deleteDocument(index)"
                  class="w-10 h-10 rounded-lg cursor-pointer bg-red-600 flex items-center justify-center text-white hover:bg-red-700 hover:text-white transition">
                  <i class="fas fa-trash text-lg"></i>
                </button>
              </div>
            </div>
          </div>

          <div>
            <div
              class="flex items-center justify-between p-4 bg-gray-900 rounded-md border border-dashed border-blue-700">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white">
                  <i class="fas fa-file"></i>
                </div>
                <div>
                  <div class="font-medium text-white">Add document</div>
                </div>
              </div>
              <label @click="$emit('addDocument')"
                class="bg-blue-600 cursor-pointer hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md transition flex items-center gap-1">
                <i class="fas fa-plus-circle"></i>
                <span>Add document</span>
                <input @input="addFilesEvent" type="file" multiple="" class="hidden" hidden
                  accept="application/pdf, .pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, .docx" />
              </label>
            </div>
          </div>
        </template>
      </SectionPage>
    </SectionsPage>

    <SectionsPage :active-tab="this.selectedTab" section="vehicles">
      <SectionPage title="Inspected Cars" icon="fa fa-file-alt">
        <template #buttons>
          <ButtonSection @click="$emit('addVehicle')" title="Add Vehicle" icon="fa-plus-circle" />
        </template>
        <template #view>
          <router-link :to="`/h-admin/vehicle/${vehicle.id}`" v-if="this.vehicles"
            v-for="(vehicle, index) in this.vehicles" :key="vehicle.id"
            class="flex items-center justify-between p-4 bg-gray-900 rounded-md">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-green-900/30 flex items-center justify-center text-green-400">
                <i class="fas fa-car"></i>
              </div>
              <div>
                <div class="font-medium text-white">{{ vehicle.name }}</div>
              </div>
            </div>
            <router-link :to="`/h-admin/vehicle/${vehicle.id}`"
              class="text-blue-400 hover:text-blue-300 transition text-sm flex items-center gap-1">
              <i class="fas fa-external-link-alt"></i>
              <span>Open vehicle</span>
            </router-link>
          </router-link>
        </template>
      </SectionPage>
    </SectionsPage>

    <SectionsPage :active-tab="this.selectedTab" section="payments">
      <SectionPage title="Payments" icon="fa fa-credit-card">
        <template #buttons>
          <ButtonSection @click="$emit('addPayment')" title="Add New" icon="fa-plus-circle" />
        </template>

        <template #view>
          <FieldPage v-for="(payment, index) in this.modelValue.payments" :key="index">
            <div class="flex items-center gap-4">
              <router-link :to="`/h-admin/payment/${payment.id}`" class="hover:text-blue-600">
                Payment #{{ payment.id }}
                <span :class="payment.is_payment == 'Y'
                  ? 'text-green-600'
                  : 'text-red-600'
                  " class="text-gray-400 mt-1">
                  ${{ Number(payment.amount).toLocaleString("en-Us") }} ({{
                    payment.is_payment == "Y" ? "YES" : "NO"
                  }})
                </span>
              </router-link>

              <div class="flex gap-2">
                <button :href="payment.number" class="cursor-pointer container mx-auto h-full" target="_blank"
                  @click="this.copyNumber(payment)">
                  <i v-if="!payment.copiedNum" class="fa fa-copy text-gray-500 hover:text-blue-500"></i>
                  <i v-if="payment.copiedNum" class="fa fa-check text-green-500"></i>
                </button>
                <a :href="payment.link" class="text-blue-500 block text-center h-full" target="_blank">
                  <i class="fa fa-link text-gray-500 hover:text-blue-500"></i>
                </a>
              </div>
            </div>
          </FieldPage>
        </template>
      </SectionPage>
    </SectionsPage>

    <SectionsPage :active-tab="this.selectedTab" section="addons">
      <SectionPage title="Addons" icon="fa fa-puzzle-piece">
        <template #buttons>
          <ButtonSection title="Add" icon="fa-plus-circle" />
        </template>

        <template #view>
          <FieldPage v-for="(addon, index) in this.modelValue.addons" :key="index">
            <div class="flex items-center gap-4">
              <div>{{ addon.name }}</div>

              <div class="flex gap-2">${{ addon.pivot.price }}</div>
            </div>
          </FieldPage>
        </template>
      </SectionPage>
    </SectionsPage>
  </div>
</template>
<script>
import VueSelect from "vue3-select-component";
import { useClipboard } from "@vueuse/core";

const { copy } = useClipboard();

export default {
  components: {
    VueSelect,
  },
  emits: ["edit", "editDocs", "saveDocs", "saveDocsSuccess"],
  data() {
    return {
      isEditDocs: false,
      selectedTab: "main",
      packages: [],
      users: [],
      clients: [],
    };
  },
  props: {
    modelValue: {
      type: Array,
    },
    isEdit: {
      type: Boolean,
    },
    vehicles: {
      type: Object,
      default: {},
    },
  },
  watch: {
    isEdit() {
      if (this.isEdit == true) {
        this.getAllOptions();
      }
    },
  },
  created() {
    this.modelValue.inspection_date =
      this.modelValue.inspection_date ?? new Date("now");
  },
  methods: {
    async getAllOptions() {
      this.getUsers();
      this.getClients();
      this.getPackages();
    },
    async getClients() {
      await axios.get("/clients").then((response) => {
        this.clients = response.data.data;
      });
    },
    async getPackages() {
      await axios
        .get("/service/packages", {
          params: {
            filters: {
              serviceCode: "sel",
            },
          },
        })
        .then((response) => {
          this.packages = response.data.data;
        });
    },
    async getUsers() {
      let inspectionDate = new Date(this.modelValue.inspection_date);
      inspectionDate = inspectionDate.toISOString();

      await axios.get("/users").then((response) => {
        this.users = response.data.data;
      });
    },
    async addFilesEvent(event) {
      let files = event.target.files;

      for (const key in files) {
        if (!Object.hasOwn(files, key)) continue;

        if (key >= 20) {
          break;
        }
        const file = files[key];

        if (!this.modelValue.documents) {
          this.modelValue.documents = [];
        }

        this.modelValue.documents.push({
          name: file.name,
          real_name: file.name,
          path: URL.createObjectURL(file),
          file: file,
          mime: file.type,
        });
      }

      this.isEditDocs = true;
      this.$emit("editDocs");
    },
    async saveDocuments() {
      let formData = this.objectToFormData({
        documents: this.modelValue.documents,
      });

      axios
        .post(`/order/${this.modelValue.order.id}/documents/save`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          this.modelValue.documents = res.data.data;

          this.isEditDocs = false;
          this.$emit("saveDocsSuccess");
        })
        .catch((res) => { });
    },
    async deleteDocument(documentIndex) {
      const doc = this.modelValue.documents[documentIndex];

      if (doc.id) {
        axios
          .delete(`/order/${this.modelValue.order.id}/document/${doc.id}`)
          .then((res) => {
            this.modelValue.documents = this.modelValue.documents.filter(
              (doc, index) => index != documentIndex,
            );
          })
          .catch((res) => { });
      } else {
        URL.revokeObjectURL(doc.path);

        this.modelValue.documents = this.modelValue.documents.filter(
          (doc, index) => index != documentIndex,
        );
      }

      if (this.modelValue.documents.length == 0) {
        this.isEditDocs = false;
      }
    },
    objectToFormData(object, formDataOld = null, keyOld = null) {
      let formData = formDataOld ?? new FormData();

      for (var key in object) {
        let value = object[key];

        if (keyOld) {
          key = `${keyOld}[${key}]`;
        }

        if (value instanceof File) {
          formData.append(key, value, value.name);
          continue;
        }

        if (value instanceof Object) {
          this.objectToFormData(value, formData, key);
          continue;
        }

        formData.append(key, value);
      }

      return formData;
    },
    async onCopy(text) {
      await copy(text);
    },
    copyNumber(object) {
      this.onCopy(object.number);

      object.copiedNum = true;

      setTimeout(function () {
        object.copiedNum = false;
      }, 1200);
    },
    toLocaleNumber(number, isPrice = true) {
      number = String(number).replace(/[^\d.]/g, "");

      if (number == 0 || !number) {
        return "N/A";
      }

      let str = "";

      if (isPrice) {
        str += "$";
      }

      str += Number(number).toLocaleString("en-US");

      return str;
    },
  },
};
</script>
<style scoped>
.tab {
  border-color: transparent;
  color: var(--color-gray-400);
}

.tab:hover {
  border-color: var(--color-gray-600);
  color: var(--color-gray-300);
}

.active-tab {
  border-color: var(--color-blue-400);
  color: var(--color-blue-400);
}
</style>
