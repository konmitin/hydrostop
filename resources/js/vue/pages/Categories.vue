<template>
  <div>
    <ListTemplate :properties="[{ name: 'Название', code: 'name' }]" apiName="categories" pageTitle="Категории"
      listTitle="Список категорий" :filters="[
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
      ]" :fields="this.fields" />
  </div>
</template>
<script>
import ListTemplate from "./ListTemplate.vue";

export default {
  data() {
    return {
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
          title: 'Код',
          type: 'text',
          model: '',
          required: false,
        },
      ]
    }
  },
  components: {
    ListTemplate,
  },
  watch: {
    // fields: {
    //   handler(fields) {
    //     this.fields = fields;
    //   },
    //   deep: true
    // }
  }
};
</script>
<style></style>
