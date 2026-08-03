<template>
  <TemplateRight @close="$emit('close')">
    <HeaderRight
      @close="$emit('close')"
      @save="this.save()"
      :isEdit="true"
      title="New Report"
    >
      <template #subtitle>
        <span>
          {{
            new Date().toLocaleString("en-US", {
              year: "numeric",
              month: "long",
              day: "numeric",
            })
          }}
        </span>
      </template>
    </HeaderRight>

    <MainPage>
      <ReportTabsViewModal
        v-model="this.report.groups"
        v-model:frontImage="this.report.frontImage"
        v-model:images="this.report.images"
        v-model:condition="this.report.conditionValue"
        v-model:description="this.report.description"
        v-model:recommendation="this.report.recommendation"
        @edit="isEdit = true"
        :tabs="this.testGroupTypes"
        :groups="this.report.groups"
        :images="this.report.images"
      >
      </ReportTabsViewModal>
    </MainPage>
  </TemplateRight>
</template>
<script>
import ReportTabsViewModal from "./ReportTabsViewModal.vue";

import { useGlobalNotification } from "../../../composables/globalNotification";

const { showNotify, closeNotify } = useGlobalNotification();

export default {
  components: {
    ReportTabsViewModal,
  },
  data() {
    return {
      report: {
        number: this.vehicle.order.number,
        order: this.vehicle.order,
        vehicle_id: this.vehicle.id,
        description: "",
        groups: [],
        images: [],
      },
      testGroups: [],
      testGroupTypes: [],
      countTest: 0,
      completedTest: 0,
      completedTestProcent: 0,
      isEdit: false,
    };
  },
  props: {
    vehicle: {
      type: Object,
      default: {},
    },
  },
  emits: ["close", "edit", "success"],
  async created() {
    await this.getTestGroupTypes();
    await this.getTestGroupsTests();
  },
  methods: {
    async getTestGroupTypes() {
      await axios.get("/tests/groups/types").then((response) => {
        this.testGroupTypes = response.data.data;
      });
    },
    async getTestGroupsTests() {
      await axios.get("/tests/groups/tests").then((response) => {
        this.report.groups = response.data.data;
      });
    },
    async save() {
      this.report.images.forEach((image) => {
        URL.revokeObjectURL(image.path);
      });

      let formData = this.objectToFormData({ report: this.report });

      let waitNotifyIndex = showNotify("Loading... Please, wait", "wait");

      await axios
        .post("/report/add", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          closeNotify(waitNotifyIndex);
          showNotify("Done! Report saved successfully", "success", 3000);

          this.report.images = res.data.data.images;

          this.$emit("close");
          this.$emit("success", res.data.data);
        })
        .catch((res) => {
          closeNotify(waitNotifyIndex);
          showNotify("Error! Report not saved", "error", 3000);
        });
    },
    objectToFormData(object, formDataOld = null, keyOld = null) {
      let formData = formDataOld ?? new FormData();

      for (var key in object) {
        let value = object[key];

        if (keyOld) {
          key = `${keyOld}[${key}]`;
        }

        if (value instanceof File) {
          formData.append(key, value, value.name);
          continue;
        }

        if (value instanceof Object) {
          this.objectToFormData(value, formData, key);
          continue;
        }

        formData.append(key, value);
      }

      return formData;
    },
  },
};
</script>
<style scoped>
.thin-scroll::-webkit-scrollbar {
  width: 5px;
}

.thin-scroll::-webkit-scrollbar-track {
  background: #1f2937;
}

.thin-scroll::-webkit-scrollbar-thumb {
  background: #4b5563;
  border-radius: 12px;
}

@keyframes slideIn {
  from {
    transform: translateX(100%);
    opacity: 0;
  }

  to {
    transform: translateX(0);
    opacity: 1;
  }
}

.modal-slide {
  animation: slideIn 0.3s ease-out forwards;
}
</style>
