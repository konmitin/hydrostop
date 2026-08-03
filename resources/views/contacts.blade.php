<x-template title='Контакты | ГидроСтоп'
    description="Контакты компании «ООО ГидроСтоп»: адрес офиса, график работы, телефон горячей линии и карта проезда. Оперативная доставка гидроизоляции и прайс-лист по запросу. Ждем вашего звонка!">

    <section class="py-16 bg-gradient-to-r from-blue-700 to-blue-900 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Контакты</h1>
                <p class="text-xl mb-8">
                    Контакты компании «ООО ГидроСтоп»: адрес офиса, график работы, телефон горячей
                    линии и карта проезда. Оперативная доставка гидроизоляции и прайс-лист по запросу. Ждем вашего
                    звонка!
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#cta"
                        class="bg-white text-blue-700 px-6 py-3 rounded-md font-medium hover:bg-gray-100 transition-colors">
                        Оставить заявку
                    </a>
                    <a href="#requisite"
                        class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-md font-medium hover:bg-white hover:text-blue-700 transition-colors">
                        Реквизиты
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Хлебные крошки -->
    <div class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="/" class="text-gray-500 hover:text-blue-600">Главная</a>
                    </li>
                    <li>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </li>
                    <li>
                        <span class="text-gray-800 font-medium">Контакты</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Основной контент -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 section-title">Контактная информация</h2>

            <div class="flex gap-4 flex-wrap lg:flex-nowrap">
                <x-contacts :phone="$branch->phone" :email="$branch->email" :address="$branch->address" :map_link="$branch->map_link" />

                <x-question-form :isModal=false></x-question-form>
            </div>
        </div>
    </section>

    {{-- <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 section-title">Часто задаваемые вопросы</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6 contact-card">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Вопросы по доставке</h3>

                    <div class="space-y-4">
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Как осуществляется доставка?</h4>
                            <p class="text-gray-600">Доставка осуществляется транспортными компаниями по всей России. В
                                Москве и области возможна доставка нашей курьерской службой.</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Сколько стоит доставка?</h4>
                            <p class="text-gray-600">Стоимость доставки рассчитывается индивидуально в зависимости от
                                объема заказа и региона доставки.</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Какой срок доставки?</h4>
                            <p class="text-gray-600">Срок доставки от 2 дней по Москве и до 14 дней в отдаленные
                                регионы России.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 contact-card">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Вопросы по оплате</h3>

                    <div class="space-y-4">
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Какие способы оплаты доступны?</h4>
                            <p class="text-gray-600">Мы принимаем банковские переводы, оплату по счету, наличный и
                                безналичный расчет.</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Есть ли рассрочка или кредит?</h4>
                            <p class="text-gray-600">Для постоянных клиентов и крупных заказов возможна оплата в
                                рассрочку по индивидуальным условиям.</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Нужна ли предоплата?</h4>
                            <p class="text-gray-600">Для новых клиентов требуется предоплата 30-50%. Постоянные клиенты
                                могут работать по постоплате.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Реквизиты компании -->
    <section id="requisite" class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 section-title">Реквизиты компании</h2>

            <div class="">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Юридическая информация</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Краткое наименование:</span>
                                <span class="text-gray-800 font-medium text-right">{{ $company->name ?? '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Полное наименование:</span>
                                <span
                                    class="text-gray-800 font-medium text-right">{{ $company->full_name ?? '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">ИНН:</span>
                                <span class="text-gray-800 font-medium">{{ $company->inn ?? '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">КПП:</span>
                                <span class="text-gray-800 font-medium">{{ $company->kpp ?? '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">ОГРН:</span>
                                <span class="text-gray-800 font-medium">{{ $company->ogrn ?? '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">ОКПО:</span>
                                <span class="text-gray-800 font-medium">{{ $company->okpo ?? '' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Банковские реквизиты</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Банк:</span>
                                <span class="text-gray-800 font-medium text-right">ПАО "Сбербанк"</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">БИК:</span>
                                <span class="text-gray-800 font-medium">044525225</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Р/счет:</span>
                                <span class="text-gray-800 font-medium">40702810123456789012</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">К/счет:</span>
                                <span class="text-gray-800 font-medium">30101810000000000225</span>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="mt-8 pt-8 border-t">
                    <div class="flex flex-col md:flex-row justify-between">
                        <div class="mb-4 md:mb-0">
                            <h4 class="font-semibold text-gray-800 mb-2">Юридический адрес</h4>
                            <p class="text-gray-600">{{ $company->legal_address ?? '' }}
                            </p>
                        </div>

                        <div class="mb-4 md:mb-0">
                            <h4 class="font-semibold text-gray-800 mb-2">Фактический адрес</h4>
                            <p class="text-gray-600">{{ $company->actual_address ?? '' }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Телефон</h4>
                            <p class="text-gray-600">{{ $branch->phone ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-template>
