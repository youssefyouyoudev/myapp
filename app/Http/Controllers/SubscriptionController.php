<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
        public function charge($clientId, \Illuminate\Http\Request $request)
    {
        try {
            $validated = $request->validate([
                // 'uuid' => 'required|uuid|unique:subscriptions,uuid',
                'subscription_plan_id' => 'required|exists:subscription_plans,id',
                'card_uuid' => 'required|exists:cards,uuid',
                'price' => 'required|numeric',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'note' => 'nullable|string',
            ]);
            $card = \App\Models\Card::where('uuid', $validated['card_uuid'])->firstOrFail();
            $data = $validated;
            $data['card_id'] = $card->id;
            $data['client_id'] = $card->client_id;
            $data['uuid'] = $request->uuid ?? (string) \Illuminate\Support\Str::uuid();
            unset($data['card_uuid']);
            // Check for existing active subscription for this card/client
            $subscription = \App\Models\Subscription::where('client_id', $data['client_id'])
                ->where('card_id', $data['card_id'])
                ->where('status', 'active')
                ->first();
            if ($subscription) {
                $subscription->update($data);
            } else {
                $subscription = \App\Models\Subscription::create($data);
            }
            // Store payment record
            \App\Models\Payment::create([
                'uuid' => (string) \Illuminate\Support\Str::uuid(),
                'user_id' => $request->user_id ?? null,
                'client_id' => $subscription->client_id,
                'card_id' => $subscription->card_id,
                'amount' => $subscription->price,
                'method' => 'espece',
                'reference' => null,
            ]);
            $this->logUserAction('charge_subscription', 'Subscription', $subscription->id, [
                'request' => $request->all(),
                'subscription_id' => $subscription->id,
            ]);
            // Optionally deduct price from card balance here if needed
            return response()->json([
                'message' => 'Client charged for subscription (monthly) successfully.',
                'client_id' => $subscription->client_id,
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error in charge:', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Error 500 in charge:', [
                'exception' => $e->getMessage(),
                'input' => $request->all()
            ]);
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }
    public function index()
    {
        $subscriptions = Subscription::with('client')->paginate(20);
        return SubscriptionResource::collection($subscriptions);
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $data = $request->validated();
        // Always set card_id and client_id
        if (isset($data['card_uuid'])) {
            $card = \App\Models\Card::where('uuid', $data['card_uuid'])->firstOrFail();
            $data['card_id'] = $card->id;
            $data['client_id'] = $card->client_id;
            unset($data['card_uuid']);
        } elseif (isset($data['card_id'])) {
            $card = \App\Models\Card::findOrFail($data['card_id']);
            $data['client_id'] = $card->client_id;
        } else {
            abort(422, 'card_uuid or card_id is required');
        }
        $subscription = Subscription::create($data);
        $this->logUserAction('create_subscription', 'Subscription', $subscription->id, [
            'request' => $request->all(),
            'subscription_id' => $subscription->id,
        ]);
        return new SubscriptionResource($subscription->load('client'));
    }

    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription->load('client'));
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());
        $this->logUserAction('update_subscription', 'Subscription', $subscription->id, [
            'request' => $request->all(),
            'subscription_id' => $subscription->id,
        ]);
        return new SubscriptionResource($subscription->fresh()->load('client'));
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        $this->logUserAction('delete_subscription', 'Subscription', $subscription->id);
        return response()->json(['message' => 'Subscription deleted successfully']);
    }
}
