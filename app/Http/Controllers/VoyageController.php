<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use App\Models\Card;
use App\Models\CardSold;
use App\Models\Subscription;
use App\Http\Requests\StoreVoyageRequest;
use App\Http\Resources\VoyageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VoyageController extends Controller
{

    /**
     * Charge a client for a voyage.
     */
    public function charge($clientId, \Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'uid' => 'required|uuid|unique:voyages,uuid',
            'voyage_plan_id' => 'required|exists:voyage_plans,id',
            'card_uuid' => 'required|exists:cards,uuid',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
        ]);
        $card = \App\Models\Card::where('uuid', $validated['card_uuid'])->firstOrFail();
        $data = $validated;
        $data['card_id'] = $card->id;
        $data['client_id'] = $card->client_id;
        unset($data['card_uuid']);
        // Optionally deduct amount from card balance here if needed
        $voyage = \App\Models\Voyage::create($data);
        return response()->json([
            'message' => 'Client charged for voyage successfully.',
            'client_id' => $card->client_id,
            'voyage' => [
                'id' => $voyage->id,
                'plan' => $voyage->plan->name ?? null,
                'amount' => (float)$voyage->amount,
                'card_id' => $card->id,
                'scanned_at' => $voyage->scanned_at,
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
        $voyages = Voyage::with('card')->paginate(20);
        return VoyageResource::collection($voyages);
    }

    public function store(StoreVoyageRequest $request)
    {
        $data = $request->validated();
        $card = Card::where('uuid', $data['card_uuid'])->firstOrFail();
        $amount = $data['amount'];

        // Check card status
        if ($card->status !== 'active') {
            return response()->json(['message' => 'Card is not active'], 400);
        }

        // Check subscription
        $subscription = $card->client->subscriptions()->where('status', 'active')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();
        if (!$subscription) {
            return response()->json(['message' => 'No active subscription'], 400);
        }

        // Check balance
        if ($card->balance < $amount) {
            return response()->json(['message' => 'Insufficient balance'], 400);
        }

        DB::transaction(function () use ($card, $amount, $data) {
            $old = $card->balance;
            $card->balance -= $amount;
            $card->save();
            $voyage = Voyage::create([
                'uuid' => $data['uuid'], // Use uuid from request (NFC)
                'card_id' => $card->id,
                'client_id' => $card->client_id,
                'voyage_plan_id' => $data['voyage_plan_id'] ?? null,
                'amount' => $amount,
                'scanned_at' => now(),
            ]);
            CardSold::create([
                'card_id' => $card->id,
                'old_balance' => $old,
                'new_balance' => $card->balance,
                'reason' => 'voyage',
                'created_at' => now(),
            ]);
        });
        return response()->json(['message' => 'Voyage recorded successfully']);
    }

    public function show(Voyage $voyage)
    {
        return new VoyageResource($voyage->load('card'));
    }
}
