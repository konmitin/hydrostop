<template>
  <div class="py-2 flex flex-col gap-4 border-b border-t border-transparent hover:border-orange-600">
    <div class="flex flex-col gap-2 md:flex-row md:gap-8 md:items-center md:justify-between text-gray-900 w-full">

      <div class="flex gap-2">
        <span class="text-sm uppercase w-full md:w-64">{{ this.test.name }}</span>

        <div class="md:hidden">
          <label class="flex items-center gap-1 cursor-pointer hover:underline">
            <input @click="
              doEdit('hidden');
            this.showComment = false;
            this.$emit('hidden');
            " :checked="this.test.type == 'hidden'" type="radio" :name="this.test.name.toLowerCase() + this.test.id"
              class="hidden" />
            <span class="text-sm underline text-orange-600">Hide</span>
          </label>
        </div>
      </div>

      <div class="flex w-48 items-center justify-between gap-4">
        <label v-if="this.test.default_value == 'no'" class="flex items-center gap-1 uppercase cursor-pointer">
          <input @click="
            this.showComment = false;
          doEdit('no');
          " :checked="this.test.type == 'no'" type="radio" :name="this.test.name.toLowerCase() + this.test.id"
            class="hidden test-radio-green" />
          <span class="w-5 h-5 rounded-full border-2 border-gray-500 flex items-center justify-center">
            <i class="fas fa-check text-white hidden text-xs"></i>
          </span>
          <span class="text-sm ml-1">NO</span>
        </label>
        <label v-if="this.test.default_value == 'ok'" class="flex items-center gap-1 uppercase cursor-pointer">
          <input @click="
            this.showComment = false;
          doEdit('ok');
          " :checked="this.test.type == 'ok'" type="radio" :name="this.test.name.toLowerCase() + this.test.id"
            class="hidden test-radio-green" />
          <span class="w-5 h-5 rounded-full border-2 border-gray-500 flex items-center justify-center">
            <i class="fas fa-check text-white hidden text-xs"></i>
          </span>
          <span class="text-sm ml-1">OK</span>
        </label>
        <label class="flex items-center gap-1 uppercase cursor-pointer">
          <input @click="
            this.showComment = true;
          doEdit('attention');
          " :checked="this.test.type == 'attention'" type="radio" :name="this.test.name.toLowerCase() + this.test.id"
            class="hidden test-radio-red" />
          <span class="w-5 h-5 rounded-full border-2 border-gray-500 flex items-center justify-center">
            <i class="fas fa-check text-white hidden text-xs"></i>
          </span>
          <span class="text-sm ml-1">Attention</span>
        </label>
      </div>

      <div class="hidden md:block">
        <label class="flex items-center gap-1 cursor-pointer hover:underline">
          <input @click="
            doEdit('hidden');
          this.showComment = false;
          this.$emit('hidden');
          " :checked="this.test.type == 'hidden'" type="radio" :name="this.test.name.toLowerCase() + this.test.id"
            class="hidden" />
          <span class="text-sm">Hide</span>
        </label>
      </div>
    </div>

    <textarea @input="doEdit()" v-show="this.showComment" v-model="this.comment" type="text" placeholder="Comment"
      class="w-full min-h-48 md:min-h-none input-field border border-gray-700 rounded-md px-3 py-2 text-sm !text-gray-800 placeholder-gray-500 focus:outline-none focus:border-blue-500"></textarea>
  </div>
</template>
<script>
export default {
  emits: ["edit", "hidden"],
  data() {
    return {
      comment: this.test.comment ?? "",
      type:
        this.test.value_type == "text"
          ? (this.test.type ?? this.test.default_value)
          : "insert",
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
    if (!this.test.type) {
      this.doEdit(this.test.default_value);
    }
  },
  methods: {
    doEdit(type = this.test.type) {
      this.test.type = type;
      this.test.comment = this.comment;
      this.$emit("edit", this.test);
    },
  },
  computed: {
    showComment() {
      return this.test.type == "ok" ||
        (this.test.type ?? "") == "" ||
        this.test.type == "empty" ||
        this.test.type == "no"
        ? false
        : true;
    },
  },
};
</script>
<style scoped>
.test-radio-green:checked+span {
  background-color: var(--color-green-600);
  border-color: var(--color-green-600);
}

.test-radio-yellow:checked+span {
  background-color: var(--color-yellow-600);
  border-color: var(--color-yellow-600);
}

.test-radio-deleted:checked+span {
  background-color: var(--color-red-600);
  border-color: var(--color-red-600);
}

.test-radio-red:checked+span {
  background-color: var(--color-red-600);
  border-color: var(--color-red-600);
}

.test-radio-green:checked+span i,
.test-radio-yellow:checked+span i,
.test-radio-gray:checked+span i,
.test-radio-red:checked+span i {
  display: block;
}
</style>
