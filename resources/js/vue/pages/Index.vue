<template>
  <wrapper>
    <header-panel title="Dashboard" subtitle="">
      <!-- <button-secondary icon="fa-download" title="Other"></button-secondary>
      <button-primary icon="fa-plus" title="Add"></button-primary> -->
    </header-panel>

    <main class="flex-1 overflow-y-auto p-6">
      <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div
            class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700 hover:border-gray-600 transition-colors"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-400 text-sm">Всего сотрудников</p>
                <p class="text-3xl font-bold text-white mt-2">12</p>
              </div>
              <div
                class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center"
              >
                <i class="fas fa-users text-blue-400 text-2xl"></i>
              </div>
            </div>
            <div class="mt-4 text-sm text-green-400">
              <i class="fas fa-arrow-up mr-1"></i> 2 новых за месяц
            </div>
          </div>

          <div
            class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700 hover:border-gray-600 transition-colors"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-400 text-sm">Отработано часов</p>
                <p class="text-3xl font-bold text-white mt-2">1,248</p>
              </div>
              <div
                class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center"
              >
                <i class="far fa-clock text-green-400 text-2xl"></i>
              </div>
            </div>
            <div class="mt-4 text-sm text-green-400">
              <i class="fas fa-arrow-up mr-1"></i> 15% за неделю
            </div>
          </div>

          <div
            class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700 hover:border-gray-600 transition-colors"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-400 text-sm">Активных клиентов</p>
                <p class="text-3xl font-bold text-white mt-2">24</p>
              </div>
              <div
                class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-full flex items-center justify-center"
              >
                <i class="fas fa-user-tie text-purple-400 text-2xl"></i>
              </div>
            </div>
            <div class="mt-4 text-sm text-green-400">
              <i class="fas fa-arrow-up mr-1"></i> 5 новых за месяц
            </div>
          </div>

          <div
            class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700 hover:border-gray-600 transition-colors"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-400 text-sm">Отчетов за месяц</p>
                <p class="text-3xl font-bold text-white mt-2">48</p>
              </div>
              <div
                class="w-14 h-14 bg-orange-500 bg-opacity-20 rounded-full flex items-center justify-center"
              >
                <i class="fas fa-file-alt text-orange-400 text-2xl"></i>
              </div>
            </div>
            <div class="mt-4 text-sm text-red-400">
              <i class="fas fa-arrow-down mr-1"></i> 3% за неделю
            </div>
          </div>
        </div>

        <!-- График активности в темной теме -->
        <div
          class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700"
        >
          <h3 class="text-xl font-bold text-white mb-6">
            Активность сотрудников (часы/день)
          </h3>
          <div class="h-64 flex items-end space-x-2">
            <template x-for="day in activityChart">
              <div class="flex-1 flex flex-col items-center">
                <div
                  class="w-full bg-gradient-to-t from-blue-600 to-blue-400 rounded-t"
                ></div>
                <div class="mt-2 text-sm text-gray-400"></div>
              </div>
            </template>
          </div>
        </div>

        <!-- Последние действия в темной теме -->
        <div
          class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700"
        >
          <h3 class="text-xl font-bold text-white mb-6">Последние действия</h3>
          <div class="space-y-4">
            <div
              class="flex items-center p-3 hover:bg-gray-700 rounded-lg transition-colors"
            >
              <div
                class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center mr-4"
              >
                <i class="fas fa-user-plus text-blue-400"></i>
              </div>
              <div class="flex-1">
                <p class="font-medium text-white">Добавлен новый сотрудник</p>
                <p class="text-gray-400 text-sm">
                  Иван Петров добавлен в отдел разработки
                </p>
              </div>
              <div class="text-gray-500 text-sm">2 часа назад</div>
            </div>

            <div
              class="flex items-center p-3 hover:bg-gray-700 rounded-lg transition-colors"
            >
              <div
                class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center mr-4"
              >
                <i class="far fa-clock text-green-400"></i>
              </div>
              <div class="flex-1">
                <p class="font-medium text-white">Зарегистрировано время</p>
                <p class="text-gray-400 text-sm">
                  Анна Сидорова добавила 8 часов работы
                </p>
              </div>
              <div class="text-gray-500 text-sm">Сегодня, 10:30</div>
            </div>

            <div
              class="flex items-center p-3 hover:bg-gray-700 rounded-lg transition-colors"
            >
              <div
                class="w-10 h-10 bg-purple-500 bg-opacity-20 rounded-full flex items-center justify-center mr-4"
              >
                <i class="fas fa-file-alt text-purple-400"></i>
              </div>
              <div class="flex-1">
                <p class="font-medium text-white">Создан новый отчет</p>
                <p class="text-gray-400 text-sm">
                  Отчет за апрель 2023 сгенерирован
                </p>
              </div>
              <div class="text-gray-500 text-sm">Вчера, 16:45</div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </wrapper>
</template>

<script>
export default {
  name: "",
  mounted() {
    document.title = "Dashboard | CarAdmin";
  },
};
</script>
