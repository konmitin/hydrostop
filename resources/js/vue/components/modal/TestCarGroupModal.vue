<template>
  <TemplateModal
    :title="mode == 'add' ? 'Add group' : 'Edit group'"
    v-model="this.fields"
    :isEdit="this.isEdit"
    :mode="this.mode"
    titleDelete="Delete"
    deleteType="delete"
  >
    <InputText
      class="w-full flex-1"
      label="Name"
      v-model="this.fields.name"
      @input="this.updateValues()"
      placeholder="Engine"
      required="required"
    ></InputText>

    <Select
      @update:model-value="this.updateValues()"
      label="Type"
      v-model="this.fields.type_id"
      :options="this.types"
      :get-option-label="(option) => option.name"
      :get-option-value="(option) => option.id"
      :isRequired="true"
      placeholder="Select type group"
    ></Select>
  </TemplateModal>
</template>

<script>
export default {
  data() {
    return {
      fields: {
        id: this.group?.id ?? 0,
        name: this.group?.name ?? "",
        type_id: this.group?.type_id ?? "",
        deleted:
          this.group?.deleted && this.group?.deleted == "Y" ? true : false,
      },
      types: [],
      isEdit: this.mode == "edit" ? false : true,
    };
  },
  props: {
    group: {
      type: Object,
      default: null,
    },
    mode: {
      type: String,
      default: "add",
      validator: (value) => ["add", "edit"].includes(value),
    },
  },
  async created() {
    await this.getTypes();
  },
  methods: {
    async getTypes() {
      await axios.get("/tests/groups/types").then((response) => {
        this.types = response.data.data;
      });
    },
    updateValues() {
      this.isEdit = true;
    }
  },
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
