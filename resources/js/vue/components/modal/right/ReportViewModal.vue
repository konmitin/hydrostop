<template lang>
  <TemplateRight @close="$emit('close')">
    <HeaderRight
      @close="$emit('close')"
      @edit="
        this.$emit('edit');
        this.isEdit = true;
      "
      @saveNumber="(number) => this.saveNumber(number)"
      @save="this.save()"
      :isEdit="this.isEdit"
      :editableNumber="true"
      :title="`Report #${this.report.number}`"
      :number="this.report.number"
    >
      <template #subtitle>
        <span>
          {{
            new Date(this.report.created_at).toLocaleString("en-US", {
              year: "numeric",
              month: "long",
              day: "numeric",
            })
          }}
          ·
        </span>

        <a
          class="text-blue-600 hover:text-blue-700"
          :href="`/account/report/${this.report.slug}`"
          target="_blank"
        >
          Client's view
        </a>

        <span>·</span>

        <a
          class="text-blue-600 hover:text-blue-700"
          :href="`/h-admin/vehicle/${this.report.vehicle?.id}`"
        >
          Vehicle
        </a>
      </template>

      <template #buttons>
        <button
          v-if="this.$store.state.user?.isAdmin"
          @click="
            () => {
              if (
                this.report.is_public == 'N' &&
                this.$store.state.user?.isAdmin
              ) {
                $emit('public');
                this.public();
              }
            }
          "
          :class="{
            'bg-green-600 hover:bg-green-700': this.report.is_public == 'N',
          }"
          class="w-22 h-10 rounded-lg cursor-pointer bg-gray-600 flex items-center justify-center gap-2 px-2 text-white hover:text-white transition"
        >
          <i class="fas fa-eye text-lg"></i> Live
        </button>
        <button
          v-if="this.$store.state.user?.isAdmin"
          @click="
            () => {
              if (
                this.report.is_public == 'Y' &&
                this.$store.state.user?.isAdmin
              ) {
                $emit('unpublic');
                this.unpublic();
              }
            }
          "
          :class="{
            'bg-red-600 hover:bg-red-700': this.report.is_public == 'Y',
          }"
          class="w-22 h-10 rounded-lg cursor-pointer bg-gray-600 flex items-center justify-center gap-2 px-2 text-white hover:text-white transition"
        >
          <i class="fas fa-eye-slash text-lg"></i> Draft
        </button>
      </template>
    </HeaderRight>

    <MainPage>
      <ReportTabsViewModal
        v-model="this.report.groups"
        v-model:frontImage="this.report.frontImage"
        v-model:images="this.report.images"
        v-model:videos="this.report.videos"
        v-model:condition="this.report.conditionValue"
        v-model:description="this.report.description"
        v-model:recommendation="this.report.recommendation"
        @edit="isEdit = true"
        :tabs="this.testGroupTypes"
        :groups="this.report.groups"
        :images="this.report.images"
      >
      </ReportTabsViewModal>

      <button
        v-if="this.$store.state.user?.isAdmin"
        @click="
          $emit('delete');
          this.delete();
        "
        class="w-full h-10 rounded-lg cursor-pointer bg-red-600 flex items-center justify-center text-white hover:bg-red-700 hover:text-white transition"
      >
        <i class="fas fa-trash text-lg"></i>
      </button>
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
      testGroupTypes: [],
      testGroups: [],
      countTest: 0,
      completedTest: 0,
      completedTestProcent: 0,
      isEdit: false,
      images: this.report.images,
    };
  },
  props: {
    report: {
      type: Object,
      default: {},
    },
  },
  emits: ["close", "edit", "delete"],
  created() {
    this.getTestGroupTypes();
    this.getTestGroups();

    // this.countCompletedTests();

    this.report.description = this.report.description ?? "";
    this.report.recommendation = this.report.recommendation ?? "";
  },
  methods: {
    async getTestGroupTypes() {
      await axios.get("/tests/groups/types").then((response) => {
        this.testGroupTypes = response.data.data;
      });
    },
    async getTestGroups() {
      await axios.get("/tests/groups").then((response) => {
        this.testGroups = response.data.data;
      });
    },
    countCompletedTests() {
      this.completedTest = 0;
      this.countTest = 0;

      this.report.tests.forEach((test) => {
        if (test.type != "hidden") this.countTest++;

        if (test.type && test.type != "hidden" && test.type != "empty") {
          this.completedTest++;
        }
      });

      this.completedTestProcent = Math.ceil(
        (this.completedTest / this.countTest) * 100,
      );
    },
    async delete() {
      await axios.delete(`/report/${this.report.id}`).then((response) => {
        this.$emit("delete");
        this.$router.back();
      });
    },
    async public() {
      this.report.is_public = "Y";
      await axios.post(`/report/${this.report.id}/public`).then((res) => {});
    },
    async unpublic() {
      this.report.is_public = "N";
      await axios.post(`/report/${this.report.id}/unpublic`).then((res) => {});
    },
    async saveNumber(number) {
      this.report.number = number;

      this.save();
    },
    async save() {
      this.report.images.forEach((image) => {
        if (image) {
          URL.revokeObjectURL(image.path);
        }
      });

      let formData = this.objectToFormData({ report: this.report });

      let waitNotifyIndex = showNotify("Loading... Please, wait", "wait");

      await axios
        .post("/report/save", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          closeNotify(waitNotifyIndex);
          showNotify("Done! Report saved successfully", "success", 3000);

          this.report.groups = res.data.data.groups;
          this.report.images = res.data.data.images;
          this.report.videos = res.data.data.videos;
          this.report.frontImage = res.data.data.frontImage;

          this.$emit("save");
          this.isEdit = false;
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
