<x-template title="Booking Inspection | Car Inspection">
    <style>
        .form-section {
            border-radius: .5rem;
            padding: 1.5rem 1.5rem 0 0;
            margin-bottom: .5rem;
        }

        .form-section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            text-transform: uppercase;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .5rem;
        }

        .form-input {
            width: 100%;
            padding: 0 16px;
            height: 3rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: border-color 0.3s ease;
        }

        .select2 {
            height: 3rem;
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: border-color 0.3s ease;
        }

        .select2 * {
            /* display: block;
            height: 100%;
            border: none; */
        }

        .select2-vehicle-address-dropdown {
            margin-top: .5rem;
            border: 1px solid #d1d5db !important;
            border-radius: 6px !important;
        }

        .select2-selection {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between;
            height: 100% !important;
            border: none !important;
            width: 100% !important;
        }

        .select2-selection__rendered {
            display: block;
            line-height: 24px !important;
            padding: 0 !important;
        }

        .select2-selection__arrow {
            position: relative !important;
            right: 0 !important;
            top: 0 !important;
        }

        .form-input:focus {
            outline: none;
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        .required::after {
            content: '*';
            color: #ef4444;
            margin-left: 4px;
        }

        .info-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            color: white;
            border-radius: 50%;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 8px;
        }

        .checkbox-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 16px;
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .checkbox-item:hover {
            border-color: #f97316;
            background-color: #fef3c7;
        }

        .checkbox-item input[type="checkbox"] {
            margin-top: 4px;
            margin-right: 12px;
            width: 20px;
            height: 20px;
            accent-color: #f97316;
        }

        .addon-card {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }

        .addon-card:hover {
            border-color: #f97316;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .addon-card.selected {
            border-color: #f97316;
            background-color: #fef3c7;
        }

        .reset-link {
            color: #f97316;
            font-weight: 600;
            text-decoration: underline;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .manual-mode-link {
            color: #6b7280;
            font-size: 0.875rem;
            text-decoration: underline;
            cursor: pointer;
        }

        /* Стили выпадающего списка */
        .vehicle-address-dropdown {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            max-height: 280px;
            overflow-y: auto;
            z-index: 100000;
            padding: 8px 0;
            display: none;
            /* скрыт по умолчанию */
        }

        .vehicle-address-dropdown.show {
            display: block;
        }

        .vehicle-address-dropdown-item {
            padding: 12px 18px;
            font-size: 14px;
            color: #1e293b;
            cursor: pointer;
            transition: background 0.15s;
            border-bottom: 1px solid #f1f5f9;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .vehicle-address-dropdown-item:last-child {
            border-bottom: none;
        }

        .vehicle-address-dropdown-item:hover {
            background: #f0f7ff;
        }

        .vehicle-address-dropdown-item.active {
            background: #e6f0ff;
            color: #0066ff;
            font-weight: 500;
        }
    </style>
    <style>
        /* Popup Overlay */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(.125rem);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .popup-container {
            width: 36rem;
            max-width: 90%;
            background: white;
            border-radius: 1.25rem;
            box-shadow: 0 1.25rem 2.1875rem -0.625rem rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: popupFadeIn 0.2s ease;
        }

        @keyframes popupFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .popup-header {
            padding: 1.125rem 1.25rem;
            border-bottom: .0625rem solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
        }

        .popup-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
        }

        .close-btn {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            border: none;
            background: #f3f4f6;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .close-btn:hover {
            background: #fee2e2;
            color: #ef4444;
        }

        .popup-content {
            padding: 1.25rem;
        }

        /* Date chips - горизонтальный скролл */
        .date-scroll-container {
            margin-bottom: 1.25rem;
        }

        .date-label {
            font-size: .6875rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--color-orange-500);
            margin-bottom: .75rem;
            letter-spacing: .0313rem;
        }

        .date-scroll {
            display: flex;
            gap: .625rem;
            overflow-x: auto;
            scrollbar-width: thin;
            padding-bottom: .5rem;
        }

        .date-scroll::-webkit-scrollbar {
            height: .1875rem;
        }

        .date-scroll::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: .625rem;
        }

        .date-scroll::-webkit-scrollbar-thumb {
            background: var(--color-orange-500);
            border-radius: .625rem;
        }

        .date-chip {
            flex-shrink: 0;
            text-align: center;
            /* padding: .625rem 1rem; */
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            background: #f9fafb;
            border: .0625rem solid #e5e7eb;
            min-width: 4.375rem;
        }

        .date-chip:hover {
            border-color: var(--color-orange-500);
            background: #fff7ed;
        }

        .date-chip.selected {
            border-color: var(--color-orange-500);
            background: var(--color-orange-500);
            color: white;
        }

        .date-chip.selected .date-day {
            color: rgba(255, 255, 255, 0.8);
        }

        .date-chip.selected .date-number {
            color: white;
        }

        .date-day {
            font-size: .625rem;
            font-weight: 500;
            color: #6b7280;
        }

        .date-number {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
        }

        .date-month {
            font-size: .5625rem;
            color: #9ca3af;
        }

        .date-chip.selected .date-month {
            color: rgba(255, 255, 255, 0.7);
        }

        /* Time slots */
        .time-label {
            font-size: .6875rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--color-orange-500);
            margin-bottom: .75rem;
            letter-spacing: .0313rem;
        }

        .time-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: .5rem;
            max-height: 16.25rem;
            overflow-y: auto;
            padding-right: .25rem;
        }

        .time-grid::-webkit-scrollbar {
            width: .1875rem;
        }

        .time-grid::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: .625rem;
        }

        .time-grid::-webkit-scrollbar-thumb {
            background: var(--color-orange-500);
            border-radius: .625rem;
        }

        .time-slot {
            text-align: center;
            padding: .625rem .375rem;
            border-radius: .625rem;
            font-size: .75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            background: #f9fafb;
            border: .0625rem solid #e5e7eb;
            color: #374151;
        }

        .time-slot:hover:not(.booked):not(.disabled):not(.selected) {
            border-color: var(--color-orange-500);
            background: #fff7ed;
        }

        .time-slot.selected {
            border-color: var(--color-orange-500);
            background: var(--color-orange-500);
            color: white;
        }

        .time-slot.booked {
            background: #fee2e2;
            border-color: #fecaca;
            color: #9ca3af;
            cursor: not-allowed;
            text-decoration: line-through;
            position: relative;
        }

        .time-slot.booked::after {
            content: '✕';
            position: absolute;
            top: -0.375rem;
            right: -0.25rem;
            font-size: .625rem;
            color: #ef4444;
            background: white;
            border-radius: .625rem;
            width: .875rem;
            height: .875rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .time-slot.disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .no-slots {
            text-align: center;
            padding: 2.5rem 1.25rem;
            color: #9ca3af;
            font-size: .8125rem;
            grid-column: span 3;
        }

        /* Selected summary */
        .selected-summary {
            background: #fef3c7;
            border-radius: .75rem;
            padding: .75rem 1rem;
            margin-top: 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .selected-info {
            font-size: .8125rem;
        }

        .selected-info .label {
            color: #92400e;
            font-size: .625rem;
            text-transform: uppercase;
        }

        .selected-info .value {
            font-weight: 600;
            color: #78350f;
        }

        .confirm-btn {
            background: var(--color-orange-500);
            color: white;
            border: none;
            padding: .5rem 1.25rem;
            border-radius: .625rem;
            font-weight: 600;
            font-size: .8125rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .confirm-btn:hover:not(:disabled) {
            background: #ea580c;
        }

        .confirm-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        .demo-button {
            background: var(--color-orange-500);
            color: white;
            border: none;
            padding: .75rem 1.5rem;
            border-radius: .75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .demo-button:hover {
            background: #ea580c;
            transform: translateY(-0.0625rem);
        }

        .legend {
            display: flex;
            gap: .75rem;
            margin-top: 1rem;
            padding-top: .75rem;
            border-top: .0625rem solid #f0f0f0;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: .375rem;
            font-size: .625rem;
            color: #9ca3af;
        }

        .legend-dot {
            width: .625rem;
            height: .625rem;
            border-radius: .1875rem;
        }

        .legend-dot.available {
            background: #f9fafb;
            border: .0625rem solid #e5e7eb;
        }

        .legend-dot.selected {
            background: var(--color-orange-500);
        }

        .legend-dot.booked {
            background: #fee2e2;
            border: .0625rem solid #fecaca;
        }
    </style>

    <div class="py-12 bg-gray-900">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Book Vehicle Inspection</h1>
            <p class="text-gray-100 max-w-3xl">
                Fill out the form below to schedule your vehicle inspection
            </p>
        </div>
    </div>

    <form id="inspection-form" class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-4 py-8">

        <div class="lg:col-span-2">

            <div class="form-section">
                <h2 class="form-section-title mb-4 required">Branch</h2>
                <div class="w-48">
                    <select data-input-required data-inspection-branche type="text" class="form-input" name="branche">
                        @foreach ($branches as $branche)
                            <option value="{{ $branche->id }}"
                                @if ($selectedBranche->id == $branche->id) {{ 'selected' }} @else @endif>
                                {{ $branche->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-section">
                <h2 class="form-section-title mb-4 required">Inspection INFO</h2>


                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="">
                        <label for="package" class="form-label required">Package</label>
                        <select data-input-required data-inspection-type type="text" class="form-input"  name="package">
                            @foreach ($packages as $package)
                                <option value="{{ $package->code }}"
                                    @if ($type->code == $package->code) {{ 'selected' }} @else @endif>
                                    {{ $package->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="">
                        <label for="client-type" class="form-label required">Type</label>
                        <select data-input-required data-inspection-client-type id="client-type" type="text" class="form-input" 
                            name="client-type">
                            <option value="with">With Client</option>
                            <option value="without">Without Client</option>
                        </select>
                    </div>


                    <div id="inspection-date-block" class="col-span-1">
                        <label for="inspection-date" class="form-label required">Date</label>
                        <button type="button" class="form-input cursor-pointer" id="openDateTimePopupBtn">
                            <i class="fas fa-calendar-alt mr-2"></i> Choose date
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2 class="form-section-title mb-4">Client data</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                    <div>
                        <label for="first-name" class="form-label required">Your Name</label>
                        <input data-input-required type="text" name="name" id="buyer-name" class="form-input"
                            placeholder="James Wilson" 
                            @if (!empty($client)) value="{{ $client->name }}" @endif>
                    </div>

                    <div>
                        <label for="email" class="form-label required">Your Email</label>
                        <input data-input-required type="email" name="email" id="buyer-email" class="form-input"
                            placeholder="example@example.com" 
                            @if (!empty($client)) value="{{ $client->email }}" @endif>
                    </div>


                    <div>
                        <label for="phone" class="form-label required">Your Phone</label>
                        <input data-input-required type="tel" name="phone" id="buyer-phone" class="form-input"
                            placeholder="(123) 456-7890" 
                            @if (!empty($client)) value="{{ $client->phone }}" @endif>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="flex items-center gap-2 mb-4">
                    <h2 class="form-section-title">Vehicle Details</h2>
                </div>

                <div class="relative">

                    <div id="vehicles" class="flex flex-col gap-6 mb-6">
                        <div id="vehicle-1" class="relative">

                            <h3 class="font-bold text-lg uppercase mb-2 text-orange-600">Vehicle 1</h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="vehicle-1-year" class="form-label required">Vehicle Year</label>
                                    <input data-vehicle-year='vehicle-1' type="text" name="vehicle-1-year"
                                        id="vehicle-year" class="form-input" placeholder="e.g. 2006">
                                </div>

                                <div>
                                    <label for="vehicle-1-make" class="form-label required">
                                        Vehicle Make
                                    </label>
                                    <select data-vehicle-make="vehicle-1" type="text" name="vehicle-1-make"
                                        id="vehicle-1-make" class="form-input" placeholder="e.g. Ford">
                                        <option value="" selected disabled>Сhoose a make</option>
                                        @foreach ($carMakes as $make)
                                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="vehicle-1-model" class="form-label required">Vehicle Model</label>

                                    <select data-vehicle-model="vehicle-1" type="text" name="vehicle-1-model"
                                        id="vehicle-1-model" class="form-input" placeholder="e.g. Ford">
                                        <option value="" selected disabled>Сhoose a make</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="vin" class="form-label">VIN (optional)</label>
                                    <input data-vehicle-vin='vehicle-1' type="text" name="vehicle-1-vin"
                                        id="vehicle-1-vin" class="form-input" placeholder="VIN (Optional)">
                                </div>

                                <div>
                                    <label for="asking-price" class="form-label">Seller Asking Price
                                        (optional)</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">$</span>
                                        </div>
                                        <input data-vehicle-asking-price='vehicle-1' type="number"
                                            name="vehicle-1-asking-price" id="vehicle-1-asking-price"
                                            class="form-input !pl-8" placeholder="(Optional)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <button data-vehicle-add type="button"
                            class="w-48 h-6 px-2 flex items-center justify-center rounded-full border cursor-pointer text-orange-500 hover:text-orange-700 text-xs">
                            <i class="fa fa-plus mr-1"></i> Add another vehicle
                        </button>

                        <div data-visible-inspection-type='single' class="max-w-full w-96 mt-2 text-gray-700 text-sm">
                            <span class="block mb-2">
                                <i class="fa fa-dollar"></i>20% discount is applied to the 2nd inspection and any
                                further vehicle inspections.
                            </span>

                            <span class="block">
                                <i class="fa fa-info"></i>All vehicles should be situated in the same location (no
                                further than 1 mile away from each other). If you want to check vehicles at different
                                locations, please, order another inspection or consider Full Day inspection.
                            </span>
                        </div>

                        <div data-visible-inspection-type='full' class="max-w-full w-96 mt-2 text-gray-700 text-sm">
                            <span class="block mb-2">
                                <i class="fa fa-info"></i>Please provide an approximate list of vehicles to be
                                inspected. It will help our specialists to select necessary tools for inspection.
                            </span>
                        </div>

                    </div>

                </div>
            </div>

            <div id="inspection-vehicle-address-block" class="form-section">
                <h3 class="form-section-title mb-4 required">Vehicle Address</h3>
                <div class="relative">
                    <input data-address-lat="" data-address-long="" type="text" name="vehicle-address"
                        id="vehicle-address" class="form-input"
                        placeholder="e.g. 162 South Ave, Bloomington, MN 55425"  autocorrect="off"
                        autocomplete="off" autocapitalize="off">

                    <div id="vehicle-address-dropdown" class="vehicle-address-dropdown"></div>


                </div>
                <div class="relative hidden">
                    <label for="vehicle-address" class="form-label required">

                        ZIP Code

                    </label>
                    <input hidden type="text" name="vehicle-zip" id="vehicle-zip" class="form-input"
                        placeholder="55425">

                    <div id="vehicle-zip-dropdown" class="vehicle-zip-dropdown"></div>
                </div>
            </div>

            <div class="form-section">
                <h2 class="form-section-title mb-4">Seller Contact Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="dealer-name" class="form-label">Dealership Name (optional)</label>
                        <input type="text" name="dealer-name" id="dealer-name" class="form-input"
                            placeholder="Dealer/Name">
                    </div>


                    <div>
                        <label for="stock-number" class="form-label">Stock Number (optional)</label>
                        <input type="text" name="stock-number" id="stock-number" class="form-input"
                            placeholder="Stock Number">
                    </div>

                    <div>
                        <label for="seller-name" class="form-label required">Seller Contact Name</label>
                        <input data-input-required type="text" name="seller-name" id="seller-name" class="form-input"
                            placeholder="Seller Contact Name" >
                    </div>


                    <div>
                        <label for="seller-phone" class="form-label required">Seller Contact Phone</label>
                        <input data-input-required type="tel" name="seller-phone" id="seller-phone" class="form-input"
                            placeholder="Seller Contact Phone" >
                    </div>
                </div>
            </div>

            @if ($addons->count() > 0)
                <div class="form-section">
                    <h2 class="form-section-title mb-3">INSPECTION ADD-ONS</h2>

                    <div class="space-y-4">
                        @foreach ($addons as $addon)
                            <div class="addon-card @if (isset($selectedAddons[$addon->code])) selected @endif">
                                <div class="flex items-start">
                                    <input @if (isset($selectedAddons[$addon->code])) checked @endif
                                        data-inspection-addon='{{ $addon->code }}' type="checkbox"
                                        id="{{ $addon->code }}" class="mr-4 w-6 h-6">
                                    <div class="flex-1">
                                        <div class="flex flex-col md:flex-row justify-between items-start">
                                            <div>
                                                <label for="carfax-report"
                                                    class="flex gap-4 justify-between w-full text-md font-medium text-gray-900">
                                                    {{ $addon->name }}

                                                    @if ($addon->description)
                                                        <button type="button"
                                                            class="group relative vehicle-add-tooltip w-6 h-6 flex items-center justify-center rounded-full border cursor-pointer text-orange-500">

                                                            <i class="fa fa-info text-xs"></i>

                                                            <span
                                                                class="hidden group-focus:block group-hover:block border border-orange-500 rounded-md shadow-lg bg-white z-50 px-4 py-3 text-gray-700 absolute top-8 -right-4 w-64 text-sm">
                                                                {{ $addon->description }}
                                                            </span>

                                                        </button>
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="text-lg font-bold text-gray-900">${{ $addon->price }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endif

            <div class="form-section">
                <div class="mb-4">
                    <div class="text-gray-700 mb-8 max-h-96 overflow-y-scroll">
                        <h2 class="form-section-title !mb-0 !p-0">
                            TERMS AND CONDITIONS FOR MOBILE PRE-PURCHASE VEHICLE
                            INSPECTION SERVICES
                        </h2>
                        <p class="text-gray-600 mb-4">Effective Date: May 4, 2026</p>

                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">1. Overview</h3>
                            These Terms and Conditions ("Terms") govern the provision of mobile pre-purchase inspection
                            services ("Services") for used vehicles by Forma Systems LLC, doing business as Car
                            Inspection
                            Pro ("we," "us," or "our"). By requesting, scheduling, or accepting the Services, you
                            ("Customer," "you," or "your") agree to be bound by these Terms.
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">2. Services Provided</h3>

                            We offer mobile inspections of used vehicles, including a visual and basic mechanical
                            examination of the vehicle's exterior, interior, engine bay, and undercarriage (where
                            accessible).
                            <br><br>

                            <ul class="list-disc pl-6">
                                <li>An online report ("Report") will be provided summarizing findings for informational
                                    purposes
                                    only
                                </li>
                                <li>
                                    The Report does not constitute a certification, appraisal, or warranty
                                </li>
                                <li>
                                    Supplemental media (Test Drive videos, Paint Meter walkthroughs, etc.) are available
                                    as
                                    add-ons and are subject to the same visual limitations as the standard inspection
                                </li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">3. Payment and Travel Fees</h3>

                            <ul class="list-disc pl-6">
                                <li>Upfront Payment: Full payment for the Services is required immediately upon
                                    booking through our website. No inspection will be scheduled or commenced until the
                                    full payment has been confirmed.
                                </li>
                                <li>Travel Surcharges: A travel fee of $2.00 per mile applies for vehicles located
                                    beyond
                                </li>
                                <li>Distance Calculation: Distance is calculated based on the fastest one-way GPS
                                    driving route (Google Maps/Apple Maps) from the City Center to the vehicle's
                                    location. The first 50 miles are included in the base fee; the surcharge applies
                                    only to the miles exceeding this limit.
                                </li>
                                <li>Time Reservation: Travel fees cover both vehicle operating expenses and the
                                    professional time reserved for logistics. Because long-distance travel prevents us
                                    from scheduling other inspections, these fees are subject to the strict cancellation
                                    policy below.
                                </li>
                            </ul>
                        </div>


                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">
                                4. Scheduling and Cancellation Policy
                            </h3>

                            <ul class="list-disc pl-6">
                                <li>
                                    10% Service Fee: Every cancellation of a scheduled Inspection is subject to a 10%
                                    non-refundable Service Fee to cover payment processing (Stripe/Bank fees) and
                                    administrative costs
                                </li>
                                <li>
                                    Late Cancellation Fee: Any cancellation made less than 1 hour (60 minutes) before
                                    the scheduled appointment time will incur an additional $50 Late Cancellation Fee
                                </li>
                                <li>Travel Fee Refund Policy:
                                    <ul class="list-disc pl-6">
                                        <li>Travel fees (mileage surcharges) become non-refundable 1 hour (60 minutes)
                                            prior to the technician's scheduled departure time
                                        </li>
                                        <li>
                                            ○ Departure Time: This is determined by the estimated GPS travel time
                                            required to arrive at the appointment by the scheduled start time.

                                        </li>
                                        <li>
                                            ○ Example: If an inspection is scheduled for 4:00 PM and requires 3 hours of
                                            travel (departure at 1:00 PM), the travel fee becomes non-refundable at
                                            12:00 PM. If the Customer cancels after 12:00 PM, the travel fee is
                                            non-refundable as that time block was exclusively reserved.

                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    No-Show Policy: The Late Cancellation Fee ($50 + 10% Service Fee) and
                                    non-refundable Travel Fees apply if the vehicle is not present, is inaccessible, or
                                    if the seller refuses access at the time of the technician’s arrival
                                </li>
                            </ul>

                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">
                                5. Limitations and Disclaimers
                            </h3>

                            <ul class="list-disc pl-6">
                                <li>Visual Only: Our Inspection is limited to what is reasonably observable without
                                    disassembly. We do not remove components, use hoists, or perform emissions testing
                                </li>
                                <li>Hidden Issues: We are not liable for latent, intermittent, or hidden defects
                                    (e.g., internal engine issues or electrical faults) that are not detectable during a
                                    visual mobile inspection</li>
                                <li>Not a Warranty: The Report is a professional opinion at a specific point in time
                                    and is not a warranty or guarantee against future mechanical failures</li>
                                <li>Purchase Decisions: The final decision to purchase any vehicle rests solely with
                                    the Customer</li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">
                                6. Liability Limitations
                            </h3>

                            <ul class="list-disc pl-6">
                                <li>Maximum Liability: Our total liability for any claim arising from the Services is
                                    strictly limited to the base Inspection Fee paid by the Customer.
                                </li>
                                <li>Exclusions from Liability: This limit specifically excludes travel surcharges
                                    (mileage fees), administrative fees, or discretionary tips/gratuities. These amounts
                                    are non-recoverable as they represent completed logistics and voluntary payments.
                                </li>
                                <li>No Indirect Damages: We are not liable for any consequential, incidental, or
                                    punitive damages, including repair costs or loss of use</li>
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">
                                7. Governing Law and Venue
                            </h3>

                            <p>
                                These Terms are governed by the laws of the State of North Carolina. Any legal action or
                                proceeding related to these Terms must be brought exclusively in the courts of North
                                Carolina
                            </p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">
                                Contact & Business Information
                            </h3>

                            <p class="mb-2">
                                <b>Forma Systems LLC (DBA Car Inspection Pro)</b>
                            </p>

                            <ul class="list-disc pl-6 mb-2">
                                <li>Website: carinspection.pro</li>
                                <li>Email: info@carinspection.pro</li>
                                <li>Phone: 980-550-4645</li>
                                <li>Address: 4030 Wake Forest Road, Ste 349, Raleigh, NC 27609</li>
                            </ul>

                            <p>By proceeding with the Services, you confirm you are at least 18 years old and have read,
                                understood, and agree to these Terms and our <a class="text-blue-600 hover:text-blue-700" href="/privacy">Privacy Policy</a>.</p>
                        </div>

                    </div>

                    <p class="text-gray-700 font-bold border-t border-gray-400 pt-4">
                        You must read, and scroll, to the bottom of the terms and conditions before accepting them.
                    </p>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <input type="checkbox" name="terms" id="terms" class="w-6 h-6" >
                    <label for="terms" class="text-gray-700">
                        <span class="font-medium required"> I have READ and AGREE to the Terms and Conditions and
                            specifically acknowledge the Cancellation Policy</span>
                    </label>
                </div>
            </div>

            <div class="mt-8">
                <button id="submit-order" class="btn-primary text-white rounded-md w-full py-4 text-lg">
                    <i class="fas fa-paper-plane mr-2"></i> Submit Order
                </button>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b">Order Summary</h2>

                <div class="mt-6">
                    <h3 class="font-bold text-gray-900 mb-2">Main</h3>
                    <div class="pl-4 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <span data-inspection-name class="font-medium text-gray-700"></span>
                            <span data-inspection-price class="font-bold text-gray-900">$</span>
                        </div>
                        <div data-inspection-another-vehicle class="flex justify-between items-center mb-2 hidden">
                            <span class="font-medium text-gray-700">Another Vehicles</span>
                            <span data-inspection-another-vehicle-price class="font-bold text-gray-900"></span>
                        </div>
                    </div>
                </div>

                <div data-inspection-s-addons class="mt-6 @if (empty($selectedAddons)) hidden @endif">
                    <h3 class="font-bold text-gray-900 mb-2">Add-ons</h3>
                    <div data-inspection-s-addons-list class="pl-4">
                        @foreach ($selectedAddons as $selectedAddon)
                            <div data-inspection-s-addon-{{ $selectedAddon->code ?? '' }}
                                class="flex justify-between mb-2">
                                <span data-inspection-s-addon-name class="text-gray-700">
                                    {{ $selectedAddon->name ?? '' }}
                                </span>
                                <span data-inspection-s-addon-price class="font-medium text-gray-900">
                                    ${{ $selectedAddon->price ?? '' }}
                                </span>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div data-inspection-miles class="mt-6 hidden">
                    <div class="flex flex-col mb-2">
                        <h3 class="font-bold text-gray-900">Out of the Range</h3>

                        <span class="text-gray-700 text-sm">
                            Our standard service area covers a 50-mile distance from the City Center. If the vehicle is
                            located beyond this 50-mile limit, a travel surcharge of $2.00 per mile will apply to each
                            additional mile based on the actual one-way GPS driving route. This fee covers the
                            round-trip travel for our technician
                        </span>
                    </div>

                    <div data-inspection-miles-list class="pl-4 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <span data-inspection-miles-count class="font-medium text-gray-700">mi</span>
                            <span data-inspection-miles-amount class="font-bold text-gray-900">$</span>
                        </div>


                    </div>
                </div>


                {{-- <div class="mb-6">
                    <div class="flex justify-between">
                        <h3 class="text-gray-900 font-bold">Service Fee</h3>
                        <span class="font-medium text-gray-900">$49.00</span>
                    </div>
                </div> --}}


                <div class="pt-4 mt-6 border-t">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span data-inspection-total
                            class="text-2xl font-bold text-orange-600">$</span>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="dateTimePopup" class="popup-overlay hidden">
        <div class="popup-container">
            <div class="popup-header">
                <span class="popup-title">Choose date</span>
                <button class="close-btn" id="closeDateTimePopupBtn">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="popup-content">
                <div class="date-scroll-container">
                    <div class="date-label">
                        <i class="far fa-calendar-alt mr-1"></i> Select Date
                    </div>
                    <div id="dateScroll" class="date-scroll">
                        <!-- Date chips will be inserted here -->
                    </div>
                </div>

                <div>
                    <div class="time-label">
                        <i class="far fa-clock mr-1"></i> Select Time
                    </div>
                    <div id="timeGrid" class="time-grid">
                        <div class="no-slots">Select a date first</div>
                    </div>
                </div>

                <div class="legend">
                    <div class="legend-item">
                        <div class="legend-dot available"></div>
                        <span>Available</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot selected"></div>
                        <span>Selected</span>
                    </div>
                </div>

                <div class="flex w-full justify-between mt-3" id="selectedSummary" style="display: none;">
                    <div class="selected-info">
                        <div class="label">Selected</div>
                        <div class="value" id="selectedValue">—</div>
                    </div>
                    <button class="btn-primary w-24 h-8 rounded-md" id="confirmBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script></script>
</x-template>
