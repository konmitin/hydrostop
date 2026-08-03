<template>
  <div>
    <PageTemplate title='Город' apiName="branches" :sections="{
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
            code: {
              key: {
                data: 'code',
                view: 'code',
              },
              title: 'Код',
              type: 'text'
            },
            phone: {
              key: {
                data: 'phone',
                view: 'phone',
              },
              title: 'Телефон',
              type: 'phone'
            },
            email: {
              key: {
                data: 'email',
                view: 'email',
              },
              title: 'Электронная почта',
              type: 'email'
            },
            is_main: {
              key: {
                data: 'is_main',
                view: 'is_main',
              },
              title: 'Основной',
              type: 'select-yes-no'
            },
            address: {
              key: {
                data: 'address',
                view: 'address',
              },
              title: 'Адрес',
              type: 'text'
            },
            map_link: {
              key: {
                data: 'map_link',
                view: 'map_link',
              },
              title: 'Ссылка на адрес',
              type: 'text'
            },
            about: {
              key: {
                data: 'about',
                view: 'about',
              },
              title: 'Краткое описание',
              type: 'textarea'
            },
          }
        }
      ]
    }" />
  </div>
</template>
<script></script>
<style scoped></style>
