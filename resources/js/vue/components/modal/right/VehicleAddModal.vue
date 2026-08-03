<template>
  <TemplateRight @close="$emit('close')">
    <HeaderRight
      :isEdit="true"
      @save="this.save()"
      @edit="true"
      @close="$emit('close')"
      title="New Vehicle"
    >
      <template #subtitle>
        <span>
          {{
            new Date().toLocaleString("en-US", {
              year: "numeric",
              month: "long",
              day: "numeric",
            })
          }}
        </span>
      </template>
    </HeaderRight>

    <MainPage>
      <SectionPage :isEdit="true" icon="fa-cogs" title="Main" cols="2">
        <template #edit>
          <SelectPage
            label="Make"
            :isTaggable="true"
            @option-created="
              (tag) => {
                this.makes.push({ id: this.makes.length + 1, name: tag });
                this.vehicle.make.id = this.makes.length;
                this.vehicle.make.name = tag;
              }
            "
            @option-selected="
              (make) => {
                this.vehicle.make.name = make;
                this.getMakeModels(this.vehicle.make.id);
              }
            "
            v-model="this.vehicle.make.id"
            :options="this.makes ?? []"
            :getOptionLabel="(option) => option.name"
            :getOptionValue="(option) => option.id"
          />
          <SelectPage
            label="Model"
            :isTaggable="true"
            @optionCreated="
              (tag) => {
                this.models.push({ id: this.modelsCount + 1, name: tag });
                this.vehicle.model.id = this.models.length;
                this.vehicle.model.name = tag;
              }
            "
            @optionSelected="
              (model) => {            
                this.vehicle.model.name = model;
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

      <SectionPage :isEdit="true" icon="fa-cogs" title="TECHNICAL" cols="2">
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
      vehicle: {
        order: this.orderType.order,
        order_id: this.orderType.order.id,
      },
      orderLink:
        this.orderType.order.type == "IN"
          ? "/h-admin/inspection/" + this.orderType.id
          : "/h-admin/selection/" + this.orderType.id,
      testGroups: [],
      fuels: [],
      transmissions: [],
      bodyStyles: [],
      drives: [],
      makes: [],
      makesCount: 0,
      models: [],
      modelsCount: 0,
    };
  },
  props: {
    orderType: {
      type: Object,
      default: {},
    },
  },
  emits: ["close", "success"],
  async created() {
    this.vehicle.make = { id: 0, name: "" };
    this.vehicle.model = { id: 0, name: "" };

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
    this.vehicle.stock_number = this.vehicle.stock_number ?? "";
    this.vehicle.link = this.vehicle.link ?? "";
    this.vehicle.mileage = this.vehicle.mileage ?? "";
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
        .post("/vehicle/add", formData, {
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
          this.vehicle.engine = data.engine;
          this.vehicle.drive = data.drive;
          this.vehicle.bodyStyle = data.bodyStyle;

          this.$emit("close");
          this.$emit("success", this.vehicle);
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
      this.getMakes();
      this.getMakeModels(this.vehicle.make.id);
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
    async getMakes() {
      await axios.get("/makes").then((response) => {
        this.makes = response.data.data;
        this.makesCount = response.data.count;
      });
    },
    async getMakeModels(makeId) {
      await axios.get(`/make/${makeId}/models`).then((response) => {
        this.models = response.data.data;
        this.modelsCount = response.data.count;

        this.vehicle.model.id = this.models.length;
      });
    },
  },
};
</script>
<style scoped>
.thin-scroll::-webkit-scrollbar {
  width: 5px;
}

.thin-scroll::-webkit-scrollbar-track {
  background: #1f2937;
}

.thin-scroll::-webkit-scrollbar-thumb {
  background: #4b5563;
  border-radius: 12px;
}

@keyframes slideIn {
  from {
    transform: translateX(100%);
    opacity: 0;
  }

  to {
    transform: translateX(0);
    opacity: 1;
  }
}

.modal-slide {
  animation: slideIn 0.3s ease-out forwards;
}
</style>
