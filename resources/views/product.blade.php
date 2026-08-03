<x-template title="{{ $product->seo_name ?? $product->name }}" description="{{ $product->seo_description }}">
    <x-breadcrumbs :breadcrumbs=$breadcrumbs title="{{ $product->name }}"></x-breadcrumbs>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg overflow-hidden mb-8">
            <div class="md:flex gap-6">
                <div class="md:w-1/2">
                    <div class="h-96 md:h-[30rem] mb-4 bg-gradient-to-br from-blue-50 to-gray-100">
                        @if (isset($product->frontImage[0]))
                            <img src="{{ '/storage/' . $product->frontImage[0]->path }}"
                                alt="{{ $product->frontImage[0]->pivot->name }}"
                                class="w-full h-full object-contain rounded-lg" data-product-image="product-front">
                        @endif
                    </div>


                    @if (isset($product->images))
                        <div class="grid grid-cols-3 md:grid-cols-4 gap-2 mb-2">
                            @if (isset($product->frontImage[0]))
                                <img src="{{ '/storage/' . $product->frontImage[0]->path }}"
                                    alt="{{ $product->frontImage[0]->pivot->name }}"
                                    class="rounded-md h-30 w-30 md:w-48 object-contain cursor-pointer border-1 border-blue-500"
                                    data-product-image="product-image">
                            @endif


                            @foreach ($product->images as $image)
                                <img src="{{ '/storage/' . $image->path }}" alt="{{ $image->pivot->name }}"
                                    class="rounded-md h-30 w-30 md:w-48 object-contain cursor-pointer border-1"
                                    data-product-image="product-image">
                            @endforeach
                        </div>
                    @endif

                </div>

                <div class="md:w-1/2">
                    <div class="mb-4">
                        <span class="bg-green-600 text-white text-xs font-medium px-3 py-1 rounded"
                            id="product-status">{{ $product->status()->first()->name }}</span>
                        <span class="text-gray-500 text-sm ml-2" id="product-sku">Арт.
                            {{ $product->sku }}</span>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-800 mb-2" id="product-title">{{ $product->name }}</h1>

                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $product->rate)
                                    <i class="fas fa-star"></i>
                                @elseif($i == 5 && fmod($product->rate, 1) > 0)
                                    <i class="fas fa-star-half"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="ml-2 text-gray-600">{{ $product->rate }}</span>
                    </div>


                    <p class="text-3xl font-bold text-blue-600 mb-6" id="product-price">{{ $product->price }} ₽ /
                        {{ $product->unit()->first()->name ?? '' }}</p>


                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Описание:</h3>
                        <p class="text-gray-700" id="product-application">
                            {{ $product->description }}
                        </p>
                    </div>

                    @if ($properties->count() > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Характеристики:</h3>
                            <ul class="space-y-2" id="product-specs">
                                @foreach ($properties as $property)
                                    <li class="flex">
                                        <span class="text-gray-600 w-40">{{ $property->name }}:</span>
                                        <span class="text-gray-800 font-medium">{{ $property->value }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (isset($product->documents) && $product->documents->count() > 0)
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Техническая документация</h3>
                            <ul class="space-y-3">
                                @foreach ($product->documents as $doc)
                                    <li>
                                        <a download="{{ $doc->pivot->name }}" href="{{ '/storage/' . $doc->path }}"
                                            class="flex items-center text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-file mr-2"></i>
                                            <span>{{ $doc->pivot->name }}</span>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    @endif

                    {{-- <div class="flex gap-4">
                        <div class="flex items-center border rounded-md">
                            <button class="cursor-pointer px-4 py-2 text-gray-600 hover:text-blue-600"
                                id="decrease-quantity">-</button>
                            <span class="px-4 py-2" name="quantity" id="input-quantity">1</span>
                            <button class="cursor-pointer px-4 py-2 text-gray-600 hover:text-blue-600"
                                id="increase-quantity">+</button>
                            <input type="hidden" name="product_id" value="{{ $product->id }}" id="input-product-id">
                        </div>

                        <button
                            class="cursor-pointer bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors  font-medium"
                            id="add-to-cart">
                            Добавить в корзину
                        </button>
                        <button
                            class="cursor-pointer bg-white border border-blue-600 text-blue-600 px-4 py-2 rounded-md hover:bg-blue-50 transition-colors font-medium">
                            <i class="far fa-heart"></i>
                        </button>
                    </div> --}}

                    <div class="mt-4 flex items-center text-sm text-gray-600">
                        <i class="fas fa-truck mr-2"></i>
                        <span>Доставка по России от 2 дней</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Отзывы покупателей</h2>

                <div class="space-y-6 mb-6">
                    <div class="border-b pb-4">
                        <div class="flex justify-between mb-2">
                            <h3 class="font-semibold text-gray-800">Александр Иванов</h3>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-2">Использовали для герметизации вентиляции в производственном цехе.
                            Отличное качество, удобный монтаж. Шнур хорошо набухает и создает надежное уплотнение.</p>
                        <p class="text-gray-500 text-sm">15 марта 2023</p>
                    </div>

                    <div class="border-b pb-4">
                        <div class="flex justify-between mb-2">
                            <h3 class="font-semibold text-gray-800">ООО "СтройИнвест"</h3>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-2">Закупали крупную партию для объекта. Качество соответствует
                            заявленному, доставка вовремя. Рекомендуем как надежного поставщика.</p>
                        <p class="text-gray-500 text-sm">28 февраля 2023</p>
                    </div>
                </div>

                <button
                    class="bg-gray-100 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-200 transition-colors w-full">
                    Показать все отзывы
                </button>
            </div> --}}



        @if (isset($otherProducts) && $otherProducts->count() > 0)
            <div class="bg-white rounded-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Похожие товары</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($otherProducts as $product)
                        <div class="border rounded-lg p-4 product-card">
                            <h3 class="font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ mb_substr($product->description, 0, 80) }}...</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-blue-600">{{ $product->price }} ₽ /
                                    {{ $product->unit->name ?? '' }}</span>
                                <a href="/catalog/{{ $product->category()->first()->slug . '/' . $product->slug }}"
                                    class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition-colors text-sm view-product">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif
    </div>

    <script>
        const front = document.querySelector('[data-product-image="product-front"]');
        const images = document.querySelectorAll('[data-product-image="product-image"]');
        let activeImage = 0;

        images.forEach(image => {
            images[activeImage].classList.add('border-blue-500');

            image.addEventListener('click', (event) => {
                front.src = image.src;

                images.forEach(image2 => image2.classList.remove('border-blue-500'))

                image.classList.add('border-blue-500');

            });
        });
    </script>
</x-template>
