<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Админ-панель | Гидростоп</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap">

    <link rel="icon" href="/storage/img/favicon.ico" type="image/x-image">

    @vite(['resources/css/app.css', 'resources/js/admin.js'])

    <style>
        /* Анимация загрузки */
        .dot-flashing {
            position: relative;
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: #3b82f6;
            color: #3b82f6;
            animation: dot-flashing 1s infinite linear alternate;
            animation-delay: 0.5s;
        }

        .dot-flashing::before,
        .dot-flashing::after {
            content: '';
            display: inline-block;
            position: absolute;
            top: 0;
        }

        .dot-flashing::before {
            left: -15px;
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: #3b82f6;
            color: #3b82f6;
            animation: dot-flashing 1s infinite alternate;
            animation-delay: 0s;
        }

        .dot-flashing::after {
            left: 15px;
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: #3b82f6;
            color: #3b82f6;
            animation: dot-flashing 1s infinite alternate;
            animation-delay: 1s;
        }

        @keyframes dot-flashing {
            0% {
                background-color: #3b82f6;
            }

            50%,
            100% {
                background-color: rgba(59, 130, 246, 0.2);
            }
        }

        /* Стили для модальных окон в темной теме */
        [x-cloak] {
            display: none !important;
        }
    </style>
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
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
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

    <style>
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

</head>

<body>
    <div id="app"></div>
</body>

</html>
