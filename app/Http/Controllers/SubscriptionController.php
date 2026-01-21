<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
        public function charge($clientId, \Illuminate\Http\Request $request)
    {
        $client = \App\Models\Client::findOrFail($clientId);
        $validated = $request->validate([
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'card_id' => 'required|exists:cards,id',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'note' => 'nullable|string',
        ]);
        $subscription = \App\Models\Subscription::create([
            'client_id' => $client->id,
            'subscription_plan_id' => $validated['subscription_plan_id'],
            'card_id' => $validated['card_id'],
            'price' => $validated['price'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'active',
        ]);
        $card = \App\Models\Card::findOrFail($validated['card_id']);
        // Optionally deduct price from card balance here if needed
        return response()->json([
            'message' => 'Client charged for subscription (monthly) successfully.',
            'client_id' => $client->id,
            'subscription' => [
                'id' => $subscription->id,
                'plan' => $subscription->plan->name ?? null,
                'price' => (float)$subscription->price,
                'start_date' => $subscription->start_date,
                'end_date' => $subscription->end_date,
                'card_id' => $card->id,
                'created_at' => $subscription->created_at,
            ],
            'card' => [
                'id' => $card->id,
                'nfc_uid' => $card->nfc_uid,
                'balance' => (float)$card->balance,
            ],
        ]);
    }
    public function index()
    {
        $subscriptions = Subscription::with('client')->paginate(20);
        return SubscriptionResource::collection($subscriptions);
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $data = $request->validated();
        $subscription = Subscription::create($data);
        return new SubscriptionResource($subscription->load('client'));
    }

    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription->load('client'));
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());
        return new SubscriptionResource($subscription->fresh()->load('client'));
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->json(['message' => 'Subscription deleted successfully']);
    }
}
