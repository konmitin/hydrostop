<div class="bg-gray-100 py-4" role="navigation" aria-label="Навигационная цепочка">
    <div class="container mx-auto px-4">
        <nav aria-label="Breadcrumb">
            <ul class="flex flex-wrap items-center space-x-2" itemscope itemtype="https://schema.org/BreadcrumbList">
                @foreach ($breadcrumbs as $key => $breadcrumb)
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="{{ $breadcrumb['href'] }}" itemprop="item"
                            class="text-gray-500 hover:text-blue-600 transition-colors duration-200"
                            aria-current="false">
                            <span itemprop="name">{{ $breadcrumb['text'] }}</span>
                        </a>
                        <meta itemprop="position" content="{{ $key + 1 }}" />
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-1" aria-hidden="true"></i>
                    </li>
                @endforeach

                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name" class="text-gray-800 font-medium"
                        aria-current="page">{{ $title }}</span>
                    <meta itemprop="position" content="{{ $key + 1 }}" />
                    <meta itemprop="item" content="{{ url()->current() }}" />
                </li>
            </ul>
        </nav>
    </div>
</div>
