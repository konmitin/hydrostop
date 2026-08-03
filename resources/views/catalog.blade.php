<x-template title="Продукция | ГидроСтоп"
    description="Производство и продажа гидроизоляционных материалов и РТИ в Санкт-Петербурге. Бентонитовый шнур, гидрошпонки, инжект-системы, гидрофильный герметик и шнур, гернитовый шнур, резинотехнические изделия. Доставка по РФ и СНГ">

    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
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

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }
    </style>

    <div id="catalog-page" class="page active">

        <x-breadcrumbs :breadcrumbs=$breadcrumbs title="Каталог"></x-breadcrumbs>

        <section class="py-8">
            <div class="container mx-auto px-4">
                <h1 class="text-3xl font-bold mb-2">Продукция</h1>
                <p class="text-gray-600">
                    Производство и продажа гидроизоляционных материалов и РТИ в Санкт-Петербурге. Бентонитовый шнур,
                    гидрошпонки, инжект-системы, гидрофильный герметик и шнур, гернитовый шнур, резинотехнические
                    изделия. Доставка по РФ и СНГ
                </p>


                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <div class="flex flex-col md:flex-row items-start md:items-end gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Категория</label>
                            <select id="input-category"
                                class="w-full border rounded-md px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onchange="location = this.value;">
                                <option value="/catalog" @if (isset($active_category) && $active_category == 0) selected @endif>
                                    Все категории ({{ $total_products ?? 0 }})
                                </option>

                                @if (isset($categories))
                                    @foreach ($categories as $category)
                                        <option value="/catalog/{{ $category->slug }}"
                                            @if (isset($active_category) && $active_category == $category->slug) selected @endif>{{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Сортировка</label>
                            <select id="input-sort"
                                class="form-select w-full border rounded-md px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onchange="location = this.value;">
                                <option @if (!empty($sort) && $sort == 'name' && !empty($order) && $order == 'asc') selected @endif value="?sort=name&order=asc">
                                    Название (А - Я)
                                </option>
                                <option @if (!empty($sort) && $sort == 'name' && !empty($order) && $order == 'desc') selected @endif value="?sort=name&order=desc">
                                    Название (Я - А)
                                </option>
                                <option @if (!empty($sort) && $sort == 'price' && !empty($order) && $order == 'asc') selected @endif value="?sort=price&order=asc">
                                    Цена (дешевле)
                                </option>
                                <option @if (!empty($sort) && $sort == 'price' && !empty($order) && $order == 'desc') selected @endif
                                    value="?sort=price&order=desc">
                                    Цена (дороже)
                                </option>
                            </select>
                        </div>
                    </div>


                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @isset($products)
                        @foreach ($products as $product)
                            <x-product :product=$product></x-product>
                        @endforeach
                    @endisset
                </div>


                <div class="mt-12 flex  justify-center gap-4">
                    <div class="">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-template>
