<template>
  <div>
    <ListTemplate apiName="calls" pageTitle="Заявки" listTitle="Список заявок" :properties="this.properties"
      :filters="this.filters" :fields="[
        {
          name: 'client',
          title: 'Клиент',
          type: 'select',
          model: 0,
          values: this.clients,
          required: true,
        },
        {
          name: 'comment',
          title: 'Комментарий',
          type: 'text',
          model: '',
          required: true,
        },
      ]" @showAddModal="this.getClients()" />
  </div>
</template>
<script>
import { ref } from "vue";
import ListTemplate from "./ListTemplate.vue";

export default {
  data() {
    return {
      filters: [
        {
          title: 'ID',
          type: 'text',
          model: '',
        },
      ],
      properties: [
        { name: 'Введенное имя', code: 'name' },
        { name: 'Введенный телефон', code: 'phone' },
        { name: 'Введенная почта', code: 'email' },
        { name: 'Клиент', code: 'client.name' },
        { name: 'Телефон', code: 'client.phone' },
        { name: 'Почта', code: 'client.email' },
        { name: 'Комментарий', code: 'comment' },
      ],
      clients: [],
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
  },
};
</script>
<style></style>
