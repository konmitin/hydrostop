<template>
  <TemplateModal deleteType="delete" :isEdit="this.isEdit" :title="mode == 'add' ? 'Add new' : (this.transmission.name + ' #' + this.transmission.id )" v-model="this.fields"
    :mode="this.mode">
    <InputTextPage @input="this.isEdit = true" class="w-full flex-1" title="Name" v-model="this.fields.name"
      placeholder="Vacation name"></InputTextPage>
  </TemplateModal>
</template>

<script>

export default {
  components: {
  },
  data() {
    return {
      fields: {
        id: this.transmission?.id ?? 0,
        name: this.transmission?.name ?? "",
      },
      inspectors: [],
      isEdit: this.mode == "edit" ? false : true,
    };
  },
  props: {
    transmission: {
      type: Object,
      default: {},
    },
    mode: {
      type: String,
      default: "",
    },
  },
  created() {
  },
  methods: {},
  emits: [],
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
