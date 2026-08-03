<template>
  <div>
    <ListTemplate apiName="branches" pageTitle="Города" listTitle="Список городов" :properties="this.properties"
      :fields="this.fields" :filters="[
        {
          title: 'ID',
          type: 'text',
          model: '',
        },
        {
          title: 'Название',
          type: 'text',
          model: '',
        },
      ]" />
  </div>
</template>
<script>
import ListTemplate from "./ListTemplate.vue";

export default {
  data() {
    return {
      properties: [
        { name: 'Название', code: 'name' },
        { name: 'Адрес', code: 'address' },
        { name: 'Электронная почта', code: 'email' },
        { name: 'Телефон', code: 'phone' },
        { name: 'Основной', code: 'is_main', type: 'yes-no'  },
      ],
      fields: [
        {
          name: 'name',
          title: 'Название',
          type: 'text',
          model: '',
          required: true,
        },
        {
          name: 'slug',
          title: 'Code',
          type: 'text',
          model: '',
          required: true,
        },
        {
          name: 'address',
          title: 'Адрес',
          type: 'text',
          model: '',
        },
        {
          name: 'map_link',
          title: 'Ссылка на карту',
          type: 'text',
          model: '',
        },
        {
          name: 'is_main',
          title: 'Основной',
          type: 'select-yes-no',
          model: 'N',
        },
      ],
    }
  },
  components: {
    ListTemplate,
  },
};
</script>
<style></style>
