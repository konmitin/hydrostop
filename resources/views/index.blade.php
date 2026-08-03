<x-template title="ГидроСтоп - Гидроизоляция в Санкт-Петербурге, России и СНГ"
    description="ГидроСтоп - компания по производству гидроизоляции в Санкт-Петербурге, России и СНГ. 
      Мы продаём бентонитовый шнур, гернитовый шнур, 
      гидрофильный шнур и гидрофильный герметик, а также резинотехнические изделия">
    <section class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Производство <br> Гидроизоляции</h1>
                <p class="text-xl mb-8">
                    Производство и продажа гидроизоляции в Санкт-Петербурге. Бентонитовый шнур (аналог Waterstop),
                    гидрошпонки, инжект-системы, гидрофильный герметик и шнур, гернитовый шнур, резинотехнические
                    изделия. Доставка по РФ и СНГ
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/catalog"
                        class="bg-white text-blue-700 px-6 py-3 rounded-md font-medium hover:bg-gray-100 transition-colors">
                        Смотреть продукцию
                    </a>
                    <a href="#contacts"
                        class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-md font-medium hover:bg-white hover:text-blue-700 transition-colors">
                        Получить консультацию
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if (isset($products))
        <section id="products" class="py-8">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12 section-title">Наша продукция</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-12">
                    @foreach ($products as $product)
                        <x-product :product=$product></x-product>
                    @endforeach
                </div>

                <a href="/catalog"
                    class="inline-block m-auto bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-medium">
                    Смотреть весь каталог
                </a>
            </div>
        </section>
    @endif



    <section id="about" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-12 section-title">О компании</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="flex flex-col gap-4 text-gray-700 mb-6 text-lg">
                        {{ $about ?? '' }}

                        <p>
                            ООО «ГидроСтоп» — производитель гидроизоляционных материалов в Санкт-Петербурге с опытом
                            работы
                            более 5 лет. Мы производим и поставляем бентонитовый шнур, гернитовый шнур, гидрошпонки и
                            другие гидроизоляционные материалы клиентам по всей России и в страны СНГ.
                        </p>

                        <p>
                            Современное оборудование и квалифицированный персонал обеспечивают высокое качество
                            продукции, гарантируя долговечность и надёжность гидроизоляции.
                        </p>

                        <p>
                            Мы постоянно совершенствуем технологии и сервис, чтобы клиенты могли по достоинству оценить
                            не только качество нашей продукции, но и уровень обслуживания.
                        </p>

                        <p>
                            Не знаете, какой материал выбрать? Позвоните — консультация бесплатна.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="advantages" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-12 section-title">Почему именно мы?</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lightbulb text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Индивидуальный подход</h3>
                    <p class="text-gray-600">Мы можем изготовить нестандартные профили, диметр и сечения</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tools text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Широкие возможности</h3>
                    <p class="text-gray-600">Всю продукцию можем изготовить той длины, которая нужна заказчику -
                        условно-бесконечной длины (длинномеры)</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-cog text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Современное оборудование</h3>
                    <p class="text-gray-600">Изготовим любой профиль, диаметр и сечения за короткие сроки.
                        Изготовление: 1-3 дня</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calculator text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Импортозамещение</h3>
                    <p class="text-gray-600">Предложим альтернативные варианты, удовлетворяющие вашим требованиям</p>
                </div>
            </div>

            <div class="mt-12 bg-blue-50 rounded-lg p-8 text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Оставьте заявку для расчета стоимости</h3>
                <p class="text-gray-700 mb-6 max-w-2xl mx-auto">
                    Отправьте нам электронную заявку с описанием вашего проекта, и мы оперативно рассчитаем стоимость и
                    сроки изготовления.
                </p>
                <a href="#questionFormWrapper"
                    class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-medium">
                    Заказать расчет цены
                </a>
            </div>
        </div>
    </section>


    <section id="contacts" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-12 section-title">Контакты</h2>

            <div class="flex flex-wrap lg:flex-nowrap gap-4">
                <x-contacts :phone="$branch->phone" :email="$branch->email" :address="$branch->address" :map_link="$branch->map_link" />


                <x-question-form :isModal=false></x-question-form>
            </div>
        </div>
    </section>

</x-template>
