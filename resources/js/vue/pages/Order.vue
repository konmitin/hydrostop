<template lang="">
    <div>
        <PageTemplate 
        @edit="this.getClients(); 
        this.getBranches();" title='Заказ' apiName="orders" 
        :sections="{
          main: [
            {
              name: 'Основное',
              cols: 2,
              fields: {
                number: {
                  key: {
                    data: 'number',
                    view: 'number',
                  },
                  title: 'Номер',
                  type: 'text'
                },
                amount: {
                  key: {
                    data: 'amount',
                    view: 'amount',
                  },
                  title: 'Сумма',
                  type: 'number'
                },
                email: {
                  key: {
                    data: 'client.email',
                    view: 'client.email',
                  },
                  title: 'Электронная почта',
                  type: 'email',
                  editable: false
                },
                delivery_at: {
                  key: {
                    data: 'delivery_at',
                    view: 'delivery_at',
                  },
                  title: 'Дата доставки',
                  type: 'date'
                },
                client: {
                  key: {
                    data: 'client.id',
                    view: 'client.name',
                  },
                  title: 'Клиент',
                  type: 'select',
                  values: this.clients,
                },
                branch: {
                  key: {
                    data: 'branch.id',
                    view: 'branch.name',
                  },
                  title: 'Город',
                  type: 'select',
                  values: this.branches,
                },

              }
            }
          ]
      }" />
    </div>
</template>
<script>
import { reactive } from 'vue';
import PageTemplate from './PageTemplate.vue';

export default {
  components: {
    PageTemplate
  },
  data() {
    return {
      clients: [],
      branches: [],
      tabs: [],
      clients: [],
      branches: [],
    }
  },
  methods: {
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
}
</script>
<style lang="">

</style>