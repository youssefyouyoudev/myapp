<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('user', 'cards', 'payments', 'subscriptions')->paginate(20);
        return ClientResource::collection($clients);
    }
    public function store(StoreClientRequest $request)
    {
        try {
            $data = $request->validated();
            // $data['uuid'] = Str::uuid();
            $client = Client::create($data);
            return new ClientResource($client->load('user', 'cards', 'payments', 'subscriptions'));
        } catch (\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTrace()
                ]
            ], 500);
        }
    }

    public function show(Client $client)
    {
        return new ClientResource($client->load('user', 'cards', 'payments', 'subscriptions'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return new ClientResource($client->fresh()->load('user', 'cards', 'payments', 'subscriptions'));
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully']);
    }
}
