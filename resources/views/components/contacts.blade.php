<div class="w-full lg:max-w-1/3">
    <div class="w-full bg-white rounded-lg shadow-md p-6 contact-card" itemscope
        itemtype="https://schema.org/Organization">
        <h2 class="text-xl font-bold text-gray-800 mb-4" itemprop="name">Основные контакты</h2>

        <div class="space-y-4">
            <div class="flex items-start">
                <div class="flex items-center justify-center bg-blue-100 w-10 h-10 rounded-full mr-4" aria-hidden="true">
                    <i class="fas fa-phone text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800" itemprop="contactType">Телефон</h3>
                    <a href="tel:{{ preg_replace('/[^\d+]/', '', $phone ?? '') }}" class="text-gray-600"
                        itemprop="telephone">
                        {{ $phone ?? '' }}
                    </a>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex items-center justify-center bg-blue-100 w-10 h-10 rounded-full mr-4"
                    aria-hidden="true">
                    <i class="fas fa-envelope text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800" itemprop="contactType">Электронная почта</h3>
                    <a href="mailto:{{ $email ?? '' }}" class="text-gray-600" itemprop="email">
                        {{ $email ?? '' }}
                    </a>
                </div>
            </div>

            @if (isset($address))
                <div class="flex items-start">
                    <div class="flex items-center justify-center bg-blue-100 w-10 h-10 rounded-full mr-4"
                        aria-hidden="true">
                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Адрес офиса</h3>
                        @if (isset($map_link))
                            <a target="_blank" href="{{ $map_link ?? '' }}" class="text-gray-600" itemprop="address">
                                {{ $address ?? '' }}
                            </a>
                        @else
                            <p class="text-gray-600" itemprop="address">{{ $address ?? '' }}</p>
                        @endif
                    </div>
                </div>
            @endif

            @if (isset($work_hours))
                <div class="flex items-start">
                    <div class="flex items-center justify-center bg-blue-100 w-10 h-10 rounded-full mr-4"
                        aria-hidden="true">
                        <i class="fas fa-clock text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Время работы</h3>
                        <p class="text-gray-600" itemprop="openingHours">{{ $work_hours ?? '' }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
