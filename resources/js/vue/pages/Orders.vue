<template>
  <div>
    <ListTemplate apiName="orders" pageTitle="Заказы" listTitle="Список заказов" :properties="[
      { name: 'Номер', code: 'number' },
      { name: 'Сумма', code: 'amount', type: 'price' },
      { name: 'Электронная почта', code: 'client.email' },
      { name: 'Дата доставки', code: 'delivery_at' },
      { name: 'Клиент', code: 'client.name' },
      { name: 'Город', code: 'branch.name' },
    ]" :fields="[
      {
        name: 'number',
        title: 'Номер',
        type: 'text',
        model: '',
        required: true,
      },
      {
        name: 'amount',
        title: 'Сумма',
        type: 'number',
        model: '',
        required: true,
      },
      {
        name: 'client_id',
        title: 'Клиент',
        type: 'select',
        model: 0,
        values: this.clients,
        required: false,
      },
      {
        name: 'branch_id',
        title: 'Город',
        type: 'select',
        model: 0,
        values: this.branches,
        required: true,
      },
    ]" :filters="[
      {
        title: 'ID',
        type: 'text',
        model: '',
      },
      {
        title: 'Номер',
        type: 'text',
        model: '',
      },
    ]" @showAddModal="this.getClients(); this.getBranches();" />
  </div>
</template>
<script>
import { ref } from "vue";
import ListTemplate from "./ListTemplate.vue";

export default {
  data() {
    return {
      clients: [],
      branches: [],
    }
  },
  components: {
    ListTemplate,
  }, methods: {
    async getClients() {

      if (this.clients.length > 0) {
        return;
      }

      await axios.get("/api/clients").then((response) => {
        let clients = response.data.data;

        for (const key in clients) {
          if (!Object.hasOwn(clients, key)) continue;

          const client = clients[key];

          this.clients.push({
            label: client.name,
            value: client.id,
          });
        }
      });
    },
    async getBranches() {

      if (this.branches.length > 0) {
        return;
      }

      await axios.get("/api/branches").then((response) => {
        let branches = response.data.data;

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
  },
};
</script>
<style></style>
