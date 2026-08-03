<template>
  <wrapper>
    <!-- HEADER -->
    <HeaderPage @edit="this.isEdit = true" @save="this.save()" :isEdit="this.isEdit" :title="this.branche?.name">

      <template #avatar>
        <div class="w-12 h-12 bg-gray-900 rounded-md flex items-center justify-center">
          <i class="fas fa-city text-lg text-white"></i>
        </div>
      </template>

      <template #subtitle>
        {{ this.branche?.address }}
      </template>
    </HeaderPage>

    <MainPage>

      <TabsView>
        <Tab v-model="this.activeTab" name="Main" tab="main"></Tab>
        <Tab v-model="this.activeTab" name="Services" tab="services"></Tab>
        <Tab v-model="this.activeTab" name="SEO" tab="seo"></Tab>
      </TabsView>

      <!-- MAIN -->
      <SectionsPage :active-tab="this.activeTab" section="main">

        <!-- MAIN INFO -->
        <SectionPage cols="2" :isEdit="this.isEdit" title="Main info">
          <template #view>
            <div>
              <div class="info-section__subtitle">Name</div>
              <div class="info-value" id="branchPhone">
                {{ this.branche?.name }}
              </div>
            </div>
            <div>
              <div class="info-section__subtitle">Phone</div>
              <div class="info-value" id="branchPhone">
                {{ this.branche?.phone }}
              </div>
            </div>
            <div>
              <div class="info-section__subtitle">Email</div>
              <div class="info-value" id="branchEmail">
                {{ this.branche?.email }}
              </div>
            </div>
            <div>
              <div class="info-section__subtitle">Address</div>
              <div class="info-value" id="branchAddress">
                {{ this.branche?.address }}
              </div>
            </div>
          </template>
          <template #edit>
            <!-- NAME -->
            <div>
              <label class="form-label">NAME *</label>
              <input v-model="this.brancheEdit.name" class="form-input" placeholder="e.g., New York" required />
            </div>
            <!-- PHONE -->
            <div>
              <label class="form-label">PHONE</label>
              <InputPhone v-model="this.brancheEdit.phone" class="form-input" placeholder="(555) 123-4567">
              </InputPhone>
            </div>
            <!-- EMAIL -->
            <div>
              <label class="form-label">EMAIL</label>
              <input v-model="this.brancheEdit.email" type="email" class="form-input"
                placeholder="branch@example.com" />
            </div>
            <!-- ADDRESS -->
            <div>
              <label class="form-label">ADDRESS</label>
              <input v-model="this.brancheEdit.address" type="text" class="form-input"
                placeholder="Street, building, office" />
            </div>
          </template>
        </SectionPage>

        <SectionPage :isEdit="this.isEdit" title="WORKING HOURS">
          <template #view>
            <div v-for="(hour, index) in this.branche.workingHours" :key="index" class="flex flex-col">
              <span class="text-sm text-gray-500">
                {{ hour.days }}
              </span>
              <span class="text-sm font-medium text-gray-800">
                {{ hour.hours }}
              </span>
            </div>
          </template>

          <template #edit>
            <!-- WORKING HOURS -->
            <div class="md:col-span-2">
              <label class="form-label">WORKING HOURS
                <button @click="this.addHour()"
                  class="cursor-pointer inlineflex items-center justify-center ml-2 bg-gray-600 rounded-full h-5 text-white px-2">
                  add hour<i class="fa fa-plus text-xs ml-2"></i>
                </button>
              </label>
              <div class="flex flex-col gap-2">
                <div class="flex gap-4" v-for="(hour, index) in this.brancheEdit.workingHours" :key="index">
                  <input v-model="hour.days" type="text"
                    class="w-full input-field rounded-sm px-4 py-3 text-gray-900 pr-10"
                    placeholder="Latitude (e.g., 40.7128)" />
                  <input v-model="hour.hours" type="text"
                    class="w-full input-field rounded-sm px-4 py-3 text-gray-900 pr-10"
                    placeholder="Longitude (e.g., -74.0060)" />
                  <button class="text-red-600 cursor-pointer" @click="this.deleteHour(index)">
                    <i class="fa fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </template>
        </SectionPage>

        <SectionPage cols="2" :isEdit="this.isEdit" title="ADDITIONAL INFO">
          <template #view>
            <!-- Postal Code (ZIP) -->
            <div>
              <div class="info-section__subtitle">
                Postal Code (ZIP)
              </div>
              <div class="info-value">{{ this.branche?.zip }}</div>
            </div>
            <!-- Coordinate -->
            <div>
              <div class="info-section__subtitle">Coordinate</div>
              <div class="info-value">
                {{
                  this.branche?.coordinate_lat > 0
                    ? this.branche?.coordinate_lat + " N"
                    : this.branche?.coordinate_lat + " S"
                }}
                {{
                  this.branche?.coordinate_long > 0
                    ? this.branche?.coordinate_long + " E"
                    : this.branche?.coordinate_long + " W"
                }}
              </div>
            </div>
            <!-- Range -->
            <div>
              <div class="info-section__subtitle">Range</div>
              <div class="info-value">
                {{ this.branche?.radius ?? 'N/A' }}
              </div>
            </div>
            <div>
              <div class="info-section__subtitle">Max Range</div>
              <div class="info-value">
                {{ this.branche?.max_radius ?? 'N/A' }}
              </div>
            </div>

            <!-- Range -->
            <div>
              <div class="info-section__subtitle">Mile Price</div>
              <div class="info-value">
                ${{ this.branche?.mile_price }}
              </div>
            </div>
            <!-- Timezone -->
            <div>
              <div class="info-section__subtitle">Timezone</div>
              <div class="info-value">
                {{ this.branche?.timezone }}
              </div>
            </div>
            <!-- GOOGLE -->
            <div>
              <div class="info-section__subtitle">
                Google Maps Link
              </div>
              <a :href="this.branche?.google_maps_link" target="_blank" class="info-value">
                {{ this.branche?.google_maps_link }}
              </a>
            </div>
          </template>

          <template #edit>

            <InputNumberPage title="POSTAL CODE (ZIP)" v-model="this.brancheEdit.zip" />

            <!-- COORDINATES -->
            <div class="md:col-span-2">
              <label class="form-label">COORDINATES</label>
              <div class="grid grid-cols-2 gap-4">
                <InputNumberPage v-model="this.brancheEdit.coordinate_lat" placeholder="Latitude (e.g., 40.7128)" />
                <InputNumberPage v-model="this.brancheEdit.coordinate_long" placeholder="Longitude (e.g., -74.0060)" />
              </div>
            </div>

            <InputNumberPage title="GPS Coverage from center (mi)" v-model="this.brancheEdit.radius" />
            <InputNumberPage title="Max GPS Coverage from center (mi)" v-model="this.brancheEdit.max_radius" />
            <InputNumberPage title="Mile Price" v-model="this.brancheEdit.mile_price" />

            <!-- TIMEZONE -->
            <SelectPage label="TIMEZONE" v-model="this.brancheEdit.timezone" :options="this.timezones">
            </SelectPage>

            <InputTextPage v-model="this.brancheEdit.google_maps_link" title="GOOGLE MAPS LINK" />
          </template>
        </SectionPage>
      </SectionsPage>


      <!-- SERVICES -->
      <SectionsPage :active-tab="this.activeTab" section="services">

        <SectionPage :isEdit="this.isEdit" v-for="(servicePackage, index) in this.brancheEdit.packages" :key="index"
          :title="servicePackage?.name">
          <template #view>
            <FieldPage title="Price">
              ${{ servicePackage.price }}
            </FieldPage>

            <FieldPage title="Discount">
              ${{ servicePackage.discount }}
            </FieldPage>

            <FieldPage title="Seo">
              {{ servicePackage.seo_description }}
            </FieldPage>
          </template>

          <template #edit>
            <InputNumberPage v-model="servicePackage.price" title="Price" />
            <InputNumberPage v-model="servicePackage.discount" title="Discount" />
            <TextareaPage v-model="servicePackage.seo_description" title="Seo" />
          </template>

        </SectionPage>
      </SectionsPage>

      <!-- SEO -->
      <SectionsPage :active-tab="this.activeTab" section="seo">
        <!-- SEO -->
        <SectionPage cols="1" :isEdit="this.isEdit" title="MAIN">
          <template #view>
            <FieldPage title="Main Page Text">
              {{ branche.seo_main ?? "NONE" }}
            </FieldPage>
            <FieldPage title="Services Page Text">
              {{ branche.seo_services ?? "NONE" }}
            </FieldPage>
            <FieldPage title="Service Area Text">
              {{ branche.seo_service_area ?? "NONE" }}
            </FieldPage>
          </template>
          <template #edit>
            <!-- TEXT -->
            <TextareaPage v-model="brancheEdit.seo_main" title="Main Page Text" />
            <TextareaPage v-model="brancheEdit.seo_services" title="Services Page Text" />
            <TextareaPage v-model="brancheEdit.seo_service_area" title="Service Area Text" />
          </template>
        </SectionPage>

        <SectionPage cols="1" :isEdit="this.isEdit" v-for="(service, index) in this.brancheEdit.services" :key="index"
          :title="service?.name">
          <template #view>
            <FieldPage title="DESCRIPTION">
              {{ service.seo_description ?? "NONE" }}
            </FieldPage>
          </template>
          <template #edit>
            <!-- TEXT -->
            <TextareaPage v-model="service.seo_description" title="DESCRIPTION" />
          </template>
        </SectionPage>
      </SectionsPage>
    </MainPage>
  </wrapper>
