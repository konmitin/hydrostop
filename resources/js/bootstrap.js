import axios from './vue/axios';
import VueCookies from 'vue-cookies'
import { createApp } from 'vue';
import Admin from './vue/Admin.vue';
import router from './vue/router';
import store from './vue/store';
import "vue3-select-component/styles"

import { VueDatePicker } from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

//  Components
import LeftAside from './vue/components/LeftAside.vue';
import HeaderPanel from './vue/components/HeaderPanel.vue';
import MenuView from './vue/components/menu/MenuView.vue';
import MenuGroup from './vue/components/menu/MenuGroup.vue';
import MenuItem from './vue/components/menu/MenuItem.vue';
import Wrapper from './vue/components/Wrapper.vue';
import ButtonLogout from './vue/components/buttons/ButtonLogout.vue';
import ButtonPrimary from './vue/components/buttons/ButtonPrimary.vue';
import ButtonSecondary from './vue/components/buttons/ButtonSecondary.vue';
import HeaderFilters from './vue/components/HeaderFilters.vue';

import VueSelect from "vue3-select-component";
import InputText from "./vue/components/inputs/InputText.vue";
import InputPhone from "./vue/components/inputs/InputPhone.vue";
import InputFormatNumber from "./vue/components/inputs/InputFormatNumber.vue";
import InputPassword from "./vue/components/inputs/InputPassword.vue";
import Select from "./vue/components/inputs/Select.vue";
import TemplateModal from "./vue/components/modal/TemplateModal.vue";

import TablePrimary from "./vue/components/TablePrimary.vue";
import TableRowPrimary from "./vue/components/TableRowPrimary.vue";
import TableColumnPrimary from "./vue/components/TableColumnPrimary.vue";
import ButtonTableDelete from "./vue/components/buttons/ButtonTableDelete.vue";
import ButtonTableEdit from "./vue/components/buttons/ButtonTableEdit.vue";

import ButtonTableView from './vue/components/buttons/ButtonTableView.vue';
import MainPage from './vue/components/pages/MainPage.vue';
import HeaderPage from './vue/components/pages/HeaderPage.vue';
import Template from './vue/components/modal/right/Template.vue';
import Header from './vue/components/modal/right/Header.vue';
import FieldPage from './vue/components/fields/FieldPage.vue';
import Section from './vue/components/pages/Section.vue';
import SelectPage from './vue/components/fields/SelectPage.vue';
import InputTextPage from './vue/components/fields/InputTextPage.vue';
import InputPhonePage from './vue/components/fields/InputPhonePage.vue';
import InputNumberPage from './vue/components/fields/InputNumberPage.vue';
import Sections from './vue/components/pages/Sections.vue';
import TabsView from './vue/components/pages/TabsView.vue';
import Tab from './vue/components/pages/Tab.vue';
import InputDate from './vue/components/inputs/InputDate.vue';
import InputCheckbox from './vue/components/inputs/InputCheckbox.vue';
import InputDatePage from './vue/components/fields/InputDatePage.vue';
import ButtonSection from './vue/components/buttons/ButtonSection.vue';
import PageTemplate from './vue/pages/PageTemplate.vue';
import InputFilePage from './vue/components/fields/InputFilePage.vue';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const adminApp = createApp(Admin);
adminApp.use(VueCookies)
adminApp.use(router);
adminApp.use(store);
adminApp.mount('#app');

adminApp.component('wrapper', Wrapper);
adminApp.component('PageTemplate', PageTemplate);
adminApp.component('MainPage', MainPage);
adminApp.component('HeaderPage', HeaderPage);
adminApp.component('left-aside', LeftAside);
adminApp.component('menu-view', MenuView);
adminApp.component('menu-group', MenuGroup);
adminApp.component('menu-item', MenuItem);
adminApp.component('header-panel', HeaderPanel);
adminApp.component('HeaderFilters', HeaderFilters);
adminApp.component('button-logout', ButtonLogout);
adminApp.component('ButtonSection', ButtonSection);
adminApp.component('ButtonPrimary', ButtonPrimary);
adminApp.component('ButtonSecondary', ButtonSecondary);

adminApp.component('FieldPage', FieldPage);
adminApp.component('Tab', Tab);
adminApp.component('TabsView', TabsView);
adminApp.component('SectionsPage', Sections);
adminApp.component('SectionPage', Section);
adminApp.component('SelectPage', SelectPage);
adminApp.component('InputTextPage', InputTextPage);
adminApp.component('InputPhonePage', InputPhonePage);
adminApp.component('InputNumberPage', InputNumberPage);
adminApp.component('InputFilePage', InputFilePage);


adminApp.component('VueSelect', VueSelect);
adminApp.component('VueDatePicker', VueDatePicker);
adminApp.component('InputDate', InputDate);
adminApp.component('InputCheckbox', InputCheckbox);
adminApp.component('InputDatePage', InputDatePage);
adminApp.component('InputText', InputText);
adminApp.component('InputPhone', InputPhone);
adminApp.component('InputFormatNumber', InputFormatNumber);
adminApp.component('InputPassword', InputPassword);
adminApp.component('Select', Select);
adminApp.component('TemplateModal', TemplateModal);

adminApp.component('TemplateRight', Template);
adminApp.component('HeaderRight', Header);

adminApp.component('TablePrimary', TablePrimary);
adminApp.component('TableRowPrimary', TableRowPrimary);
adminApp.component('TableColumnPrimary', TableColumnPrimary);








