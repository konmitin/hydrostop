<x-template title='О компании | ГидроСтоп'
    description="ГидроСтоп — производитель гидроизоляционных материалов и резинотехнических изделий в Санкт-Петербурге. Опыт более 5 лет. Бентонитовый шнур, гернитовый шнур, гидрошпонки, РТИ для промышленности и строительства. Доставка по России и СНГ">

    <style>
        .info-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: #3b82f6;
        }

        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 30px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #3b82f6;
        }

        .timeline-item {
            position: relative;
            padding-left: 80px;
            margin-bottom: 40px;
        }

        .timeline-year {
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
            height: 60px;
            background-color: #3b82f6;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        .team-member {
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-10px);
        }

        .certificate-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .certificate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            margin: 5% auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
            border-radius: 8px;
        }

        .close {
            position: absolute;
            top: 20px;
            right: 35px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>

    <section class="py-16 bg-gradient-to-r from-blue-700 to-blue-900 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">О компании</h1>
                <p class="text-xl mb-8">
                    ООО «ГидроСтоп» — производитель гидроизоляционных материалов и резинотехнических
                    изделий в Санкт-Петербурге. Опыт более 5 лет. Бентонитовый шнур, гернитовый шнур, гидрошпонки, РТИ
                    для промышленности и строительства. Доставка по России и СНГ
                </p>
                <div class="flex flex-wrap gap-4">
                </div>
            </div>
        </div>
    </section>

    <x-breadcrumbs :breadcrumbs=$breadcrumbs title="О нас"></x-breadcrumbs>

    <!-- О компании -->
    <section id="about" class="py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold mb-6 section-title">Кто мы такие</h2>

                    <div class="flex flex-col gap-4 text-gray-700 mb-6 text-lg">
                        {{ $description ?? '' }}

                        <p>
                            ООО «ГидроСтоп» основана в Санкт-Петербурге и уже более 5 лет специализируется на
                            выпуске гидроизоляционных материалов. В нашем ассортименте — бентонитовый и гернитовый
                            шнуры, гидрошпонки, а также широкий перечень сопутствующей продукции, которую мы отправляем
                            заказчикам по всей России и в страны ближнего зарубежья.
                        </p>

                        <p>
                            Производственная база оснащена современным оборудованием, а сотрудники регулярно повышают
                            квалификацию. Такой подход позволяет выпускать продукцию стабильно высокого качества,
                            обеспечивающую надёжную и долговечную гидроизоляцию на объектах любой сложности.
                        </p>

                        <p>
                            Мы не стоим на месте: улучшаем технологии, расширяем номенклатуру и уделяем особое внимание
                            сервису. Нам важно, чтобы каждый клиент остался доволен не только материалом, но и
                            взаимодействием с нашей командой на всех этапах — от подбора до отгрузки.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden info-card">
                    <img src="https://via.placeholder.com/600x400/3B82F6/FFFFFF?text=Наше+производство"
                        alt="Наше производство" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Современное производство</h3>
                        <p class="text-gray-600">
                            Мы используем передовое оборудование и технологии для обеспечения
                            высочайшего качества продукции
                        </p>
                    </div>
                </div>
            </div>

            <!-- Статистика -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
                <div class="stat-card rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold mb-2">5+</div>
                    <div class="text-blue-100">Лет на рынке</div>
                </div>

                <div class="stat-card rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold mb-2">500+</div>
                    <div class="text-blue-100">Видов продукции</div>
                </div>

                <div class="stat-card rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold mb-2">1000+</div>
                    <div class="text-blue-100">Клиентов</div>
                </div>

                <div class="stat-card rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold mb-2">Россия и СНГ</div>
                    <div class="text-blue-100">Доставка</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Сертификаты и достижения -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <!-- Заголовок -->
            <h2 class="text-3xl font-bold section-title mb-12">Сертификаты и документы</h2>

            <!-- Сетка сертификатов -->
            <div class="flex flex-wrap gap-8 mb-12">
                @foreach ($sertificates as $sert)
                    @if ($sert->file && $sert->preview)
                        <div class="certificate-card flex flex-col bg-white rounded-lg shadow-md overflow-hidden max-w-96">
                            <div class="h-82 bg-blue-100 flex items-center justify-center overfrlow-hidden">
                                <img class="w-full h-full object-contain"
                                    src="{{ '/storage/' . $sert->preview?->path }}" alt="">
                            </div>
                            <div class="px-4 py-6 gap-4 flex flex-col flex-1 justify-between ">
                                <div class="flex flex-col gap-4">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $sert->name }}</h3>
                                    <p class="text-gray-600 mb-4">
                                        {{ $sert->description }}
                                    </p>
                                </div>

                                <a href="{{ '/storage/' . $sert->file?->path }}" download="{{ $sert->name }}"
                                    class="text-center w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                                    Скачать сертификат
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Модальное окно для просмотра сертификатов -->
        <div id="certificateModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="certificateImage" src="" alt="Сертификат">
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-blue-700 to-blue-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Готовы к сотрудничеству?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Свяжитесь с нами для получения консультации или расчета стоимости
                продукции</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/contacts"
                    class="bg-white text-blue-700 px-8 py-4 rounded-md font-medium hover:bg-gray-100 transition-colors text-lg">
                    Связаться с нами
                </a>
                <a href="/catalog"
                    class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-md font-medium hover:bg-white hover:text-blue-700 transition-colors text-lg">
                    Смотреть каталог
                </a>
            </div>
        </div>
    </section>

</x-template>
