<template>
  <div>
    <ListTemplate apiName="sertificates" pageTitle="Сертификаты и документы"
      listTitle="Список сертификатов и документов" :properties="this.properties" :filters="this.filters" :fields="[
        {
          name: 'name',
          title: 'Название',
          type: 'text',
          model: '',
          required: true,
        },
        {
          name: 'description',
          title: 'Описание',
          type: 'textarea',
          model: ''
        },
        {
          name: 'position',
          title: 'Позиция',
          type: 'number',
          model: 0
        },
        {
          name: 'type',
          title: 'Тип',
          type: 'select',
          model: 0,
          values: [{ 'label': 'Документ', value: 'document' }]
        },
        {
          name: 'preview',
          title: 'Картинка анонс',
          type: 'file',
          typeForModel: 'preview',
          accept: '.png, .jpeg, .jpg',
          model: []
        },
        {
          name: 'file',
          title: 'Файл для скачивания',
          type: 'file-multi',
          typeForModel: 'document',
          accept: '.pdf',
          model: []
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
        { name: 'Название', code: 'name' },
        { name: 'Описание', code: 'description' },
        { name: 'Позиция', code: 'position' }
      ]
    }
  },
  components: {
    ListTemplate,
  }, methods: {},
};
</script>
<style></style>
