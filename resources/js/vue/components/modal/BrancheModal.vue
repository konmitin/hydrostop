<template>
  <TemplateModal v-model="this.fields" :mode="this.mode" :isEdit="this.isEdit">
    <InputTextPage
      @input="this.isEdit = true"
      title="Name"
      v-model="this.fields.name"
      placeholder="Washington"
    ></InputTextPage>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">
        Phone
      </label>
      <InputPhone
        @update:model-value="this.isEdit = true"
        v-model="this.fields.phone"
        placeholder="(123) 456-78-90"
        class="w-full input-field rounded-sm px-4 py-3 text-gray-900"
        required
      ></InputPhone>
    </div>

    <InputTextPage
      @input="this.isEdit = true"
      title="Email"
      v-model="this.fields.email"
      placeholder="example@example.com"
    ></InputTextPage>

    <InputTextPage
      @input="this.isEdit = true"
      title="Address"
      v-model="this.fields.address"
      placeholder="162 South Avenue"
    ></InputTextPage>

    <SelectPage
      @update:model-value="this.isEdit = true"
      label="Timezone"
      v-model="this.fields.timezone"
      :options="this.timezones"
      placeholder="America/New_York"
      :isRequired="true"
    ></SelectPage>

    <InputTextPage
      @input="this.isEdit = true"
      :type="'number'"
      title="ZIP Code"
      v-model="this.fields.zip"
      placeholder="12345"
    ></InputTextPage>

    <InputTextPage
      @input="this.isEdit = true"
      :type="'number'"
      title="GPS Coverage from Center (mi)"
      v-model="this.fields.radius"
      placeholder="50"
    ></InputTextPage>

    <InputTextPage
      @input="this.isEdit = true"
      :type="'number'"
      title="Max GPS Coverage from center (mi)"
      v-model="this.fields.max_radius"
      placeholder="150"
    ></InputTextPage>

    <InputTextPage
      @input="this.isEdit = true"
      :type="'number'"
      title="Mile price"
      v-model="this.fields.mile_price"
      placeholder="50"
    ></InputTextPage>

    <InputTextPage
      @input="this.isEdit = true"
      :type="'number'"
      title="Lat"
      v-model="this.fields.coordinate_lat"
      placeholder="50"
    ></InputTextPage>

    <InputTextPage
      @input="this.isEdit = true"
      :type="'number'"
      title="Long"
      v-model="this.fields.coordinate_long"
      placeholder="50"
    ></InputTextPage>

    <SelectPage
      @update:model-value="this.isEdit = true"
      label="Default"
      v-model="this.fields.is_default"
      :options="this.defaults"
      placeholder="Yes or No"
      :isRequired="true"
    ></SelectPage>
  </TemplateModal>
</template>

<script>
import InputPhone from "../inputs/InputPhone.vue";

export default {
  name: "BrancheModal",
  components: {
    InputPhone,
  },
  data() {
    return {
      fields: {
        id: this.branche?.id ?? 0,
        name: this.branche?.name ?? "",
        phone: this.branche?.phone ?? "",
        email: this.branche?.email ?? "",
        address: this.branche?.address ?? "",
        timezone: this.branche?.timezone ?? "",
        radius: this.branche?.radius ?? 50,
        max_radius: this.branche?.radius ?? 150,
        mile_price: this.branche?.mile_price ?? 2,
        zip: this.branche?.zip ?? 2,
        coordinate_lat: this.branche?.coordinate_lat ?? 0.0,
        coordinate_long: this.branche?.coordinate_long ?? 0.0,
        is_default: this.branche?.is_default ?? "N",
      },
      isEdit: this.mode == "edit" ? false : true,
      timezones: [],
      defaults: [
        { label: "Yes", value: "Y" },
        { label: "No", value: "N" },
      ],
    };
  },
  created() {
    let timezones = Intl.supportedValuesOf("timeZone");

    timezones.map((timezone) => {
      console.log(timezone.indexOf("America") >= 0);
      if (timezone.indexOf("America") >= 0) {
        let object = {
          label: timezone,
          value: timezone,
        };

        this.timezones.push(object);

        return object;
      }

      return null;
    });
  },
  props: {
    branche: {
      type: Object,
      default: {},
    },
    mode: null,
  },
  methods: {},
  emits: [],
};
</script>

<style scoped>
.input-field {
  transition: all 0.3s ease;
  background-color: #f9fafb;
  border: 1px solid #e5e7eb;
}

.input-field:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  outline: none;
  background-color: white;
}

.modal-overlay {
  background-color: rgba(0, 0, 0, 0.5);
  transition: all 0.3s ease;
}

.modal-content {
  animation: modalFadeIn 0.3s ease forwards;
}

@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.btn-primary {
  background: linear-gradient(to right, #3b82f6, #2563eb);
  color: white;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background: linear-gradient(to right, #2563eb, #1d4ed8);
  transform: translateY(-1px);
  box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
}
</style>
