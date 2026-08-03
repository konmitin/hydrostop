<template lang>
  <div>
    <!-- TEST GROUPS -->
    <div
      class="flex w-full bg-white border border-gray-200 overflow-hidden mb-4"
    >
      <ul class="flex flex-wrap text-sm font-medium text-center">
        <button
          @click="this.selectedTab = 'main'"
          :class="{
            'text-gray-900 border-b-gray-900': this.selectedTab == 'main',
          }"
          class="px-6 py-3 text-gray-400 hover:text-gray-900 cursor-pointer border-b border-b-gray-400 hover:border-b-gray-900"
        >
          Main data
        </button>
        <button
          v-for="(tab, index) in this.tabs"
          :key="index"
          @click="
            this.selectedTab = tab.name.toLowerCase();
            this.showHiddenTest = false;
          "
          :class="{
            'text-gray-900 border-b-gray-900':
              this.selectedTab == tab.name.toLowerCase(),
          }"
          class="px-6 py-3 text-gray-400 hover:text-gray-900 cursor-pointer border-b border-b-gray-400 hover:border-b-gray-900"
        >
          {{ tab.name }}
        </button>
      </ul>
    </div>

    <!-- MAIN -->
    <SectionsPage :active-tab="this.selectedTab" section="main">
      <!-- CONDITION -->
      <SectionPage title="Condition" icon="fa-car">
        <template #view>
          <InputNumberPage
            v-model="this.condition"
            @input="
              if ($event.target.value > 100) $event.target.value = 100;
              $emit('update:condition', $event.target.value);
              $emit('edit');
            "
            type="number"
            placeholder="100"
            min="0"
            max="100"
          />
        </template>
      </SectionPage>
      <!-- RECOMMENDATION -->
      <SectionPage title="Recommendation" icon="fa-clipboard-check">
        <template #view>
          <textarea
            @input="
              $emit('update:recommendation', $event.target.value);
              $emit('edit');
            "
            rows="3"
            class="w-full input-field rounded-sm px-4 py-3 text-gray-900 pr-10"
            placeholder="Additional information on the test results..."
            >{{ this.recommendation }}</textarea
          >
        </template>
      </SectionPage>

      <!-- DESCRIPTION -->
      <SectionPage title="Description" icon="fa-sticky-note">
        <template #view>
          <textarea
            @input="
              $emit('update:description', $event.target.value);
              $emit('edit');
            "
            rows="3"
            class="w-full input-field rounded-sm px-4 py-3 text-gray-900 pr-10"
            placeholder="Additional information on the test results..."
            >{{ this.description }}</textarea
          >
        </template>
      </SectionPage>

      <!-- FRONT PHOTO -->
      <SectionPage title="Front photo" icon="fa-camera">
        <template #view>
          <div class="grid grid-cols-4 gap-2 mb-3">
            <label
              v-if="!this.frontImage[0]"
              class="w-52 h-52 cursor-pointer input-field hover:!bg-gray-200 rounded-md border border-gray-300 flex items-center justify-center text-gray-500 hover:border-blue-500"
            >
              <i class="fas fa-plus"></i>
              <input
                @input="addFrontPhotoEvent"
                class="hidden"
                type="file"
                accept="image/*"
              />
            </label>

            <div
              class="cursor-pointer w-52 h-52 bg-gray-800 rounded-md border border-gray-300 overflow-hidden relative"
              v-if="this.frontImage[0]"
            >
              <label
                class="flex items-center justify-center cursor-pointer w-8 h-8 bg-blue-600 hover:bg-blue-700 absolute right-0"
              >
                <i class="fa fa-edit text-sm"></i>
                <input
                  @input="addFrontPhotoEvent"
                  class="hidden"
                  type="file"
                  accept="image/*"
                />
              </label>
              <img
                :src="this.frontImage[0].path"
                class="w-full h-full object-cover"
                :alt="this.frontImage[0].real_name"
              />
            </div>
          </div>
        </template>
      </SectionPage>

      <!-- PHOTOS -->
      <SectionPage
        :title="`Photos (Max 120 all files at once) - ${this.images.length}`"
        icon="fa-camera"
      >
        <template #view>
          <div class="flex items-center flex-wrap gap-2 mb-3">
            <label
              class="w-38 h-38 md:w-52 md:h-52 cursor-pointer input-field hover:!bg-gray-200 rounded-md border border-gray-300 flex items-center justify-center text-gray-500 hover:border-blue-500"
            >
              <i class="fas fa-plus"></i>
              <input
                @input="addFilesEvent"
                class="hidden"
                type="file"
                accept="image/*"
                multiple
              />
            </label>

            <template v-for="(image, idx) in this.images" :key="idx">
              <div
                :draggable="true"
                @dragstart="onDragStart(idx, this.images)"
                @dragover.prevent="onDragOver(idx)"
                @drop="onDrop(idx)"
                class="cursor-pointer w-38 h-38 md:w-52 md:h-52 input-field hover:!bg-gray-200 rounded-md border border-gray-300 hover:border-blue-500 relative overflow-hidden"
              >
                <div class="flex justify-end absolute right-0 z-10 w-full">
                  <button
                    v-if="!image.id"
                    class="flex items-center justify-center cursor-pointer w-8 h-6 md:w-12 md:h-8 bg-green-600"
                  >
                    New
                  </button>
                  <button
                    @click="rotateImg(idx)"
                    class="flex items-center justify-center shrink-0 cursor-pointer w-6 h-6 md:w-8 md:h-8 bg-blue-600 hover:bg-blue-700"
                  >
                    <i class="fa fa-rotate text-xs md:text-sm text-white"></i>
                  </button>

                  <button
                    @click="deleteMedia(idx, 'image')"
                    class="flex items-center justify-center shrink-0 cursor-pointer w-6 h-6 md:w-8 md:h-8 bg-red-600 hover:bg-red-700"
                  >
                    <i class="fa fa-trash text-xs md:text-sm text-white"></i>
                  </button>
                </div>

                <img
                  v-if="image?.mime && image?.mime.indexOf('image') >= 0"
                  :src="image?.path"
                  :style="{
                    transform: `rotate(${image.rotate > 0 ? image.rotate : 0}deg)`,
                  }"
                  class="w-full h-full object-cover"
                  :alt="image?.real_name"
                />
              </div>
            </template>
          </div>
        </template>
      </SectionPage>

      <!-- VIDEOS -->
      <SectionPage
        :title="`Videos (Max 120 all files at once) - ${this.videos.length}`"
        icon="fa-camera"
      >
        <template #view>
          <div class="flex items-center flex-wrap gap-2 mb-3">
            <label
              class="w-38 h-38 md:w-52 md:h-52 cursor-pointer input-field hover:!bg-gray-200 rounded-md border border-gray-300 flex items-center justify-center text-gray-500 hover:border-blue-500"
            >
              <i class="fas fa-plus"></i>
              <input
                @input="addFilesEvent"
                class="hidden"
                type="file"
                accept="video/*"
                multiple
              />
            </label>

            <template v-for="(video, idx) in this.videos" :key="idx">
              <div
                :draggable="true"
                @dragstart="onDragStart(idx, this.videos)"
                @dragover.prevent="onDragOver(idx)"
                @drop="onDrop(idx)"
                class="cursor-pointer w-38 h-38 md:w-52 md:h-52 input-field hover:!bg-gray-200 rounded-md border border-gray-300 hover:border-blue-500 relative overflow-hidden"
              >
                <div class="flex justify-end absolute right-0 z-10 w-full">
                  <button
                    v-if="!video.id"
                    class="flex items-center justify-center cursor-pointer w-8 h-6 md:w-12 md:h-8 bg-green-600"
                  >
                    New
                  </button>
                  <button
                    @click="deleteMedia(idx, 'video')"
                    class="flex items-center justify-center cursor-pointer w-6 h-6 md:w-8 md:h-8 bg-red-600 hover:bg-red-700"
                  >
                    <i class="fa fa-trash text-xs md:text-sm text-white"></i>
                  </button>
                </div>

                <video
                  v-if="video?.mime && video?.mime.indexOf('video') >= 0"
                  class="w-full h-full object-cover"
                  :alt="video?.real_name"
                  controls
                >
                  <source :src="video?.path" :type="video?.mime" />
                </video>
              </div>
            </template>
          </div>
        </template>
      </SectionPage>
    </SectionsPage>

    <!-- TESTS -->
    <SectionsPage
      v-for="(tab, index) in this.tabs"
      :key="index"
      :active-tab="this.selectedTab"
      :section="tab.name.toLowerCase()"
    >
      <SectionPage :isEdit="this.showHiddenTest">
        <template #view>
          <button
            @click="
              $emit('addTest');
              this.showHiddenTest = true;
            "
            class="w-30 bg-blue-600 cursor-pointer hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md transition flex items-center gap-1"
          >
            <i class="fas fa-plus-circle"></i>
            <span>Add test</span>
          </button>
        </template>

        <template #edit>
          <button
            @click="this.showHiddenTest = false"
            class="w-30 bg-red-600 cursor-pointer hover:bg-red-700 text-white text-sm px-4 py-2 rounded-md transition flex items-center gap-1"
          >
            <i class="fas fa-close"></i>
            <span>Close</span>
          </button>
        </template>
      </SectionPage>

      <SectionsPage
        :active-tab="group.type_id"
        :section="tab.id"
        v-for="(group, groupIndex) in this.groups"
      >
        <SectionPage :isEdit="this.showHiddenTest" :title="group.name">
          <template #view>
            <div class="flex flex-col gap-4">
              <template v-for="(test, testIndex) in group.tests">
                <TestRowModal
                  v-if="
                    test.group.name.toLowerCase() == group.name.toLowerCase() &&
                    test.type != 'hidden' &&
                    test.value_type == 'text'
                  "
                  @edit="(test) => doEditTest(test, testIndex, groupIndex)"
                  :test="test"
                  :key="testIndex"
                  @hidden="group.hiddenTests++"
                ></TestRowModal>

                <TestRowInsertModal
                  v-if="
                    test.group.name.toLowerCase() == group.name.toLowerCase() &&
                    test.type != 'hidden' &&
                    test.value_type == 'insert'
                  "
                  @edit="(test) => doEditTest(test, testIndex, groupIndex)"
                  :test="test"
                  :key="testIndex"
                  @hidden="group.hiddenTests += 1"
                ></TestRowInsertModal>
              </template>
            </div>
          </template>

          <template #edit>
            <div class="flex flex-col gap-2">
              <template v-for="(test, testIndex) in group.tests">
                <div
                  v-if="
                    test.group.name.toLowerCase() == group.name.toLowerCase() &&
                    test.type == 'hidden'
                  "
                  class="flex flex-col gap-4"
                >
                  <div
                    class="flex items-center justify-between w-full gap-8 text-gray-900 hover:text-orange-600"
                  >
                    <span class="text-md uppercase">{{ test.name }}</span>

                    <div class="">
                      <label
                        class="flex items-center gap-1 cursor-pointer text-sky-600 hover hover:underline uppercase"
                      >
                        <input
                          type="radio"
                          :name="test.name.toLowerCase() + test.id"
                          class="hidden"
                          @click="
                            test.type =
                              test.value_type == 'text'
                                ? test.default_value
                                : '';
                            group.hiddenTests--;
                            test.value_type == 'text'
                              ? doEditTest(test, testIndex, groupIndex)
                              : this.insertValue(test, testIndex, groupIndex);
                          "
                        />
                        <span class="text-sm">Show</span>
                      </label>
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </template>
        </SectionPage>
      </SectionsPage>
    </SectionsPage>
  </div>
