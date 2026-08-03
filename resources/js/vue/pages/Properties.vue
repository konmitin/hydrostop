<template>
  <div>
    <ListTemplate :isLinked="false" :properties="this.properties" apiName="properties" pageTitle="Характеристики"
      listTitle="Список характеристик" :fields="[
        {
          name: 'name',
          title: 'Название',
          type: 'text',
          model: '',
          required: true,
        },
      ]" />
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
      properties: [{ name: 'Название', code: 'name' }]
    }
  }
};
</script>
<style></style>
