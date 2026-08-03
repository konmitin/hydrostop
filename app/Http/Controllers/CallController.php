<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CallController extends Controller
{
    public function store(Request $request)
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

        $client = Client::where('phone', $request->phone)->first();

        if (!$client && isset($request->email)) {
            $client = Client::where('email', $request->email)->first();
        }

        if(!$client) {
            $client = new Client;
            $client->name = $request->name;
            $client->phone = $request->phone ?? '';
            $client->email = $request->email ?? '';

            $client->save();
        }

        $call = new Call();
        $call->fill($request->all());

        $call->client_id = $client->id;
        $call->save();

        return response([
            'data' => $call
        ]);
    }
}
