<template>
  <wrapper-second class="bg-gray-100 text-gray-200 h-full w-full">
    <div class="flex flex-1 items-center justify-center min-h-[100vh]">
      <div class="w-full h-full max-w-md relative z-10 px-4">
        <!-- Логотип и название -->
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center space-x-3 mb-4">
            <div class="w-20 h-20 float-animation">
              <img :src="'/storage/img/logo.svg'" alt="" />
            </div>
          </div>
          <h1 class="text-4xl font-bold text-gray-900 mb-2">ГидроСтоп</h1>
          <p class="text-gray-600 text-lg">Вход в админ-панель</p>
        </div>

        <div class="shadow-lg bg-white rounded-lg p-8">
          <form
            action="/h-admin/user/auth"
            id="login-form"
            class="space-y-6"
            @submit.prevent="this.login()"
          >
            <div>
              <InputTextPage
                icon="fas fa-envelope"
                title="Электронная почта"
                type="email"
                id="email"
                placeholder="admin@example.ru"
                v-model="this.email"
              />
            </div>

            <div class="flex">
              <InputPassword
                icon="fas fa-lock"
                @input="this.isEdit = true"
                class="w-full flex-1"
                label="Пароль"
                v-model="this.password"
                placeholder="password"
              ></InputPassword>
            </div>

            <div class="flex items-center justify-between">
              <label class="flex items-center space-x-2 cursor-pointer">
                <input
                  type="checkbox"
                  class="custom-checkbox"
                  id="rememberMe"
                />
                <span class="text-sm text-gray-600">Запоминть меня</span>
              </label>

              <a href="#" class="text-sm text-blue-600 link-hover">
                Забыли пароль?
              </a>
            </div>

            <button
              type="sumbit"
              class="w-full btn-primary py-3 px-4 rounded-lg font-medium shadow-lg"
            >
              <i class="fas fa-sign-in-alt mr-2"></i>
              Вход
            </button>
          </form>
        </div>
      </div>
    </div>
  </wrapper-second>
</template>

<script>
import axios from "../axios";
import InputTextPage from "../components/fields/InputTextPage.vue";

export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  mounted() {
    document.title = "Авторизация | ГидроСтоп";
  },
  methods: {
    async login() {
      await axios.get("/csrf-cookie");

      const response = await axios
        .post("/user/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          this.$store.dispatch("getUser");

          this.$router.push({
            path: "/h-admin/products",
          });
        });
    },
  },
};
</script>

<style>
.auth-page {
  background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
}

/* Анимация для логотипа */
@keyframes float {
  0%,
  100% {
    transform: translateY(0px);
  }

  50% {
    transform: translateY(-10px);
  }
}

.float-animation {
  animation: float 6s ease-in-out infinite;
}

/* Стили для полей ввода */
.input-field {
  transition: all 0.3s ease;
  background-color: #f9fafb;
  border: 1px solid #e5e7eb;
}

.input-field:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  outline: none;
  background-color: white;
}

/* Стили для чекбокса */
.custom-checkbox {
  appearance: none;
  -webkit-appearance: none;
  width: 18px;
  height: 18px;
  background-color: #f9fafb;
  border: 2px solid #d1d5db;
  border-radius: 4px;
  cursor: pointer;
  position: relative;
  transition: all 0.2s ease;
}

.custom-checkbox:checked {
  background-color: #3b82f6;
  border-color: #3b82f6;
}

.custom-checkbox:checked::after {
  content: "\f00c";
  font-family: "Font Awesome 6 Free";
  font-weight: 900;
  font-size: 12px;
  color: white;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

/* Стили для кнопки входа */
.btn-primary {
  background: linear-gradient(to right, #3b82f6, #2563eb);
  color: white;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background: linear-gradient(to right, #2563eb, #1d4ed8);
  transform: translateY(-1px);
  box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
}

.btn-primary:active {
  transform: translateY(0);
}

/* Стили для уведомления */
.notification {
  transition: all 0.3s ease;
  animation: slideIn 0.3s ease forwards;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateX(100%);
  }

  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.notification.hide {
  animation: slideOut 0.3s ease forwards;
}

@keyframes slideOut {
  from {
    opacity: 1;
    transform: translateX(0);
  }

  to {
    opacity: 0;
    transform: translateX(100%);
  }
}

/* Модальное окно */
.modal-overlay {
  background-color: rgba(0, 0, 0, 0.5);
  transition: all 0.3s ease;
}

.modal-content {
  animation: modalFadeIn 0.3s ease forwards;
}

@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }

  to {
    opacity: 1;
    transform: scale(1);
  }
}
</style>
