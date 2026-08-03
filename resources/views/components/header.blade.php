<header class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="/" class="flex items-center">
                <img src="/storage/img/logo_icon_dark.png" title="Логотип Гидростоп" alt="Логотип Гидростоп"
                    class="mr-3 max-h-12" />

                <h1 class="text-xl font-bold text-gray-800">Завод Гидростоп</h1>
            </a>

            <div class="hidden md:flex space-x-6 text-md">
                <a href="/catalog" class="text-gray-600 hover:text-blue-600 font-medium">Продукция</a>
                <a href="/about" class="text-gray-600 hover:text-blue-600 font-medium">О компании</a>
                <a href="/contacts" class="text-gray-600 hover:text-blue-600 font-medium">Контакты</a>
            </div>

            <div class="flex items-center space-x-4">
                <a id="header-cart" href="/cart" class="relative text-gray-600 hover:text-blue-600">
                    <i class="fa fa-cart"></i>
                </a>
                <a href="tel:{{ preg_replace('/[^\d+]/', '', $branch->phone ?? '') }}"
                    class="hidden md:block text-gray-600 hover:text-blue-600">
                    <i class="fas fa-phone mr-1"></i>
                    {{ $branch->phone ?? '' }}
                </a>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                    <span class="hidden md:inline">Заказать звонок</span>
                    <i class="fas fa-phone mr-1 md:hidden"></i>
                </button>
                <button class="md:hidden text-gray-600" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Мобильное меню -->
        <div class="md:hidden hidden py-2 border-t" id="mobile-menu">
            <a href="/catalog" class="block py-2 text-gray-600 hover:text-blue-600">Продукция</a>
            <a href="/about" class="block py-2 text-gray-600 hover:text-blue-600">О компании</a>
            <a href="/contacts" class="block py-2 text-gray-600 hover:text-blue-600">Контакты</a>
            <a href="tel:{{ preg_replace('/[^\d+]/', '', $branch->phone ?? '') }}"
                class="block py-2 text-gray-600 hover:text-blue-600">
                <i class="fas fa-phone mr-1"></i>
                {{ $branch->phone ?? '' }}
            </a>
        </div>
    </div>
</header>
