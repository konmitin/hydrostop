<template lang="">
    <div>
        <PageTemplate :tabs="this.tabs" title='Клиент' apiName="clients" 
        :sections="this.sections" />
    </div>
</template>
<script>

export default {
  data() {
    return {
      tabs: [
        {
          title: 'Основное',
          tab: 'main',
        },
        {
          title: 'Заказы',
          tab: 'orders',
        }
      ],
      sections: {
        main: [
          {
            name: 'Основное',
            cols: 2,
            fields: {
              name: {
                key: {
                  data: 'name',
                  view: 'name',
                },
                title: 'Имя',
                type: 'text'
              },
              phone: {
                key: {
                  data: 'phone',
                  view: 'phone',
                },
                title: 'Телефон',
                type: 'phone'
              },
              email: {
                key: {
                  data: 'email',
                  view: 'email',
                },
                title: 'Электронная почта',
                type: 'email'
              },
              company_name: {
                key: {
                  data: 'company_name',
                  view: 'company_name',
                },
                title: 'Компания',
                type: 'text'
              },
            }
          }
        ],
        orders: [
          {
            name: 'Заказы'
          }
        ]
      },
    }
  },
  methods: {
  },
}
</script>
<style lang="">

</style>