<template lang="">
    <div>
        <PageTemplate :tabs="this.tabs" title='Заявка' apiName="calls" 
        :sections="{
          main: [
            {
              name: 'Основное',
              cols: 1,
              fields: {
                client_name: {
                  key: {
                    data: 'client.id',
                    view: 'client.name',
                  },
                  title: 'Клиент',
                  type: 'select',
                  values: this.clients
                },
                name: {
                  key: {
                    data: 'name',
                    view: 'name',
                  },
                  title: 'Введенный имя',
                  type: 'text'
                },
                phone: {
                  key: {
                    data: 'phone',
                    view: 'phone',
                  },
                  title: 'Введенный телефон',
                  type: 'phone'
                },
                email: {
                  key: {
                    data: 'email',
                    view: 'email',
                  },
                  title: 'Введенная почта',
                  type: 'email'
                },
                comment: {
                  key: {
                    data: 'comment',
                    view: 'comment',
                  },
                  title: 'Комментарий',
                  type: 'text'
                },
              }
            }
          ]
        }" @edit="this.getClients()" />
    </div>
</template>
<script>

export default {
  data() {
    return {
      clients: [],
      tabs: [
        {
          title: 'Основное',
          tab: 'main',
        }
      ],

    }
  },
  methods: {
    async getClients() {
      if (this.clients.length > 0) {
        return;
      }

      await axios.get("/api/clients").then((response) => {
        let clients = response.data.data;
        let out = [];

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
  }
}
</script>
<style lang="">

</style>