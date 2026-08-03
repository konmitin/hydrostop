<template>
  <TemplateModal v-model="this.fields" :mode="this.mode" :isEdit="this.isEdit">
    <SelectPage
      @optionSelected="this.isEdit = true"
      label="Client"
      v-model="this.fields.client_id"
      :options="this.clients"
      :get-option-label="
        (option) =>
          option.name + ' ' + (option.last_name ?? '') + ' #' + option.id
      "
      :get-option-value="(option) => option.id"
    />

    <SelectPage
      label="Inspection Type"
      v-model="this.fields.client_type"
      :options="[
        {
          label: 'Without',
          value: 'without',
        },
        {
          label: 'With',
          value: 'with',
        },
      ]"
    />

    <SelectPage
      @optionSelected="this.isEdit = true"
      label="Branch"
      v-model="this.fields.branche_id"
      :options="this.branches"
      :get-option-label="(option) => option.name"
      :get-option-value="(option) => option.id"
    />

    <SelectPage
      @optionSelected="this.isEdit = true"
      label="Inspector"
      v-model="this.fields.responsible_id"
      :options="this.users"
      :get-option-label="
        (option) =>
          option.name + ' ' + (option.last_name ?? '') + ' #' + option.id
      "
      :get-option-value="(option) => option.id"
    />

    <SelectPage
      @optionSelected="this.isEdit = true"
      label="Packages"
      v-model="this.fields.package"
      :options="this.packages"
      :get-option-label="(option) => option.name"
      :get-option-value="(option) => option.id"
    />

    <SelectPage
      @optionSelected="this.isEdit = true"
      label="Addons"
      :isMulti="true"
      v-model="this.fields.addons"
      :options="this.addons"
      :get-option-label="(option) => option.name"
      :get-option-value="(option) => option.code"
    />

    <SelectPage
      label="Payment"
      v-model="this.fields.is_payment"
      :options="[
        {
          label: 'YES',
          value: 'Y',
        },
        {
          label: 'NO',
          value: 'N',
        },
      ]"
    />

    <InputTextPage
      @input="this.isEdit = true"
      title="Transaction ID"
      v-model="this.fields.payment_number"
      placeholder="cs_test_a1aaf7WgTrnOhXSEhKpKtRIuqhNMfYGYpk0kvlwQ3qyjFAtMsXiJzpGEik"
    />
  </TemplateModal>
</template>

<script>
import InputFormatNumber from "../../inputs/InputFormatNumber.vue";

export default {
  components: {
    InputFormatNumber,
  },
  data() {
    return {
      fields: {
        type: "IN",
        total: 0,
        vehicle_total: 0,
        range_total: 0,
        is_payment: "N",
        payment_number: "",
        client_type: "without",
        client_id: 0,
        branche_id: 0,
        responsible_id: 0,
        package: 0,
      },
      isEdit: true,
      clients: [],
      branches: [],
      users: [],
      statuses: [],
      packages: [],
      addons: [],
    };
  },
  props: {
    mode: {
      type: String,
      default: "add",
    },
  },
  async created() {
    this.getClients();
    this.getBranches();
    this.getUsers();
    this.getStatuses();
    this.getPackages();
    this.getAddons();
  },
  methods: {
    async getClients() {
      await axios.get("/clients").then((response) => {
        this.clients = response.data.data;
      });
    },
    async getBranches() {
      await axios.get("/branches").then((response) => {
        this.branches = response.data.data;
      });
    },
    async getUsers(filters = {}) {
      filters.active = "Y";

      await axios
        .get("/users", {
          params: {
            filters: filters,
          },
        })
        .then((response) => {
          this.users = response.data.data;
        });
    },
    async getStatuses() {
      await axios.get("/order/statuses").then((response) => {
        this.statuses = response.data.data;
      });
    },
    async getPackages() {
      let filters = {
        serviceCode: "ins",
      };

      await axios
        .get("/service/packages", {
          params: {
            filters: filters,
          },
        })
        .then((response) => {
          this.packages = response.data.data;
        });
    },
    async getAddons() {
      let filters = {
        serviceCode: "ins",
      };
      await axios
        .get("/service/addons", {
          params: {
            filters: filters,
          },
        })
        .then((response) => {
          this.addons = response.data.data;
        });
    },
  },

  watch: {
    async "fields.branche_id"() {
      await this.getUsers({ branche: this.fields.branche_id });
    },
  },
};
</script>

<style scoped></style>