</template>
<script>
import VueSelect from "vue3-select-component";
import InputPhone from "../components/inputs/InputPhone.vue";
import FieldPage from "../components/fields/FieldPage.vue";
import TextareaPage from "../components/fields/TextareaPage.vue";

export default {
  components: {
    VueSelect,
    InputPhone,
    TextareaPage,
  },
  data() {
    return {
      activeTab: "main",
      isShowModal: false,
      isEdit: false,
      branche: {},
      timezones: [],
      brancheEdit: {},
    };
  },
  async created() {
    await this.getBranche();

    document.title = `${this.branche.name} | CarAdmin`;

    let timezones = new Intl.Locale("en-US").getTimeZones();

    timezones.map((timezone) => {
      let object = {
        label: timezone,
        value: timezone,
      };

      this.timezones.push(object);

      return object;
    });
  },
  methods: {
    async getBranche() {
      await axios
        .get(`/branche/${this.$route.params.id}`)
        .then((res) => {
          this.brancheEdit = res.data.data;

          Object.assign(this.branche, this.brancheEdit);
        })
        .catch((res) => {
          console.log(res);
        });
    },
    async addHour() {
      let hours = {
        days: "Mon?",
        hours: "9 AM - 8 PM",
      };

      this.brancheEdit.workingHours.push(hours);
    },
    async deleteHour(index) {
      this.brancheEdit.workingHours.splice(index, 1);
    },

    async save() {
      await axios
        .post(`/branche/${this.branche.id}/save`, this.brancheEdit)
        .then((res) => {
          this.isEdit = false;
          this.getBranche();
        })
        .catch((res) => {
          console.log(res);
        });
    },
  },
};
</script>
<style scoped>
.form-input {
  color: var(--color-gray-800);
  width: 100%;
  padding: 0.625rem 1rem;
  border: 1px solid #e0e0e0;
  border-radius: 0.5rem;
  font-size: 0.875rem;
  transition: all 0.2s ease;
  background-color: white;
}

