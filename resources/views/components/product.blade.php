<article class="flex flex-col w-full max-w-sm md:max-w-md bg-white rounded-xl shadow-lg overflow-hidden card-hover"
    itemscope itemtype="https://schema.org/Product">

    <a href="/catalog/{{ $product->category()->first()->slug . '/' . $product->slug }}"
        class="bg-gradient-to-br from-blue-50 to-gray-100 flex justify-center items-center h-56 md:h-72 relative overflow-hidden"
        title="{{ $product->name }}">
        @if (isset($product->frontImage[0]))
            <img src="{{ '/storage/' . $product->frontImage[0]->path }}"
                alt="{{ $product->frontImage[0]->pivot->name }} купить в наличии" class="image-hover w-full h-full object-contain"
                loading="lazy" itemprop="image">
        @endif

    </a>

    <div class="text-white px-4 pt-2 flex justify-between items-center">
        <link itemprop="availability" href="https://schema.org/InStock"
            content="{{ $product->status()->first()->name }}" />
        <span class="bg-green-600 text-white text-xs font-medium px-3 py-1 rounded">
            {{ $product->status()->first()->name }}
        </span>
        <span class="text-gray-500 text-xs md:text-sm font-medium px-3 py-1 rounded-full" itemprop="sku">
            Арт. {{ $product->sku }}
        </span>
    </div>

    <div class="flex flex-col flex-1 p-4">

        <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-1" itemprop="name">
            {{ $product->name }}
        </h2>

        <div class="flex flex-col flex-1 grow-1 h-full">
            <p class="text-gray-600 text-sm md:text-base mb-4 md:mb-6" itemprop="description">
                {{ mb_substr($product->description, 0, 80) }}...
            </p>
        </div>

        <div class="flex flex-col md:justify-between gap-4" itemprop="offers" itemscope
            itemtype="https://schema.org/Offer">

            <div class="flex text-2xl md:text-3xl items-baseline font-bold text-blue-500">
                <span class="text-nowrap" itemprop="price" content="{{ $product->price }}">
                    от {{ $product->price }} ₽ / {{ $product->unit()->first()->name ?? '' }}
                </span> 
                <span class="hidden" itemprop="priceCurrency" content="RUB">₽</span>
            </div>

            <a href="/catalog/{{ $product->category()->first()->slug . '/' . $product->slug }}"
                class="btn-hover bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 md:px-6 rounded-lg flex items-center justify-center transition-colors duration-200"
                title="Перейти к товару {{ $product->name }}" aria-label="Подробнее о {{ $product->name }}">
                <span>Подробнее</span>
            </a>
        </div>
    </div>
</article>
