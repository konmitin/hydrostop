<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $objects = Order::paginate(20);

        return response([
            'data' => OrderResource::collection($objects->items()),
            'count' => Order::count()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $order = new Order();
        $order->fill($request->all());

        $order->amount = preg_replace("/[^\d.]/", "", $request->amount);

        if (isset($request->client_id)) {
            $client = Client::find($request->client_id);

            if (!$client) {
                return response([
                    'errors' => [
                        'branch' => ['Указанный клиент не найден, укажите другого']
                    ]
                ], 422);
            }

            $order->client()->associate($client->id);
        }

        if (isset($request->branch_id)) {
            $branch = Branch::find($request->branch_id);

            if (!$branch) {
                return response([
                    'errors' => [
                        'branch' => ['Указанный город не найден, выберите другой']
                    ]
                ], 422);
            }

            $order->branch()->associate($branch->id);
        }

        $order->save();

        return response([
            'data' => $order,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response([
            'data' => new OrderResource($order),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $order->fill($request->all());

        $order->amount = preg_replace("/[^\d.]/", "", $request->amount);

        if (isset($request->client['id'])) {
            $client = Client::find($request->client['id']);

            if (!$client) {
                return response([
                    'errors' => [
                        'branch' => ['Указанный клиент не найден, укажите другого']
                    ]
                ], 422);
            }

            $order->client()->associate($client->id);
        }

        if (isset($request->branch['id'])) {
            $branch = Branch::find($request->branch['id']);

            if (!$branch) {
                return response([
                    'errors' => [
                        'branch' => ['Указанный город не найден, выберите другой']
                    ]
                ], 422);
            }

            $order->branch()->associate($branch->id);
        }

        $order->save();

        return response([
            'data' => new OrderResource($order),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
