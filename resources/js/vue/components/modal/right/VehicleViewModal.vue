<template>
  <TemplateRight @close="$emit('close')">
    <HeaderRight
      :isEdit="this.isEdit"
      @save="this.save()"
      @edit="this.isEdit = true"
      @close="$emit('close')"
      :title="this.vehicle.name"
    >
      <template #subtitle>
        <span>
          {{
            new Date(this.vehicle.created_at).toLocaleString("en-US", {
              year: "numeric",
              month: "long",
              day: "numeric",
            })
          }}
        </span>

        <span>·</span>

        <div class="">
          <router-link
            v-if="this.vehicle.order.inspection"
            class="text-blue-600 hover:text-blue-700"
            :to="`/h-admin/inspection/${this.vehicle.order.inspection.id}`"
          >
            Inspection
          </router-link>

          <router-link
            v-if="this.vehicle.order.selection"
            class="text-blue-600 hover:text-blue-700"
            :to="`/h-admin/selection/${this.vehicle.order.selection.id}`"
          >
            Inspection
          </router-link>
        </div>
      </template>
    </HeaderRight>

    <MainPage>
      <SectionPage :isEdit="this.isEdit" icon="fa-cogs" title="Main" cols="2">
        <template #view>
          <FieldPage title="Make">
            {{ this.vehicle.make.name ?? "N/A" }}
          </FieldPage>
          <FieldPage title="Model">
            {{ this.vehicle.model.name ?? "N/A" }}
          </FieldPage>
          <FieldPage title="Year">{{ this.vehicle.year ?? "N/A" }}</FieldPage>
          <FieldPage title="Vin">{{
            this.vehicle.vin.length > 0 ? this.vehicle.vin : "N/A"
          }}</FieldPage>

          <FieldPage title="Asking Price">
            {{ this.toLocaleNumber(this.vehicle.asking_price) }}
          </FieldPage>
          <!-- <FieldPage title="Market Value">
            {{ this.toLocaleNumber(this.vehicle.market_value) }}
          </FieldPage> -->

          <FieldPage title="Stock Number">
            {{
              this.vehicle.stock_number?.length > 0
                ? this.vehicle.stock_number
                : "N/A"
            }}
          </FieldPage>
          <FieldPage title="Link">
            {{ this.vehicle.link.length > 0 ? this.vehicle.link : "N/A" }}
          </FieldPage>
        </template>

        <template #edit>
          <SelectPage
            label="Make"
            :isTaggable="true"
            @option-created="
              (tag) => {
                this.makes.push({ id: this.makesCount + 1, name: tag });
                this.makesCount++;
                this.vehicle.make.id = this.makesCount;
                this.vehicle.make.name = name;
              }
            "
            @option-selected="
              (make) => {
                this.vehicle.make.name = make.label;
                this.getMakeModels(this.vehicle.make.id);
              }
            "
            v-model="this.vehicle.make.id"
            :options="this.makes ?? []"
            :get-option-label="(option) => option.name"
            :get-option-value="(option) => option.id"
          />
          <SelectPage
            label="Model"
            :isTaggable="true"
            @optionCreated="
              (tag) => {
                console.log(tag);
                this.models.push({ id: this.modelsCount + 1, name: tag });
                this.modelsCount++;
                this.vehicle.model.id = this.modelsCount;
                this.vehicle.model.name = tag;
              }
            "
            @optionSelected="
              (model) => {
                console.log(model);
                this.vehicle.model.name = model.name;
              }
            "
            v-model="this.vehicle.model.id"
            :options="this.models"
            :get-option-label="(option) => option.name"
            :get-option-value="(option) => option.id"
          />

          <InputTextPage title="Year" v-model="this.vehicle.year" />
          <InputTextPage title="VIN" v-model="this.vehicle.vin" />
          <InputNumberPage
            title="Asking Price"
            v-model="this.vehicle.asking_price"
          />
          <!-- <InputNumberPage
            title="Market Value"
            v-model="this.vehicle.market_value"
          /> -->

          <InputTextPage
            title="Stock Number"
            v-model="this.vehicle.stock_number"
          />
          <InputTextPage title="Link" v-model="this.vehicle.link" />
        </template>
      </SectionPage>

      <SectionPage
        :isEdit="this.isEdit"
        icon="fa-cogs"
        title="TECHNICAL"
        cols="2"
      >
        <template #view>
          <FieldPage title="Engine"
            >{{ this.vehicle.engine?.length > 0 ? this.vehicle.engine : "N/A" }}
          </FieldPage>
          <FieldPage title="Mileage"
            >{{ this.toLocaleNumber(this.vehicle.mileage, false) }}
          </FieldPage>
          <FieldPage title="Fuel">{{
            this.vehicle.fuel?.name ?? "N/A"
          }}</FieldPage>
          <FieldPage title="Transmission"
            >{{ this.vehicle.transmission?.name ?? "N/A" }}
          </FieldPage>
          <FieldPage title="Drive">
            {{ this.vehicle.drive?.name ?? "N/A" }}
          </FieldPage>
          <FieldPage title="Body Style">
            {{ this.vehicle.bodyStyle?.name ?? "N/A" }}
          </FieldPage>
          <FieldPage title="Body color"
            >{{
              this.vehicle.body_color?.length > 0
                ? this.vehicle.body_color
                : "N/A"
            }}
          </FieldPage>
          <FieldPage title="Interior color"
            >{{ this.vehicle.interior_color ?? "N/A" }}
          </FieldPage>
          <FieldPage title="Interior"
            >{{ this.vehicle.interior ?? "N/A" }}
          </FieldPage>
        </template>

        <template #edit>
          <InputTextPage title="Engine" v-model="this.vehicle.engine" />
          <InputNumberPage title="Mileage" v-model="this.vehicle.mileage" />
          <SelectPage
            label="Fuel"
            v-model="this.vehicle.fuel_id"
            :options="this.fuels ?? []"
            :get-option-label="(option) => option.name"
            :get-option-value="(option) => option.id"
          />
          <SelectPage
            label="Transmission"
            v-model="this.vehicle.transmission_id"
            :options="this.transmissions ?? []"
            :get-option-label="(option) => option.name"
            :get-option-value="(option) => option.id"
          />
          <SelectPage
            label="Drive"
            v-model="this.vehicle.drive_id"
            :options="this.drives ?? []"
            :get-option-label="(option) => option.name"
            :get-option-value="(option) => option.id"
          />
          <SelectPage
            label="Body Style"
            v-model="this.vehicle.body_style_id"
            :options="this.bodyStyles ?? []"
            :get-option-label="(option) => option.name"
            :get-option-value="(option) => option.id"
          />

          <InputTextPage title="Body color" v-model="this.vehicle.body_color" />
          <InputTextPage
            title="Interior color"
            v-model="this.vehicle.interior_color"
          />
          <InputTextPage title="Interior" v-model="this.vehicle.interior" />
        </template>
      </SectionPage>

      <SectionPage icon="fa-file-alt" title="Report" cols="1">
        <template #view>
          <div
            class="flex h-16 items-center justify-between px-4 bg-gray-800 rounded-md"
          >
            <div
              v-if="this.vehicle.report"
              class="w-full flex items-center justify-between"
            >
              <div class="flex items-center gap-3">
                <i class="fas fa-file-pdf text-green-600"></i>
                <div>
                  <div class="font-medium text-white">Report exists</div>
                </div>
              </div>
              <router-link
                :to="`/h-admin/report/${this.vehicle.report.id}`"
                class="text-blue-400 hover:text-blue-300 transition text-sm flex items-center gap-1"
              >
                <i class="fas fa-external-link-alt"></i>
                <span>Open report</span>
              </router-link>
            </div>

            <div
              v-if="!this.vehicle.report"
              class="w-full flex items-center justify-between"
            >
              <div class="flex items-center gap-3">
                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                <div>
                  <div class="font-medium text-white">Report null</div>
                </div>
              </div>
              <button
                @click="$emit('addReport', this.vehicle)"
                class="bg-yellow-600 cursor-pointer hover:bg-yellow-500 text-white text-sm px-4 py-2 rounded-lg transition flex items-center gap-1"
              >
                <i class="fas fa-plus-circle"></i>
                <span>Add report</span>
              </button>
            </div>
          </div>
        </template>
      </SectionPage>

      <button
        v-if="this.$store.state.user?.isAdmin"
        @click="this.delete()"
        class="w-full h-10 rounded-lg cursor-pointer bg-red-600 flex items-center justify-center text-white hover:bg-red-700 hover:text-white transition"
      >
        <i class="fas fa-trash text-lg"></i>
      </button>
    </MainPage>
  </TemplateRight>
