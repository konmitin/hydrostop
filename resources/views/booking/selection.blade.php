<x-template title="Booking Selection | Car Inspection">
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

    <form id="selection-form" class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-4 py-8">

        <div class="lg:col-span-2">

            <div class="form-section">
                <h2 class="form-section-title mb-4 required">Branch</h2>
                <div class="w-48">
                    <select data-inspection-branche type="text" class="form-input" name="branche">
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
                <h2 class="form-section-title mb-4 required">Selection INFO</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="">
                        <label for="package" class="form-label required">Package</label>
                        <select data-inspection-type type="text" class="form-input" name="package">
                            @foreach ($packages as $package)
                                <option value="{{ $package->code }}"
                                    @if ($type->code == $package->code) {{ 'selected' }} @else @endif>
                                    {{ $package->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="make-model" class="form-label required">Make & Model Preference</label>
                        <input data-input-required type="text" name="make-model" id="make-model" class="form-input"
                            placeholder="Toyota RAV4, BMW X6">
                    </div>

                    <div>
                        <label for="max-mileage" class="form-label">Maximum Mileage</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500"></span>
                            </div>
                            <input type="number" name="max-mileage" id="max-mileage" class="form-input"
                                placeholder="65,000">
                        </div>
                    </div>

                    <div>
                        <label for="budget" class="form-label required">Budget for the Vehicle</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">$</span>
                            </div>
                            <input data-input-required type="number" name="budget" id="budget"
                                class="form-input !pl-8" placeholder="5,000">
                        </div>
                    </div>

                    <div>
                        <label for="details" class="form-label">Additional Details</label>
                        <textarea type="text" name="details" id="details" class="form-input !pt-2 min-h-48"
                            placeholder="Color, trim level, or specific features"></textarea>
                    </div>
                </div>
            </div>

            @if ($addons->count() > 0)
                <div class="form-section">
                    <h2 class="form-section-title mb-3">ADD-ONS</h2>

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
                            TERMS OF REQUEST FOR CAR SELECTION SERVICES
                        </h2>
                        <p class="text-gray-600 mb-4">Effective Date: May 4, 2026</p>

                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">1. Overview & Purpose</h3>
                            These Terms govern the submission of a vehicle search request ("Request") through our
                            website.
                            By submitting this form, you ("Customer," "you," or "your") authorize Forma Systems LLC, dba
                            Car
                            Inspection Pro ("we," "us," or "our") to review your criteria and contact you regarding our
                            professional Car Selection and concierge services.
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">2. No Financial Obligation at Submission
                            </h3>

                            Free Initial Request: Submitting this online request form is completely free and does not
                            obligate you to purchase our services.

                            Individual Consultation: All Car Selection services are customized based on your budget,
                            preferences, and location.
                            <br><br>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">3. Formal Agreement & Payments</h3>


                            Separate Contract Required: No vehicle search, sourcing, or bidding will commence based
                            solely
                            on this online form.

                            Retainer & Fees: If you decide to proceed with our Car Selection service, a separate,
                            legally
                            binding Individual Service Agreement outlining the exact scope of work, retainer fees,
                            success
                            fees, and refund policies must be signed by both parties, and payment must be cleared prior
                            to
                            the start of the search.
                        </div>


                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">
                                4. Privacy & Communication Consent
                            </h3>


                            By clicking "Submit" or "Agree," you explicitly consent to the following:

                            We may contact you via phone, text message (SMS), or email using the contact details you
                            provided to discuss your vehicle preferences.

                            Your data will be handled strictly in accordance with our <a href="/privacy"
                                class=""></a>Privacy Policy and will never be
                            sold
                            to third parties.

                        </div>

                    </div>

                    <p class="text-gray-700 font-bold border-t border-gray-400 pt-4">
                        You must read, and scroll, to the bottom of the terms and conditions before accepting them.
                    </p>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <input type="checkbox" name="terms" id="terms" class="w-6 h-6">
                    <label for="terms" class="text-gray-700">
                        <span class="font-medium required"> By submitting this request, I agree to the Terms of Request
                            and Privacy Policy, and consent to receive emails, calls, or text messages from Car
                            Inspection Pro regarding my vehicle search</span>
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
                        <span data-inspection-total class="text-2xl font-bold text-orange-600">$</span>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script></script>
</x-template>
