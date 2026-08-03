<template lang="">
    <div>
        <PageTemplate 
        @edit="this.getClients(); 
        this.getBranches();" title='Пользователь' apiName="users" :objectId="this.objectId"
        :sections="{
          main: [
            {
              name: 'Основное',
              cols: 1,
              fields: {
                name: {
                  key: {
                    data: 'name',
                    view: 'name',
                  },
                  title: 'Имя',
                  type: 'text'
                },
                email: {
                  key: {
                    data: 'email',
                    view: 'email',
                  },
                  title: 'Электронная почта',
                  type: 'email'
                },
                password: {
                  key: {
                    data: 'password',
                    view: 'password',
                  },
                  title: 'Пароль',
                  type: 'password'
                },
              }
            }
          ]
      }" />
    </div>
</template>
<script>
import { reactive } from 'vue';
import PageTemplate from './PageTemplate.vue';

export default {
  components: {
    PageTemplate
  },
  props: {
    objectId: {
      type: Number,
      default: null
    }
  },
  data() {
    return {
      tabs: [],
    }
  },
  created() {
    if (this.user?.id == this.$route.params.id) {

      this.$router.push({ name: 'profile' });
    }
  },
  methods: {

  },
  computed: {
    user() {
      return this.$store.state.user;
    },
  },
}
</script>
<style lang="">

</style>