</template>
<script>
import VueSelect from "vue3-select-component";
import { useGlobalNotification } from "../../../composables/globalNotification";

const { showNotify } = useGlobalNotification();

export default {
  components: {
    VueSelect,
  },
  data() {
    return {
      orderLink: this.vehicle.order.inspection
        ? "/h-admin/inspection/" + this.vehicle.order.inspection.id
        : "/h-admin/selection/" + this.vehicle.order.selection.id,
      testGroups: [],
      completedTest: 0,
      completedTestProcent: 0,
      isEdit: false,
      fuels: [],
      transmissions: [],
      bodyStyles: [],
      drives: [],
      makes: [],
      models: [],
      makesCount: 0,
      modelsCount: 0,
    };
  },
  props: {
    vehicle: {
      type: Object,
      default: {},
    },
  },
  emits: ["close", "edit", "addReport"],
  async created() {
    this.vehicle.engine = this.vehicle.engine ?? "";
    this.vehicle.stock_number = this.vehicle.stock_number ?? "";
    this.vehicle.link = this.vehicle.link ?? "";
    this.vehicle.mileage = this.vehicle.mileage ?? "";
    this.vehicle.asking_price = this.vehicle.asking_price ?? 0;
    this.vehicle.market_value = this.vehicle.market_value ?? "";
    this.vehicle.vin = this.vehicle.vin ?? "";
    this.vehicle.body_color = this.vehicle.body_color ?? "";
    this.vehicle.interior_color = this.vehicle.interior_color ?? "";
    this.vehicle.interior = this.vehicle.interior ?? "";

    await this.getAllOptions();
  },
  async updated() {
    this.vehicle.engine = this.vehicle.engine ?? "";
    this.vehicle.mileage = this.vehicle.mileage ?? "";
    this.vehicle.stock_number = this.vehicle.stock_number ?? "";
    this.vehicle.link = this.vehicle.link ?? "";
    this.vehicle.asking_price = this.vehicle.asking_price ?? 0;
    this.vehicle.market_value = this.vehicle.market_value ?? "";
    this.vehicle.vin = this.vehicle.vin ?? "";
    this.vehicle.body_color = this.vehicle.body_color ?? "";
    this.vehicle.interior_color = this.vehicle.interior_color ?? "";
    this.vehicle.interior = this.vehicle.interior ?? "";
  },
  methods: {
    async save() {
      let formData = this.objectToFormData({ vehicle: this.vehicle });

      await axios
        .post("/vehicle/save", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          let data = res.data.data;

          this.vehicle.name = data.name;

          this.vehicle.model = data.model;
          this.vehicle.make = data.make;
          this.vehicle.fuel = data.fuel;
          this.vehicle.transmission = data.transmission;
          this.vehicle.drive = data.drive;
          this.vehicle.bodyStyle = data.bodyStyle;

          this.isEdit = false;
          this.$emit("save");
        })
        .catch((error) => {
          let data = error.response.data;

          for (const key in data.errors) {
            if (!Object.hasOwn(data.errors, key)) continue;

            const error = data.errors[key];

            showNotify(error[0], "error", 3000);
          }
        });
    },
    async delete() {
      await axios
        .delete(`/vehicle/${this.vehicle.id}`, {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
        })
        .then((res) => {
          this.$emit("delete");
          this.$router.back();
        })
        .catch((error) => {
          let data = error.response.data;

          showNotify(data.errors.reports);
        });
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
    async getAllOptions() {
      this.getFuels();
      this.getTransmissions();
      this.getDrives();
      this.getBodyStyles();
      this.getModels();
      this.getMakeModels(this.vehicle.make_id);
    },
    async getFuels() {
      await axios.get("/fuels").then((response) => {
        this.fuels = response.data.data;
      });
    },
    async getTransmissions() {
      await axios.get("/transmissions").then((response) => {
        this.transmissions = response.data.data;
      });
    },
    async getDrives() {
      await axios.get("/drives").then((response) => {
        this.drives = response.data.data;
      });
    },
    async getBodyStyles() {
      await axios.get("/bodystyles").then((response) => {
        this.bodyStyles = response.data.data;
      });
    },
    async getModels() {
      await axios.get("/makes").then((response) => {
        this.makes = response.data.data;
        this.makesCount = response.data.count;
      });
    },
    async getMakeModels(makeId) {
      await axios.get(`/make/${makeId}/models`).then((response) => {
        this.models = response.data.data;
        this.modelsCount = response.data.count;
      });
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
<style scoped></style>
