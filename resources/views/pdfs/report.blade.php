<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report->number }}</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap">
    <link rel="icon" href="/storage/img/favicon.svg" type="image/svg+xml">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #1f2937;
            background-color: #f9fafb;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            padding: 2rem 1.5rem;
        }

        .report-container {
            max-width: 72rem;
            margin-left: auto;
            margin-right: auto;
        }

        .card {
            background-color: #ffffff;
            padding: 1.5rem 1rem;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1rem;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .grid-2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .grid-3 {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .grid-bottom {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .grid-bottom {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .vehicle-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
        }

        .vehicle-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #4b5563;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .info-item {
            padding: 0.5rem 0;
            border-bottom: 1px dashed #e5e7eb;
        }

        .info-label {
            font-size: 0.7rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .info-value {
            font-weight: 500;
            color: #1f2937;
            margin-top: 0.2rem;
        }


        .status-ok {
            color: #2e7d32;
            font-weight: 600;
            display: inline-block;
            font-size: 0.875rem;
        }

        .status-replace {
            color: #c62828;
            font-weight: 600;
            display: inline-block;
            font-size: 0.875rem;
        }


        .test-group-card {
            background-color: #ffffff;
            padding: 0.5rem 1.5rem;
            height: 100vh;
        }

        .report-section-title {
            font-size: 1rem;
            font-weight: 700;
            color: #111827;
            position: relative;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .test-item-row {
            display: flex;
            gap: 20px;
            /* align-items: center; */
            /* justify-content: space-between;  */
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(75, 85, 99, 0.2);
            margin-bottom: 0.5rem;
        }

        .test-item-name {
            display: inline-block;
            margin-right: 120px;
            font-weight: 500;
            color: #111827;
            margin: 0;
        }

        .comment-box {
            background-color: #f9f9f9;
            border-left: 2px solid #f97316;
            border-right: 2px solid #f97316;
            padding: 0.75rem 1rem;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            color: #4b5563;
        }


        .tab-section-title {
            font-size: 1.125rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 1px solid #e5e7eb;
            border-bottom: 2px solid #ea580c;
            text-align: center;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            background-color: #ffffff;
            padding: 1rem;
            margin-top: 1.5rem;
        }


        .summary-stats {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-label {
            color: #4b5563;
            margin-right: 0.5rem;
        }

        .stat-value {
            font-weight: 700;
            color: #111827;
        }

        .stat-value-green {
            font-weight: 700;
            color: #16a34a;
        }

        .stat-value-orange {
            font-weight: 700;
            color: #ea580c;
        }

        .recommendation-box {
            background-color: #fff7ed;
            border: 1px solid #ffedd5;
            margin-top: 1rem;
            padding: 1.5rem;
            max-width: 42rem;
            display: flex;
            align-items: flex-start;
        }


        .progress-bar-bg {
            width: 5rem;
            height: 0.375rem;
            background-color: #e5e7eb;
            border-radius: 9999px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background-color: #22c55e;
            border-radius: 9999px;
        }


        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .flex-col {
            flex-direction: column;
        }

        .items-end {
            align-items: flex-end;
        }

        .flex-shrink-0 {
            flex-shrink: 0;
        }

        .text-center {
            text-align: center;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mt-8 {
            margin-top: 2rem;
        }

        .mb-8 {
            margin-bottom: 2rem;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .mr-3 {
            margin-right: 0.75rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .gap-4 {
            gap: 1rem;
        }

        .gap-6 {
            gap: 1.5rem;
        }

        .max-w-2xl {
            max-width: 42rem;
        }

        .max-w-24 {
            max-width: 6rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .font-medium {
            font-weight: 500;
        }

        .font-bold {
            font-weight: 700;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .text-gray-700 {
            color: #374151;
        }

        .text-gray-900 {
            color: #111827;
        }

        .text-green-600 {
            color: #16a34a;
        }

        .text-orange-600 {
            color: #ea580c;
        }
    </style>
</head>

<body>

    <main class="report-container">

        {{-- R HEADER --}}
        <div class="header-flex">
            <div>
                <h1 class="vehicle-title">{{ $vehicle->name }}</h1>
                <div class="vehicle-meta">
                    <span>{{ date('M d, Y', strtotime($report->created_at)) }}</span>
                </div>
            </div>
        </div>

        {{-- VEHICLE DETAILS --}}
        <div class="card">
            <h2 class="section-title">Vehicle Details</h2>
            <div class="grid-3">
                <div>
                    <div class="info-item">
                        <div class="info-label">Price</div>
                        <div class="info-value">${{ number_format($vehicle->asking_price, 0, '.', ',') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">VIN</div>
                        <div class="info-value">{{ $vehicle->vin }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Make</div>
                        <div class="info-value">{{ $vehicle->make()->first()->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Model</div>
                        <div class="info-value">{{ $vehicle->model()->first()->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Year</div>
                        <div class="info-value">{{ $vehicle->year }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Mileage</div>
                        <div class="info-value">{{ number_format($vehicle->mileage, 0, '.', ',') }} mi</div>
                    </div>

                    @if ($vehicle->stock_number)
                        <div class="info-item">
                            <div class="info-label">Stock Number</div>
                            <div class="info-value">{{ $vehicle->stock_number }}</div>
                        </div>
                    @endif
                    @if ($vehicle->link)
                        <div class="info-item">
                            <div class="info-label">Link to Vehicle Listing</div>
                            <div href="" class="info-value">{{ $vehicle->link }}</div>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="info-item">
                        <div class="info-label">Body Style</div>
                        <div class="info-value">{{ $vehicle->body_color ?? '' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Color - Interior</div>
                        <div class="info-value">{{ $vehicle->interior_color ?? '' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Engine</div>
                        <div class="info-value">{{ $vehicle->engine ?? '' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Transmission</div>
                        <div class="info-value">{{ $vehicle->transmission()->first()->name ?? '' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Fuel Type</div>
                        <div class="info-value">{{ $vehicle->fuel()->first()->name ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SUMMARY --}}
        <div class="card">
            <h2 class="section-title">Summary</h2>
            <div class="summary-stats">
                <div class="stat-item"><span class="stat-label">Total items checked:</span><span
                        class="stat-value">{{ count($report->tests) }}</span></div>
                <div class="stat-item"><span class="stat-label">Passed (OK):</span><span
                        class="stat-value-green">{{ count($report->tests()->where('type', '<>', 'attention')->get()) }}</span>
                </div>
                <div class="stat-item"><span class="stat-label">Attention needed:</span><span
                        class="stat-value-orange">{{ count($report->tests()->where('type', 'attention')->get()) }}</span>
                </div>
            </div>
        </div>

        {{-- SUMMARY --}}
        <div class="card">
            <div class="max-w-2xl">
                <div class="font-bold text-gray-900 mb-2">Inspector notes:</div>
                <p class="text-sm text-gray-900">{{ $report->description }}</p>
            </div>
            <div class="recommendation-box">
                <div>
                    <div class="font-bold text-gray-900">Inspector recommendation</div>
                    <p class="text-sm text-gray-700">{{ $report->recommendation }}</p>
                </div>
            </div>
        </div>

        {{-- BOTTOM INFO --}}
        <div class="card">
            <div class="grid-bottom">
                <div>
                    <div class="text-xs text-gray-500 uppercase">Condition</div>
                    <div class="flex items-center mt-1">
                        <span class="font-bold text-gray-900 mr-3">{{ $report->conditionValue ?? 0 }}%</span>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width: {{ $report->conditionValue ?? 0 }}%"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 uppercase">Inspector</div>
                    <div class="font-medium text-gray-900 mt-1">{{ $order->responsible()->first()->name }}</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 uppercase">Report #</div>
                    <div class="font-medium text-gray-900 mt-1">{{ $report->number }}</div>
                </div>
            </div>
        </div>

        {{-- TESTS --}}
        @foreach ($groupType as $key => $type)
            <h3 class="tab-section-title">{{ $type->name }}</h3>
            <div class="grid-1 mt-4 mb-8">
                @foreach ($report->groups as $group)
                    @if ($group->type_id == $type->id && $group->hiddenTests < count($group->tests))
                        <div class="test-group-card">
                            <h3 class="report-section-title">{{ $group->name }}</h3>
                            <div class="flex flex-col gap-2">
                                @foreach ($group->tests as $test)
                                    @if (
                                        $test->group_id == $group->id &&
                                            ($test->type == 'no' || $test->type == 'ok' || $test->type == 'force-ok' || $test->type == 'attention'))
                                        @if ($test->value_type == 'text')
                                            <div class="test-item-row">
                                                <div class="test-item-name">{{ $test->name }}</div>
                                                <div @class([
                                                    'status-ok' => $test->type == 'no' || $test->type == 'ok',
                                                    'status-replace' => $test->type == 'attention',
                                                    'max-w-24 py-1 flex-shrink-0',
                                                ])>
                                                    <span class="text-sm font-medium">
                                                        @if ($test->type == 'ok')
                                                            OK
                                                        @elseif($test->type == 'no')
                                                            NO
                                                        @elseif($test->type == 'attention')
                                                            Attention
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @if ($test->type == 'attention')
                                                <div class="comment-box">{{ $test->comment }}</div>
                                            @endif
                                        @endif
                                        @if ($test->value_type == 'insert')
                                            <div class="test-item-row">
                                                <div class="test-item-name">{{ $test->name }}</div>
                                                <div @class([
                                                    'status-ok' => $test->type == 'force-ok' || $test->type == 'ok',
                                                    'status-replace' => $test->type == 'attention',
                                                    'py-1 flex-shrink-0',
                                                ])>
                                                    <span
                                                        class="text-sm font-medium">{{ $test->value ?? $test->default_value }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach

        @foreach ($frontImage as $image)
            <img src="{{ $image->path }}" alt="{{ $image->name }}" class="w-full h-full object-cover mt-8">
        @endforeach

        @foreach ($images as $image)
            @if (is_int(strpos($image->mime, 'image')))
                <img src="{{ $image->path }}" alt="{{ $image->name }}" class="w-full h-full object-cover mt-8">
            @endif
        @endforeach

    </main>
</body>

</html>
