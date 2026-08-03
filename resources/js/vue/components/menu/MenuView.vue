<template>
  <nav class="flex flex-col gap-4 flex-1 py-6 px-4 overflow-y-auto">
    <menu-group title="Заказы и заявки" activeGroup="orders">
      <menu-item :showTitle="this.showTitle" icon="fa-basket-shopping" title="Заказы" link="/h-admin/orders"
        activeTab="orders" />
      <menu-item :showTitle="this.showTitle" icon="fa-cookie" title="Заявки" link="/h-admin/calls" activeTab="orders" />
      <menu-item :showTitle="this.showTitle" icon="fa-basket-shopping" title="Клиенты" link="/h-admin/clients"
        activeTab="clients" />
    </menu-group>
    <menu-group title="Товары и категории" activeGroup="orders">
      <menu-item :showTitle="this.showTitle" icon="fa-basket-shopping" title="Товары" link="/h-admin/products"
        activeTab="orders" />
      <menu-item :showTitle="this.showTitle" icon="fa-cookie" title="Категории" link="/h-admin/categories"
        activeTab="orders" />
    </menu-group>
    <menu-group title="Настройки" activeGroup="orders">
      <menu-item :showTitle="this.showTitle" icon="fa-users" title="Пользователи" link="/h-admin/users"
        activeTab="users" />
      <menu-item :showTitle="this.showTitle" icon="fa-building" title="Реквизиты компании" link="/h-admin/company"
        activeTab="company" />
      <menu-item :showTitle="this.showTitle" icon="fa-file-contract" title="Сертификаты и документы"
        link="/h-admin/sertificates" activeTab="sertificates" />
      <menu-item :showTitle="this.showTitle" icon="fa-city" title="Города" link="/h-admin/branches"
        activeTab="branches" />
      <menu-item :showTitle="this.showTitle" icon="fa-chart-bar" title="Свойства товаров" link="/h-admin/properties"
        activeTab="properties" />
      <!-- <menu-item :showTitle="this.showTitle" icon="fa-gear" title="Параметры" link="/h-admin/settings"
        activeTab="settings" /> -->


    </menu-group>
  </nav>
</template>

<script>
export default {
  components: {},
  data() { },
  props: {
    showTitle: {
      type: Boolean,
      default: true,
    },
  },
};
</script>
