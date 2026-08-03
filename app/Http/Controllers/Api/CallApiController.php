<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CallResource;
use App\Models\Call;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CallApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'data' => CallResource::collection(Call::paginate(20)->items()),
            'count' => Call::count()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Call $call)
    {
        return response([
            'data' => new CallResource($call),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Call $call)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $call->fill($request->all());

        if (isset($request->client['id']) && $call->client_id != $request->client['id']) {
            $client = Client::where('phone', $request->phone)->first();

            if (!$client) {
                return response([
                    'errors' => [
                        'client' => 'Указанный клиент не существует, укажите другого, либо попробуйте снова'
                    ]
                ], 422);
            }

            $call->client_id = $client->id;
        }

        $call->save();

        return response([
            'data' => new CallResource($call),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Call $call)
    {
        //
    }
}
