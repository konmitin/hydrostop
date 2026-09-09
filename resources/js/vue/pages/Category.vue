<template lang="">
    <div>
        <PageTemplate :tabs="this.tabs" title='Категория' apiName="categories" 
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
        }
      ],
      sections: {
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
              slug: {
                key: {
                  data: 'slug',
                  view: 'slug',
                },
                title: 'Код',
                type: 'text'
              }
            }
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