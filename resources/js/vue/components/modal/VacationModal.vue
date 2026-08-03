<template>
  <TemplateModal
    :isEdit="this.isEdit"
    :title="mode == 'add' ? 'Add vacation' : 'Edit vacation'"
    v-model="this.fields"
    :mode="this.mode"
  >
    <InputText
      @input="this.isEdit = true"
      class="w-full flex-1"
      label="Name"
      v-model="this.fields.name"
      placeholder="Vacation name"
    ></InputText>

    <Select
      v-if="this.place != 'inProfile'"
      @optionSelected="this.isEdit = true"
      label="Inspector"
      v-model="this.fields.inspector.id"
      :options="this.inspectors"
      :get-option-label="(option) => option.name + ' ' + (option.last_name ?? '') + ' #' + option.id"
      :get-option-value="(option) => option.id"
    ></Select>

    <InputDate
      @input="this.isEdit = true"
      label="Start"
      v-model="this.fields.start_at"
    ></InputDate>

    <InputDate
      @input="this.isEdit = true"
      label="End"
      v-model="this.fields.end_at"
    ></InputDate>
  </TemplateModal>
</template>

<script>
import { VueDatePicker } from "@vuepic/vue-datepicker";
import InputDate from "../inputs/InputDate.vue";

export default {
  components: {
    InputDate,
  },
  data() {
    return {
      fields: {
        id: this.vacation?.id ?? 0,
        name: this.vacation?.name ?? "",
        start_at: this.vacation?.start_at ?? "",
        end_at: this.vacation?.end_at ?? "",
        inspector: this.vacation?.inspector ?? this.inspector ?? {},
      },
      inspectors: [],
      isEdit: this.mode == "edit" ? false : true,
    };
  },
  props: {
    vacation: {
      type: Object,
      default: {},
    },
    inspector: {
      type: Object,
      default: {},
    },
    mode: {
      type: String,
      default: "add",
    },
    place: {
      type: String,
      default: "",
    },
  },
  created() {
    this.getInspectors();
  },
  methods: {
    async getInspectors() {
      await axios.get("/users").then((response) => {
        this.inspectors = response.data.data;
      });
    },
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
