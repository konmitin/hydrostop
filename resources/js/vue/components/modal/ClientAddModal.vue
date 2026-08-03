<template>
  <TemplateModal
    v-model="this.fields"
    :mode="this.mode"
    :isEdit="isEdit"
    @close="$emit('close')"
    @save="$emit(this.mode == 'edit' ? 'save' : 'add', this.fields)"
  >
    <InputText
      @input="this.isEdit = true"
      class="w-full flex-1"
      label="Name"
      name="name"
      v-model="this.fields.name"
      placeholder="John"
    ></InputText>
    
    <InputText
      @input="this.isEdit = true"
      class="w-full flex-1"
      label="Last Name"
      name="last_name"
      v-model="this.fields.last_name"
      placeholder="John"
    ></InputText>

    <InputText
      @input="this.isEdit = true"
      class="w-full flex-1"
      label="Email"
      type="email"
      name="email"
      v-model="this.fields.email"
      placeholder="example@example.ru"
    ></InputText>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">
        Phone
      </label>
      <InputPhone
        @update:model-value="this.isEdit = true"
        v-model="this.fields.phone"
        placeholder="(123) 456-78-90"
        class="w-full input-field rounded-sm px-4 py-3 text-gray-900"
        required
      ></InputPhone>
    </div>

    <InputPassword
      @input="this.isEdit = true"
      class="w-full flex-1"
      label="Password"
      v-model="this.fields.password"
      placeholder="password"
    ></InputPassword>

    <InputPassword
      @input="this.isEdit = true"
      class="w-full flex-1"
      label="Confirm Password"
      name="confirm-password"
      v-model="this.fields.confirm_password"
      placeholder="Confirm password"
    ></InputPassword>
  </TemplateModal>
</template>

<script>
export default {
  data() {
    return {
      fields: {
        name: this.client?.name ?? "",
        last_name: this.client?.last_name ?? "",
        phone: this.client?.phone ?? "",
        email: this.client?.email ?? "",
        password: this.client?.password ?? "",
        confirm_password: this.client?.confirm_password ?? "",
      },
      isEdit: this.mode == "edit" ? false : true,
    };
  },
  props: {
    client: {
      type: Object,
      default: {},
    },
    mode: {
      type: String,
      default: "add",
    },
  },
  created() {},
  methods: {},
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
