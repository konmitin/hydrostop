<template>
  <Teleport to="body">
    <Transition
      enter-active-class="transition-opacity duration-200 ease-out"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition-opacity duration-150 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="states.length > 0"
        class="fixed flex flex-col gap-4 bottom-0 left-0 z-50 flex items-center justify-center px-4 py-6"
      >
        <div
          v-for="(state, index) in states"
          :key="index"
          @click="closeNotify(index)"
          class="w-full max-w-md bg-white rounded-xl overflow-hidden shadow-lg"
        >
          <div class="flex items-center justify-between p-5">
            <div class="flex gap-3">
              <div
                :class="{
                  'text-gray-600': state.type == 'wait',
                  'text-gray-600': state.type == 'info',
                  'text-green-600': state.type == 'success',
                  'text-red-600': state.type == 'error',
                }"
              >
                <i
                  class="fa"
                  :class="{
                    'fa-spinner': state.type == 'wait',
                    'fa-info-circle': state.type == 'info',
                    'fa-check-circle': state.type == 'success',
                    'fa-exclamation-circle': state.type == 'error',
                  }"
                ></i>
              </div>
              <h3 class="text-md text-gray-900">
                {{ state.message }}
              </h3>
            </div>
          </div>

          <div class="px-5 pb-5" v-if="!state.timeout && state.type != 'wait'">
            <button
              @click.self="closeNotify(index)"
              :class="{
                'bg-gray-600 hover:bg-gray-700': state.type == 'info',
                'bg-green-600 hover:bg-green-700': state.type == 'success',
                'bg-red-600 hover:bg-red-700': state.type == 'error',
              }"
              class="w-full cursor-pointer text-white font-medium py-2.5 px-4 rounded-xl"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { useGlobalNotification } from "../composables/globalNotification";

const { states, closeNotify } = useGlobalNotification();
</script>
