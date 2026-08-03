<template>
  <TemplateModal
    :title="mode == 'add' ? 'Add' : 'Edit'"
    v-model="this.fields"
    :mode="this.mode"
    :isEdit="isEdit"
    deleteType="delete"
    @delete="$emit('delete', this.fields)"
    @close="$emit('close')"
    @save="$emit(this.mode == 'edit' ? 'save' : 'add', this.fields)"
  >
    <InputTextPage
      @input="this.isEdit = true"
      class="w-full flex-1"
      title="Name"
      v-model="this.fields.name"
      placeholder="Interior test"
    />

    <SelectPage
      @update:model-value="this.isEdit = true"
      label="Group"
      v-model="this.fields.group"
      :options="this.groups"
      :get-option-label="(option) => option.name"
      :get-option-value="(option) => option.id"
    />

    <InputCheckbox
      v-if="this.mode == 'add'"
      @input="
        this.isEdit = true;
        this.fields.value_type = this.fields.isInsert ? 'insert' : 'text';
      "
      class="col-span-2"
      label="Is Insert"
      v-model="this.fields.isInsert"
    />

    <InputNumberPage
      v-if="this.fields.isInsert"
      @input="this.isEdit = true"
      title="Min"
      v-model="this.fields.min"
      placeholder="20"
    />

    <InputNumberPage
      v-if="this.fields.isInsert"
      @input="this.isEdit = true"
      title="Max"
      v-model="this.fields.max"
      placeholder="100"
    />

    <InputTextPage
      v-if="this.fields.isInsert"
      @input="this.isEdit = true"
      title="Default Value"
      v-model="this.fields.default_value"
      placeholder="100"
    />
  </TemplateModal>
</template>

<script>
import InputNumberPage from "../fields/InputNumberPage.vue";
import InputFormatNumber from "../inputs/InputFormatNumber.vue";

export default {
  data() {
    return {
      fields: {
        id: this.test.id ?? 0,
        name: this.test.name ?? "",
        value_type: this.test.value_type ?? "text",
        isInsert: this.test.value_type == "insert" ? true : false,
        min: this.test.insert?.min ?? 0,
        max: this.test.insert?.max ?? 0,
        default_value: this.test.default_value ?? "",
        group: this.test?.group?.id ?? 0,
      },
      groups: [],
      isEdit: this.mode == "edit" ? false : true,
    };
  },
  props: {
    test: {
      type: Object,
      default: {},
    },
    mode: {
      type: String,
      default: "add",
    },
  },
  created() {
    if (this.groups.length <= 0) {
      this.getGroups();
    }
  },
  methods: {
    async getGroups() {
      await axios.get("/tests/groups").then((response) => {
        this.groups = response.data.data;
      });
    },
  },
  emits: ["close", "save", "delete"],
};
</script>

<style scoped></style>