</template>
<script>
import TestRowInsertModal from "../TestRowInsertModal.vue";
import TestRowModal from "../TestRowModal.vue";

import { useGlobalNotification } from "../../../composables/globalNotification";
const { showNotify, closeNotify } = useGlobalNotification();

export default {
  components: {
    TestRowModal,
    TestRowInsertModal,
  },
  emits: ["edit"],
  data() {
    return {
      selectedTab: "main",
      showHiddenTest: false,
      activeGroup: "engine",
      dragStartIndex: null,
      dragOverIndex: null,
      filesToDownload: 0,
    };
  },
  props: {
    modelValue: {
      type: Array,
    },
    condition: {
      type: Number,
      default: 0,
    },
    recommendation: {
      type: String,
      default: "",
    },
    description: {
      type: String,
      default: "",
    },
    tabs: {
      type: Object,
      default: {},
    },
    groups: {
      type: Object,
      default: {},
    },
    images: {
      type: Array,
      default: [],
    },
    videos: {
      type: Array,
      default: [],
    },
    frontImage: {
      type: Array,
      default: [],
    },
  },
  created() {
    console.log(this.images);
  },
  methods: {
    async deleteMedia(mediaIndex, type) {
      let media;

      if (type == "image") {
        media = this.images[mediaIndex];
        this.images.splice(mediaIndex, 1);
      } else {
        media = this.videos[mediaIndex];
        this.videos.splice(mediaIndex, 1);
      }

      if (media.id > 0) {
        let waitNotifyIndex = showNotify("Loading... Please, wait", "wait");

        axios.delete(`/report/media/${media.id}`).then((res) => {
          closeNotify(waitNotifyIndex);
          showNotify("Done! File deleted successfully", "success", 3000);
        });

        this.$emit("save");
      } else {
        this.filesToDownload--;
      }
    },
    async rotateImg(imgIndex) {
      let img = this.images[imgIndex];

      if (img.rotate) {
        img.rotate += 90;
      } else {
        img.rotate = 90;
      }

      if (img.rotate > 360) {
        img.rotate = 0;
      }

      this.$emit("edit");
    },
    doEditTest(test, testIndex, groupIndex) {
      try {
        this.modelValue[groupIndex].tests[testIndex].value = test.value;
        this.modelValue[groupIndex].tests[testIndex].type = test.type;
        this.modelValue[groupIndex].tests[testIndex].comment = test.comment;
      } catch (error) {
        console.log(error);
      }

      this.$emit("update:modelValue", this.modelValue);
      this.$emit("edit");
    },
    async addFrontPhotoEvent(event) {
      let files = event.target.files;

      const file = files[0];

      this.frontImage[0] = {
        real_name: file.name,
        path: URL.createObjectURL(file),
        type: "front",
        position: 10,
        file: file,
        mime: file.type,
      };

      this.frontImage[0].file_id = null;

      this.$emit("update:frontImage", this.frontImage);
      this.$emit("edit");
    },
    async addFilesEvent(event) {
      let files = event.target.files;

      for (const key in files) {
        if (!Object.hasOwn(files, key)) continue;

        if (this.filesToDownload >= 120) {
          showNotify(
            `Error! A maximum of 120 files at a time. Now ${this.filesToDownload}`,
            "error",
            3000,
          );
          break;
        }

        const file = files[key];

        let mediaData = {
          real_name: file.name,
          path: URL.createObjectURL(file),
          position: this.images.length * 10,
          file: file,
          mime: file.type,
          position: key * 10,
        };

        if (file.type.indexOf("image") >= 0) {
          this.images.push(mediaData);

          this.updateMediaPosition(this.images);

          this.$emit("update:images", this.images);
        } else if (file.type.indexOf("video") >= 0) {
          this.videos.push(mediaData);

          this.updateMediaPosition(this.videos);

          this.$emit("update:videos", this.videos);
        }

        this.filesToDownload++;
      }

      event.target.value = "";
      this.$emit("edit");
    },
    onDragStart(idx, list) {
      this.dragItems = list;
      this.dragStartIndex = idx;
    },
    onDragOver(idx) {
      this.dragOverIndex = idx;
    },
    onDrop(idx) {
      if (this.dragStartIndex === null) return;

      const movedItem = this.dragItems[this.dragStartIndex];

      this.dragItems.splice(this.dragStartIndex, 1);
      this.dragItems.splice(idx, 0, movedItem);

      this.dragStartIndex = null;
      this.dragOverIndex = null;

      this.updateMediaPosition(this.dragItems);

      this.dragItems = null;

      this.$emit("edit");
    },
    updateMediaPosition(medias) {
      medias.map((item, idx) => {
        item.position = idx * 10;
        return item;
      });
    },
    insertValue(test) {
      test.value = test.default_value;
    },
  },
};
</script>
<style scoped>
.tab {
  border-color: transparent;
  color: var(--color-gray-400);
}

.tab:hover {
  border-color: var(--color-gray-600);
  color: var(--color-gray-300);
}

.active-tab {
  border-color: var(--color-blue-400);
  color: var(--color-blue-400);
}
</style>
