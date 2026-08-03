<template>
  <div>
    <ListTemplate apiName="users" pageTitle="Пользователи" listTitle="Список пользователей" :properties="[
      { name: 'Имя', code: 'name' },
      { name: 'Электронная почта', code: 'email' },
    ]" :fields="[
      {
        name: 'name',
        title: 'Имя',
        type: 'text',
        model: '',
        required: true,
      },
      {
        name: 'email',
        title: 'Электронная почта',
        type: 'email',
        model: '',
        required: true,
      },
      {
        name: 'password',
        title: 'Пароль',
        type: 'password',
        model: '',
        required: true,
      },
    ]" :filters="{
      id: {
        title: 'ID',
        type: 'text',
        model: '',
      },
      name: {
        title: 'Имя',
        type: 'text',
        model: '',
      },
    }" />
  </div>
</template>
<script>
import { ref } from "vue";
import ListTemplate from "./ListTemplate.vue";

export default {
  data() {
    return {
    }
  },
  components: {
    ListTemplate,
  }, methods: {
  },
};
</script>
<style></style>
