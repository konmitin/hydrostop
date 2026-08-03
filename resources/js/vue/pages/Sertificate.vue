<template lang="">
    <div>
        <PageTemplate :tabs="this.tabs" title='Сертификат' apiName="sertificates" 
        :sections="this.sections" :isDeletable="true" />
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
            name: 'Анонс',
            type: 'file',
            path: 'preview',
            options: {
              accept: 'image/*'
            },
          },
          {
            name: 'Основное',
            cols: 1,
            type: 'fields',
            fields: {
              name: {
                key: {
                  data: 'name',
                  view: 'name',
                },
                title: 'Имя',
                type: 'text'
              },
              position: {
                key: {
                  data: 'position',
                  view: 'position',
                },
                title: 'Позиция',
                type: 'number'
              },
              description: {
                key: {
                  data: 'description',
                  view: 'description',
                },
                title: 'Описание',
                type: 'textarea'
              },
            }
          },
          {
            name: 'файл для скачивания',
            type: 'file',
            options: {
              accept: '.pdf, .docx'
            },
            path: 'file'
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