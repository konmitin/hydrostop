<template>
  <div class="flex flex-col gap-4">
    <div
      class="flex flex-col max-w-76 gap-2 py-2 text-gray-900 w-full border-b border-t border-transparent hover:border-orange-600"
    >
      <h4>{{ this.property.name }}</h4>

      <div class="flex h-full items-center gap-4">
        <InputTextPage
          @input="this.$emit('edit', this.property)"
          v-model="this.property.value"
          :name="this.property.name.toLowerCase() + this.property.id"
          class="w-full"
          placeholder="Введите значение"
        />

        <div
          @click="
            this.hidden();
            this.$emit('hidden');
          "
          class="flex bg-blue-600 h-full p-2 rounded-lg cursor-pointer"
        >
          <label class="flex h-full items-center gap-1 cursor-pointer">
            <input
              type="radio"
              :name="
                this.property.name.toLowerCase() + this.property.property_id
              "
              class="hidden"
            />
            <span class="text-sm text-center w-full text-white">
              <i class="fa fa-eye-slash"></i>
            </span>
          </label>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  emits: ["edit", "hidden"],
  data() {
    return {};
  },
  props: {
    name: {
      type: String,
      default: "",
    },
    property: {
      type: Object,
      default: {},
    },
  },
  created() {},
  methods: {
    hidden() {
      this.property.is_hidden = "Y";
      this.$emit("edit", this.property);
    },
  },
};
</script>
<style scoped>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="number"] {
  -moz-appearance: textfield;
}

.property-radio-green:checked + span {
  background-color: var(--color-green-600);
  border-color: var(--color-green-600);
}

.property-insert-green {
  border-color: var(--color-green-600);
}

.property-insert-red {
  border-color: var(--color-red-600);
}

.property-radio-deleted:checked + span {
  background-color: var(--color-red-600);
  border-color: var(--color-red-600);
}

.property-radio-red:checked + span {
  background-color: var(--color-red-600);
  border-color: var(--color-red-600);
}

.property-radio-green:checked + span i,
.property-radio-yellow:checked + span i,
.property-radio-gray:checked + span i,
.property-radio-red:checked + span i {
  display: block;
}
</style>
