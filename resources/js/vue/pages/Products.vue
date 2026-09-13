<template>
  <div>
    <ListTemplate apiName="products" pageTitle="Товары" listTitle="Список товаров" :properties="[
      { name: 'Название', code: 'name' },
      { name: 'Позиция', code: 'position' },
      { name: 'Описание', code: 'description' },
      { name: 'Артикул', code: 'sku' },
      { name: 'Цена', code: 'price', type: 'price' },
    ]" :fields="[
      {
        name: 'name',
        title: 'Название',
        type: 'text',
        model: '',
        required: true,
      },
      {
        name: 'position',
        title: 'Позиция',
        type: 'number',
        model: 100,
        required: false,
      },
      {
        name: 'slug',
        title: 'Код',
        type: 'text',
        model: '',
        required: false,
      },
      {
        name: 'price',
        title: 'Цена',
        type: 'number',
        model: '',
        required: true,
      },
      {
        name: 'status_id',
        title: 'Статус',
        type: 'select',
        model: 1,
        values: this.statuses,
        required: true,
      },
      {
        name: 'category_id',
        title: 'Категория',
        type: 'select',
        model: 0,
        values: this.categories,
        required: true,
      },
    ]" :filters="[
      {
        name: 'id',
        title: 'ID',
        type: 'text',
        model: '',
      },
      {
        name: 'name',
        title: 'Название',
        type: 'text',
        model: '',
      },
      {
        name: 'category',
        title: 'Категория',
        type: 'select-multi',
        model: [],
        values: this.categories
      },

    ]" @showFilter="this.getCategories(); this.getStatuses();" @showAddModal="this.getCategories(); this.getStatuses();" />
  </div>
</template>
<script>
import ListTemplate from "./ListTemplate.vue";

export default {
  components: {
    ListTemplate,
  },
  data() {
    return {
      categories: [],
      statuses: [],
    };
  },
  methods: {
    async getCategories() {

      if (this.categories.length > 0) {
        return;
      }

      await axios.get("/api/categories").then((response) => {
        let categories = response.data.data;

        for (const key in categories) {
          if (!Object.hasOwn(categories, key)) continue;

          const category = categories[key];

          this.categories.push({
            label: category.name,
            value: category.id,
          });
        }
      });
    },
    async getStatuses() {

      if (this.statuses.length > 0) {
        return;
      }

      await axios.get("/api/statuses").then((response) => {
        let statuses = response.data.data;

        for (const key in statuses) {
          if (!Object.hasOwn(statuses, key)) continue;

          const status = statuses[key];

          this.statuses.push({
            label: status.name,
            value: status.id,
          });
        }
      });
    },
  },
  watch: {

  }
};
</script>
<style></style>
