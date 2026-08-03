<template>
  <TemplateModal
    :title="this.title"
    v-model="this.fields"
    mode="edit"
    :isEdit="true"
    :isCancel="true"
    @save="this.$emit('save', this.filters)"
    @cancel="this.$emit('cancel', {})"
  >
    <template v-for="(filter, index) in this.filters" :key="index">
      <InputTextPage
        v-if="filter.type == 'text'"
        :title="filter.title"
        v-model="filter.model"
        :placeholder="filter.title"
        :isRequired="false"
      />

      <InputPhonePage
        v-if="filter.type == 'phone'"
        :title="filter.title"
        v-model="filter.model"
      />

      <SelectPage
        v-if="filter.type == 'select'"
        :label="filter.title"
        v-model="filter.model"
        :options="filter.values"
        :isRequired="false"
      />

      <SelectPage
        class="col-span-2"
        v-if="filter.type == 'select-multi'"
        :label="filter.title"
        v-model="filter.model"
        :options="filter.values"
        :is-multi="true"
      />
    </template>
  </TemplateModal>
</template>

<script>
import InputPhone from "../inputs/InputPhone.vue";

export default {
  components: {
    InputPhone,
  },
  data() {
    return {
      fields: {},
    };
  },
  props: {
    title: {
      type: String,
      default: "Фильтр",
    },
    filters: {
      type: Object,
      default: {},
    },
  },
  created() {},
  methods: {},
  emits: ["save", "cancel"],
};
</script>

<style scoped>
.input-field {
  transition: all 0.3s ease;
  background-color: #f9fafb;
  border: 1px solid #e5e7eb;
}

.input-field:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  outline: none;
  background-color: white;
}

.modal-overlay {
  background-color: rgba(0, 0, 0, 0.5);
  transition: all 0.3s ease;
}

.modal-content {
  animation: modalFadeIn 0.3s ease forwards;
}

@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }

  to {
    opacity: 1;
    transform: scale(1);
  }
}

.btn-primary {
  background: linear-gradient(to right, #3b82f6, #2563eb);
  color: white;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background: linear-gradient(to right, #2563eb, #1d4ed8);
  transform: translateY(-1px);
  box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
}
</style>
