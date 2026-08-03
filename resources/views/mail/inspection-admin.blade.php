<x-template-mail>

    <style>
        .order-card {
            background-color: #fafafa;
            border-radius: 8px;
            padding: 16px;
            margin: 20px 0;
            border: 1px solid #f0f0f0;
        }

        .order-title {
            font-size: 13px;
            font-weight: 600;
            color: #f97316;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .order-row {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 4px;
            padding: 8px 0;
            font-size: 13px;
        }

        .order-row:first-of-type {
            border-bottom: 1px solid #e5e7eb;
        }

        .order-label {
            color: #6b7280;
        }

        .order-value {
            color: #1f2937;
            font-weight: 500;
        }

        .customer-info {
            background-color: #fef3c7;
            border-radius: 8px;
            padding: 12px;
            margin: 16px 0;
            font-size: 13px;
        }

        .customer-info .label {
            color: #92400e;
            font-weight: 500;
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .divider {
            height: 1px;
            background-color: #f0f0f0;
            margin: 16px 0;
        }

        .button {
            display: inline-block;
            background-color: #f97316;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 13px;
            text-align: center;
            transition: background-color 0.2s;
        }

        .button-outline {
            background-color: transparent;
            border: 1px solid #e5e7eb;
            color: #4b5563;
            margin-left: 12px;
        }

        .button-outline:hover {
            border-color: #f97316;
            color: #f97316;
            background-color: transparent;
        }

        .small-note {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 16px;
            text-align: center;
        }

        .footer {
            padding: 20px 24px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
            background-color: #fafafa;
        }

        .footer-text {
            font-size: 11px;
            color: #9ca3af;
            line-height: 1.5;
        }

        .footer-text a {
            color: #f97316;
            text-decoration: none;
        }

        @media (max-width: 480px) {
            .email-body {
                padding: 20px;
            }

            .button-group {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .button-outline {
                margin-left: 0;
            }
        }
    </style>

    <div class="email-body">
        <p class="greeting">
            New inspection order
        </p>

        <div class="order-card">
            <div class="order-title">Order #{{ $order->number }}</div>
            <div class="order-row">
                <span class="order-label">Vehicle</span>
                <span class="order-value">{{ $vehicle?->name }}</span>
            </div>
            <div class="order-row">
                <span class="order-label">Service</span>
                <span class="order-value">{{ $package->name }}</span>
            </div>
            <div class="order-row">
                <span class="order-label">Location</span>
                <span class="order-value">{{ $inspection->vehicle_address }}</span>
            </div>
            <div class="order-row">
                <span class="order-label">Total</span>
                <span class="order-value">${{ $order->total }}</span>
            </div>
        </div>

        <div style="margin: 20px 0;">
            <a href="{{env('APP_URL')}}/h-admin/inspection/{{$inspection->id}}" class="button"
                style="display: block; text-align: center; color: white;">
                Inspection
            </a>
        </div>
    </div>

</x-template-mail>
