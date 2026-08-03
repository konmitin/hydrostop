<template>
  <div class="flex flex-col gap-4">
    <div
      class="flex flex-col gap-2 justify-between md:flex-row md:gap-8 text-gray-900 w-full border-b border-t border-transparent hover:border-orange-600"
    >
      <div class="flex gap-2">
        <span class="text-sm uppercase w-full md:w-64">
          {{ this.test.name }}
        </span>

        <div class="md:hidden">
          <label class="flex items-center gap-1 cursor-pointer hover:underline">
            <input
              @click="
                doEdit('hidden');
                this.showComment = false;
                this.$emit('hidden');
              "
              :checked="this.test.type == 'hidden'"
              type="radio"
              :name="this.test.name.toLowerCase() + this.test.id"
              class="hidden"
            />
            <span class="text-sm underline text-orange-600">Hide</span>
          </label>
        </div>
      </div>

      <div class="flex w-48 items-center gap-4">
        <label class="flex items-center gap-1 cursor-pointer">
          <input
            @input="this.insertValue()"
            v-model="this.test.value"
            type="number"
            :name="this.test.name.toLowerCase() + this.test.id"
            :placeholder="this.test.default_value"
            :class="{
              'test-insert-green':
                this.test.type == 'force-ok' || this.test.type == 'ok',
              'test-insert-red': this.test.type == 'attention',
            }"
            class="w-18 bg-gray-900 border test-insert-green rounded-md px-3 py-1 text-sm text-gray-300 placeholder-gray-500 focus:outline-none focus:border-blue-500"
          />
        </label>
        <label class="flex items-center gap-1 cursor-pointer">
          <input
            @click="
              this.test.type == 'force-ok'
                ? this.doEdit('insert')
                : this.doEdit('force-ok')
            "
            :checked="this.test.type == 'force-ok'"
            type="radio"
            :name="this.test.name.toLowerCase() + this.test.id"
            :class="{
              hidden: true,
              'test-radio-green': this.test.type == 'force-ok',
            }"
          />
          <span
            class="w-5 h-5 rounded-full border-2 border-gray-500 flex items-center justify-center"
          >
            <i class="fas fa-check text-white hidden text-xs"></i>
          </span>
          <span class="text-sm ml-1">FORCE OK</span>
        </label>
      </div>

      <div class="hidden md:block">
        <label class="flex items-center gap-1 cursor-pointer hover:underline">
          <input
            @click="
              this.doEdit('hidden');
              this.showComment = false;
              this.$emit('hidden');
            "
            :checked="this.test.type == 'hidden'"
            type="radio"
            :name="this.test.name.toLowerCase() + this.test.id"
            class="hidden"
          />
          <span class="text-sm">Hide</span>
        </label>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  emits: ["edit", "hidden"],
  data() {
    return {
      comment: this.test.comment ?? "",
      type: this.test.type ?? "ok",
      showComment:
        this.test.type == "ok" ||
        (this.test.type ?? "") == "" ||
        this.test.type == "empty" ||
        this.test.type == "no"
          ? false
          : true,
    };
  },
  props: {
    name: {
      type: String,
      default: "",
    },
    test: {
      type: Object,
      default: {},
    },
  },
  created() {
    if (!this.test.value && this.test.value_type == "insert") {
      this.test.value = Number(this.test.default_value);
      this.insertValue();
    }
  },
  methods: {
    doEdit(type = this.type) {
      this.type = type;
      this.test.type = type;
      this.test.comment = this.comment;
      this.$emit("edit", this.test);
    },
    insertValue() {
      let type = "ok";

      if (
        this.test.group.name.toLowerCase() == "paint depth analysis" &&
        this.test.value_type == "insert"
      ) {
        if (this.test.value < this.test.default_value) {
          type = "ok";
        } else if (this.test.value > this.test.default_value) {
          type = "attention";
        }
      } else if (
        this.test.name.toLowerCase() == "mileage since last code erase"
      ) {
        if (this.test.value < this.test.default_value) {
          type = "attention";
        } else if (this.test.value >= this.test.default_value) {
          type = "ok";
        }
      } else if (this.test.name.search("Fuel Trim") >= 0) {
        if (this.test.value > this.test.default_value) {
          type = "attention";
        } else if (this.test.value <= this.test.default_value) {
          type = "ok";
        }
      } else {
        console.log(this.test.value);
        type =
          this.test.value > this.test.insert.max ||
          this.test.value < this.test.insert.min
            ? "attention"
            : "ok";
      }

      if (this.test.type == "force-ok") {
        type = "force-ok";
      }

      this.doEdit(type);
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

.test-radio-green:checked + span {
  background-color: var(--color-green-600);
  border-color: var(--color-green-600);
}

.test-insert-green {
  border-color: var(--color-green-600);
}

.test-insert-red {
  border-color: var(--color-red-600);
}

.test-radio-deleted:checked + span {
  background-color: var(--color-red-600);
  border-color: var(--color-red-600);
}

.test-radio-red:checked + span {
  background-color: var(--color-red-600);
  border-color: var(--color-red-600);
}

.test-radio-green:checked + span i,
.test-radio-yellow:checked + span i,
.test-radio-gray:checked + span i,
.test-radio-red:checked + span i {
  display: block;
}
</style>
