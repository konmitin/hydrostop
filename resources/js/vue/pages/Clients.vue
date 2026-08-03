<template>
  <div>
    <ListTemplate apiName="clients" pageTitle="Клиенты" listTitle="Список клиентов" :properties="this.properties"
      :filters="this.filters" :fields="[
        {
          name: 'name',
          title: 'Имя',
          type: 'text',
          model: '',
          required: true,
        },
        {
          name: 'phone',
          title: 'Телефон',
          type: 'phone',
          model: ''
        },
        {
          name: 'email',
          title: 'Электронная почта',
          type: 'email',
          model: ''
        },
        {
          name: 'company_name',
          title: 'Компания',
          type: 'text',
          model: ''
        },
      ]" />
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
        {
          title: 'Номер',
          type: 'text',
          model: '',
        },
      ],
      properties: [
        { name: 'Имя', code: 'name' },
        { name: 'Телефон', code: 'phone' },
        { name: 'Электронная почта', code: 'email' },
        { name: 'Компания', code: 'company_name' },
      ]
    }
  },
  components: {
    ListTemplate,
  }, methods: {},
};
</script>
<style></style>