.form-input:focus {
  outline: none;
  border-color: var(--color-gray-800);
  box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.05);
}

.form-label {
  font-size: 0.75rem;
  font-weight: 600;
  color: #5a5a5a;
  margin-bottom: 0.375rem;
  display: block;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}

/* Блок информации */
.info-section {
  max-width: 24rem;
  margin-bottom: 1.5rem;
  /* padding-bottom: 1rem; */
  /* border-bottom: 1px solid var(--color-gray-300); */
}

.info-section__title,
.info-section__subtitle {
  color: var(--color-gray-500);
}

.info-section__title {
  text-transform: uppercase;
  font-size: 1rem;
  font-weight: 500;
  letter-spacing: 0.03em;
  margin-bottom: 0.5rem;
  display: block;
}

.info-section__subtitle {
  font-size: 0.9rem;
  font-weight: 400;
  color: var(--color-gray-400);
}

.info-value {
  display: inline-block;
  overflow: hidden;
  max-width: 24rem;
  text-wrap: wrap;
  height: 100%;
  font-size: 0.95rem;
  font-weight: 500;
  color: var(--color-gray-900);
  line-height: 1.4;
}

.info-sub {
  font-size: 0.8rem;
  color: #9a9a9a;
  margin-top: 0.25rem;
}

/* Разделитель */
.divider {
  height: 1px;
  background: #f0f0f0;
  margin: 1rem 0;
}

/* Статус-бейдж */
.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.75rem;
  font-weight: 500;
}

.status-active {
  background-color: #e6f7e6;
  color: #2e7d32;
}

.status-inactive {
  background-color: #ffebee;
  color: #c62828;
}

.tab-button {
  padding: 0.875rem 1.5rem;
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--color-gray-400);
  transition: all 0.2s ease;
  border-bottom: 2px solid transparent;
  cursor: pointer;
  gap: 0.5rem;
}

.tab-button:hover {
  color: var(--color-gray-800);
}

.tab-button.active {
  color: var(--color-gray-800);
  border-bottom-color: var(--color-gray-800);
}

/* service */
.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 0.75rem;
}

.service-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.875rem 1.2rem;
  background: var(--color-gray-800);
  border-radius: 0.75rem;
  border: 1px solid #f0f0f0;
  transition: all 0.2s ease;
}

.service-item:hover {
  background: var(--color-gray-600);
  border-color: #e0e0e0;
}

.service-name {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--color-white);
}

.service-price {
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--color-white);
}

.service-price-old {
  font-weight: 400;
  color: #c0c0c0;
  text-decoration: line-through;
}

.service-status-badge {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  display: inline-block;
  margin-right: 0.5rem;
}

.service-status-active {
  background-color: #2e7d32;
}

.service-status-inactive {
  background-color: #c62828;
}
</style>
