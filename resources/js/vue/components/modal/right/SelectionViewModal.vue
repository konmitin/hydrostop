<template lang>
  <TemplateRight @close="$emit('close')">
    <HeaderRight @close="$emit('close')" @edit="
      this.$emit('edit');
    this.isEdit = true;
    " @saveNumber="(number) => this.saveNumber(number)" @save="this.save()" :isEdit="this.isEdit"
      :editableNumber="true" :title="`Selection #${this.selection.order.number}`"
      :number="this.selection.order.number">
      <template #subtitle>
        <span>
          {{
            new Date(this.selection.order.created_at).toLocaleString("en-US", {
              year: "numeric",
              month: "long",
              day: "numeric",
            }) +
            " · " +
            new Date(this.selection.order.created_at).toLocaleString("en-US", {
              hour: "numeric",
              minute: "numeric",
            })
          }}
        </span>
      </template>

      <template #buttons></template>
    </HeaderRight>

    <MainPage>
      <div class="space-y-6">
        <div class="flex w-full items-center gap-0">
          <template v-for="(status, index) in this.orderStatuses" :key="index">
            <button @click="
              this.selection.order.status.id = status.id;
            this.saveStatus();
            " v-if="status.type == 'payment'" :class="{
              'bg-yellow-600': status.id == this.selection.order.status.id,
              'bg-gray-600': status.id != this.selection.order.status.id,
            }"
              class="w-full h-10 px-5 rounded-l-md cursor-pointer hover:bg-yellow-600 flex items-center justify-center text-white hover:text-white transition">
              {{ status.name }}
            </button>
            <button @click="
              this.selection.order.status.id = status.id;
            this.saveStatus();
            " v-if="status.type == 'progress'" :class="{
              'bg-blue-600': status.id == this.selection.order.status.id,
              'bg-gray-600': status.id != this.selection.order.status.id,
            }"
              class="w-full h-10 px-5 cursor-pointer hover:bg-blue-600 flex items-center justify-center text-white hover:text-white transition">
              {{ status.name }}
            </button>
            <button @click="
              this.selection.order.status.id = status.id;
            this.saveStatus();
            " v-if="status.type == 'success'" :class="{
              'bg-green-600': status.id == this.selection.order.status.id,
              'bg-gray-600': status.id != this.selection.order.status.id,
            }"
              class="w-full h-10 px-5 cursor-pointer hover:bg-green-600 flex items-center justify-center text-white hover:text-white transition">
              {{ status.name }}
            </button>
            <button @click="
              this.selection.order.status.id = status.id;
            this.saveStatus();
            " v-if="status.type == 'fail'" :class="{
              'bg-red-600': status.id == this.selection.order.status.id,
              'bg-gray-600': status.id != this.selection.order.status.id,
              'rounded-r-md': true,
            }"
              class="w-full h-10 px-5 cursor-pointer rounded-r-md hover:bg-red-600 flex items-center justify-center text-white hover:text-white transition">
              {{ status.name }}
            </button>
          </template>
        </div>

        <!-- TEST GROUPS -->
        <SelectionTabsViewModal :isEdit="this.isEdit" v-model="this.selection"
          v-model:vehicles="this.selection.vehicles" @edit="isEdit = true" @addVehicle="$emit('addVehicle')"
          @addPayment="$emit('addPayment')" @saveDocsSuccess="$emit('saveDocsSuccess')"></SelectionTabsViewModal>
      </div>
    </MainPage>
  </TemplateRight>
</template>

<script>
import SelectionTabsViewModal from "./SelectionTabsViewModal.vue";

import { useGlobalNotification } from "../../../composables/globalNotification.js";
const { showNotify } = useGlobalNotification();

export default {
  components: {
    SelectionTabsViewModal,
  },
  data() {
    return {
      orderStatuses: [],
      isEdit: false,
      isShowAddVehicle: false,
      isPayment: this.selection.order.is_payment == "Y" ? true : false,
    };
  },
  props: {
    selection: {
      type: Object,
      default: {},
    },
  },
  emits: ["close", "edit", "addVehicle", "addPayment", "save"],
  created() {
    this.getOrderStatuses();
  },
  methods: {
    async getOrderStatuses() {
      await axios.get("/order/statuses").then((response) => {
        this.orderStatuses = response.data.data;
      });
    },

    async save() {
      let object = {};

      Object.assign(object, this.selection);

      let currentTimezoneOffset = new Date().getTimezoneOffset();
      let inspectionDate = new Date(object.inspection_date);
      inspectionDate.setTime(
        inspectionDate.getTime() + currentTimezoneOffset * 60 * 1000,
      );
      object.inspection_date = inspectionDate.toLocaleString("en-US", {
        year: "numeric",
        month: "numeric",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
      });

      await axios
        .post("/selection/save", { selection: object })
        .then((res) => {
          this.$emit("save", res.data.data);
          this.isEdit = false;
        })
        .catch((error) => {
          let data = error.response.data;
          for (const key in data.errors) {
            if (!Object.hasOwn(data.errors, key)) continue;

            const error = data.errors[key];


            showNotify(error[0], 'error', 3000);
          }
        });
    },
    async saveStatus() {
      await axios
        .post("/order/status/save", { order: this.selection.order })
        .then((res) => {
          // console.log(res);

          this.selection.order.status = res.data.data;
        })
        .catch((res) => {
          console.log(res);
        });
    },
    async saveNumber(number) {
      this.selection.order.number = number;

      this.save();
    },
  },
};
</script>
<style scoped>
.modal-scroll::-webkit-scrollbar {
  width: 5px;
}

.modal-scroll::-webkit-scrollbar-track {
  background: #f1f5f9;
}

.modal-scroll::-webkit-scrollbar-thumb {
  background: #b9c7da;
  border-radius: 12px;
}
</style>
