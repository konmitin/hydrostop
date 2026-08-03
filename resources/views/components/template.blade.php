<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? '' }}</title>

    <meta name="robots" content="index, follow">
    <meta name="author" content="Hydrostop">

    @if (isset($title))
        <meta property="og:title" content="{{ $title }}">
    @endif

    @if (isset($description))
        <meta name="description" content="{{ $description }}">
        <meta property="og:description" content="{{ $description }}">
    @endif

    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('/storage/img/og-image.jpg') }}">
    <meta property="og:site_name" content="Завод Гидростоп">
    <meta property="og:locale" content="en_US">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap'>

    <link rel="icon" href="/storage/img/favicon.ico" type="image/x-image">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="text-gray-800 relative">

    @csrf

    <div class="wrapper flex flex-col h-full min-h-[100vh]">
        <x-header></x-header>

        <main class="flex flex-col flex-1 h-full ">
            {{ $slot }}
        </main>

        <x-footer class="mt-auto"></x-footer>
    </div>

    <x-notification-modal></x-notification-modal>

    <div id="cookieConsent" class="fixed bottom-0 left-0 right-0 z-50 animate-slide-up">
        <div class="bg-gray-900/95 backdrop-blur-sm border-t border-gray-700 shadow-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                    <!-- Текст уведомления -->
                    <div class="flex-1 text-sm sm:text-base text-gray-200 leading-relaxed">
                        <p class="mb-2">
                            <span class="font-semibold text-white">Мы используем cookie-файлы и сервис
                                Яндекс.Метрика</span>
                            для анализа посещаемости и улучшения работы сайта.
                        </p>
                        <p class="text-gray-400 text-xs sm:text-sm">
                            Продолжая использовать сайт, вы соглашаетесь с
                            <a href="/privacy"
                                class="text-blue-400 hover:text-blue-300 underline transition-colors duration-200">политикой
                                конфиденциальности</a>
                            и
                            <a href="https://yandex.ru/legal/confidential/" target="_blank" rel="noopener noreferrer"
                                class="text-blue-400 hover:text-blue-300 underline transition-colors duration-200">политикой
                                конфиденциальности Яндекс.Метрики</a>.
                            Вы можете отказаться от сбора данных, нажав «Отказаться».
                        </p>
                    </div>

                    <!-- Кнопки действий -->
                    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                        <button onclick="acceptCookies()"
                            class="w-full sm:w-auto px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-gray-900 text-sm sm:text-base whitespace-nowrap">
                            Принимаю
                        </button>
                        <button onclick="rejectCookies()"
                            class="w-full sm:w-auto px-6 py-2.5 bg-transparent hover:bg-gray-800 text-gray-300 hover:text-white font-medium rounded-lg border border-gray-600 hover:border-gray-500 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900 text-sm sm:text-base whitespace-nowrap">
                            Отказаться
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const YANDEX_METRIKA_ID = `{{ $yandexMetrika ?? '' }}`;

        // Проверяем, было ли уже принято решение
        function checkConsent() {
            const consent = localStorage.getItem('cookieConsent');

            if (consent === 'accepted') {
                // Согласие дано - запускаем Метрику в полном режиме
                initMetrika(true);
                hideConsentBanner();
            } else if (consent === 'rejected') {
                // Отказ - Метрика в ограниченном режиме
                initMetrika(false);
                hideConsentBanner();
            } else {
                // Решение не принято - показываем плашку
                showConsentBanner();
                // Инициализируем Метрику в минимальном режиме (без сбора данных)
                initMetrika(false);
            }
        }

        // Принятие cookie и метрики
        function acceptCookies() {
            localStorage.setItem('cookieConsent', 'accepted');

            // Перезапускаем Метрику с полным функционалом
            if (typeof ym !== 'undefined') {
                ym(YANDEX_METRIKA_ID, 'enableAll');
                // Дополнительно инициализируем с полными настройками
                ym(YANDEX_METRIKA_ID, "init", {
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true
                });
            }

            hideConsentBanner();

            // Отправляем событие в Метрику о принятии согласия
            if (typeof ym !== 'undefined') {
                ym(YANDEX_METRIKA_ID, 'reachGoal', 'cookie_accept');
            }
        }

        // Отказ от сбора данных
        function rejectCookies() {
            localStorage.setItem('cookieConsent', 'rejected');

            // Отключаем сбор данных в Метрике
            if (typeof ym !== 'undefined') {
                ym(YANDEX_METRIKA_ID, 'disableAll');
            }

            // Очищаем существующие cookie (кроме технических)
            clearAnalyticsCookies();

            hideConsentBanner();
        }

        // Скрытие плашки с анимацией
        function hideConsentBanner() {
            const banner = document.getElementById('cookieConsent');
            if (banner) {
                banner.classList.remove('animate-slide-up');
                banner.classList.add('animate-slide-down');

                setTimeout(() => {
                    banner.style.display = 'none';
                }, 300);
            }
        }

        // Показ плашки
        function showConsentBanner() {
            const banner = document.getElementById('cookieConsent');
            if (banner) {
                banner.style.display = 'block';
                banner.classList.remove('animate-slide-down');
                banner.classList.add('animate-slide-up');
            }
        }

        // Очистка аналитических cookie
        function clearAnalyticsCookies() {
            const cookies = document.cookie.split("; ");
            const analyticsDomains = ['yandex.ru', 'mc.yandex.ru', 'metrika.yandex.ru'];

            cookies.forEach(cookie => {
                const cookieName = cookie.split("=")[0];

                // Удаляем куки Яндекс.Метрики
                if (cookieName.startsWith('_ym_')) {
                    document.cookie = `${cookieName}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
                    document.cookie =
                        `${cookieName}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=.${window.location.hostname}`;
                }
            });
        }

        // Возможность изменить решение (добавьте ссылку в футере)
        function resetConsent() {
            localStorage.removeItem('cookieConsent');

            // Очищаем куки
            clearAnalyticsCookies();

            // Перезагружаем страницу для применения изменений
            location.reload();
        }

        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            checkConsent();
        });

        // Добавляем возможность отозвать согласие (разместите где-нибудь в футере)
        console.log('Для отзыва согласия используйте функцию resetConsent()');
    </script>

    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0];
            k.async = 1;
            k.src = r;
            a.parentNode.insertBefore(k, a);
        })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");



        function initMetrika(consent = false) {
            if (typeof ym !== 'undefined') {
                ym(YANDEX_METRIKA_ID, "init", {
                    clickmap: consent,
                    trackLinks: consent,
                    accurateTrackBounce: consent,
                    webvisor: consent,
                    // Отключаем сбор данных без согласия
                    triggerEvent: consent
                });

                if (!consent) {
                    // Отключаем сбор данных
                    ym(YANDEX_METRIKA_ID, 'disableAll');
                }
            }
        }
    </script>
</body>

</html>
