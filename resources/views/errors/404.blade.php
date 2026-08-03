<x-template>
    <style>
        .error-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
        }

        .error-content {
            text-align: center;
            max-width: 600px;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .error-animation {
            position: relative;
            margin: 0 auto 2rem;
            width: 200px;
            height: 200px;
        }

        .error-number {
            font-size: 8rem;
            font-weight: 900;
            color: #3b82f6;
            line-height: 1;
            position: relative;
            z-index: 2;
        }

        .error-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 51, 234, 0.1) 100%);
            z-index: 1;
        }

        .error-icon {
            position: absolute;
            font-size: 4rem;
            color: rgba(59, 130, 246, 0.2);
        }

        .error-icon:nth-child(1) {
            top: 20px;
            left: 20px;
            transform: rotate(-15deg);
        }

        .error-icon:nth-child(2) {
            top: 20px;
            right: 20px;
            transform: rotate(15deg);
        }

        .error-icon:nth-child(3) {
            bottom: 20px;
            left: 20px;
            transform: rotate(15deg);
        }

        .error-icon:nth-child(4) {
            bottom: 20px;
            right: 20px;
            transform: rotate(-15deg);
        }

        .search-box {
            max-width: 400px;
            margin: 0 auto;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .link-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #374151;
        }

        .link-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: #3b82f6;
        }

        .link-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.25rem;
        }
    </style>


    <div class="container mx-auto">
        <div class="error-content container mx-auto">
            <div class="flex items-center justify-center error-animation relative">
                <div class="error-circle"></div>
                <div class="error-number"></div>
                <i class="error-icon fas fa-search"></i>
                <i class="error-icon fas fa-box"></i>
                <i class="error-icon fas fa-tools"></i>
                <i class="error-icon fas fa-tint"></i>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">Страница не найдена</h1>
            <p class="text-gray-600 text-lg mb-6">
                К сожалению, запрашиваемая страница не существует или была перемещена. Возможно, вы ввели неправильный
                адрес или страница была удалена.
            </p>
            {{-- 
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Попробуйте найти нужную информацию</h3>
                <div class="search-box">
                    <i class="search-icon fas fa-search"></i>
                    <input type="text" placeholder="Поиск по каталогу или статьям..." class="search-input" id="searchInput">
                </div>
            </div> --}}

            <!-- Кнопки действий -->
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <a href="/"
                    class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-medium">
                    <i class="fas fa-home mr-2"></i>На главную
                </a>
                <a href="/catalog"
                    class="bg-white border border-blue-600 text-blue-600 px-6 py-3 rounded-md hover:bg-blue-50 transition-colors font-medium">
                    <i class="fas fa-boxes mr-2"></i>В каталог
                </a>
            </div>

            <!-- Полезные ссылки -->
            <div class="links-grid">

                <a href="/about" class="link-card">
                    <div class="link-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h4 class="font-medium text-gray-800 mb-2">О компании</h4>
                    <p class="text-gray-600 text-sm">Наша история и достижения</p>
                </a>

                <a href="/contacts" class="link-card">
                    <div class="link-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4 class="font-medium text-gray-800 mb-2">Контакты</h4>
                    <p class="text-gray-600 text-sm">Адреса, телефоны, схема проезда</p>
                </a>
            </div>

            <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <div class="flex items-start">
                    <div class="w-full">
                        <h4 class="font-medium text-gray-800 mb-2">Если вы уверены, что страница должна существовать
                        </h4>
                        <p class="text-gray-700 text-sm">
                            Возможно, страница временно недоступна или была перемещена. Cвяжитесь с нашими специалистами
                            по телефону
                            <a href="tel:{{ preg_replace('/[^\d+]/', '', $phone ?? '') }}"
                                class="text-blue-600 hover:underline">{{ $phone ?? '' }}</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Мобильное меню
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Анимация чисел 404
            const errorNumber = document.querySelector('.error-number');
            let count = 0;

            function animateNumber() {
                if (count < 404) {
                    count += 4;
                    errorNumber.textContent = count;
                    setTimeout(animateNumber, 10);
                } else {
                    errorNumber.textContent = '404';
                }
            }

            // Запускаем анимацию при загрузке
            setTimeout(animateNumber, 500);

            // Анимация иконок
            const errorIcons = document.querySelectorAll('.error-icon');
            errorIcons.forEach((icon, index) => {
                icon.style.animationDelay = `${index * 0.2}s`;
                icon.classList.add('animate-bounce');
            });
        });
    </script>
</x-template>
