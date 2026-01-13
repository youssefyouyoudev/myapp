<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return Client::paginate(20);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'status' => 'required|in:active,suspended',
            'cin' => 'required|string|max:255|unique:clients,cin',
            'date_of_birth' => 'required|date',
            'school' => 'required|string|max:255',
        ]);

        $client = Client::create($validated);
        return response()->json($client, 201);
    }

    public function show(Client $client)
    {
        return response()->json($client);
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'full_name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:active,suspended',
            'cin' => 'sometimes|string|max:255|unique:clients,cin,' . $client->id,
            'date_of_birth' => 'sometimes|date',
            'school' => 'sometimes|string|max:255',
        ]);

        $client->update($validated);
        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully']);
    }
}
