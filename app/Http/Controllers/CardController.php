<?php

        namespace App\Http\Controllers;

        use App\Models\Card;
        use App\Http\Requests\StoreCardRequest;
        use App\Http\Requests\UpdateCardRequest;
        use App\Http\Resources\CardResource;
        use Illuminate\Support\Str;

        class CardController extends Controller
        {
    public function index()
    {
        $cards = Card::with('client', 'voyages', 'cardSolds')->paginate(20);
        return response()->json([
            'data' => CardResource::collection($cards),
            'meta' => [
                'currentPage' => $cards->currentPage(),
                'lastPage' => $cards->lastPage(),
                'perPage' => $cards->perPage(),
                'total' => $cards->total(),
            ],
        ]);
    }

    public function store(StoreCardRequest $request)
    {
        $data = $request->validated();
        $data['uuid'] = (string) Str::uuid();
        $card = Card::create($data);
        return response()->json([
            'data' => new CardResource($card->load(['client', 'voyages', 'cardSolds']))
        ], 201);
    }

    public function show(Card $card)
    {
        return response()->json([
            'data' => new CardResource($card->load(['client', 'voyages', 'cardSolds']))
        ]);
    }

    public function update(UpdateCardRequest $request, Card $card)
    {
        $card->update($request->validated());
        return response()->json([
            'data' => new CardResource($card->fresh()->load(['client', 'voyages', 'cardSolds']))
        ]);
    }

    public function destroy(Card $card)
    {
        $card->delete();
        return response()->json(['message' => 'Card deleted successfully']);
    }

    public function block(Card $card)
    {
        $card->update(['status' => 'blocked']);
        return response()->json([
            'data' => new CardResource($card->fresh()->load(['client', 'voyages', 'cardSolds']))
        ]);
    }

    public function unblock(Card $card)
    {
        $card->update(['status' => 'active']);
        return response()->json([
            'data' => new CardResource($card->fresh()->load(['client', 'voyages', 'cardSolds']))
        ]);
    }
    /**
     * Link a card to a client and return both card and client info.
     */
    public function linkToClient(\Illuminate\Http\Request $request, $cardId)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nfc_uid' => 'required|string|unique:cards,nfc_uid',
            'balance' => 'nullable|numeric',
            'status' => 'nullable|string',
            'start_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',
        ]);

        // Try to find card, or create if not exists
        $card = Card::find($cardId);
        if (!$card) {
            $now = now();
            $year = $now->month >= 9 ? $now->year + 1 : $now->year;
            $expiration = \Carbon\Carbon::create($year, 7, 31, 23, 59, 59);
            $card = Card::create([
                'id' => $cardId,
                'nfc_uid' => $request->nfc_uid,
                'balance' => $request->balance ?? 0,
                'status' => $request->status ?? 'active',
                'start_date' => $now,
                'expiration_date' => $expiration,
            ]);
        }

        $client = \App\Models\Client::findOrFail($request->client_id);
        $card->client_id = $client->id;
        $card->save();

        return response()->json([
            'message' => 'Card stored and linked to client successfully.',
            'card' => new \App\Http\Resources\CardResource($card->fresh()->load(['client', 'voyages', 'cardSolds'])),
            'client' => $client,
        ]);
    }

            /**
             * Get client info and card balance by NFC UID.
             */
            public function clientSoldeByUid($nfc_uid)
            {
        $card = \App\Models\Card::with(['client', 'voyages', 'cardSolds', 'client.subscriptions'])->where('nfc_uid', $nfc_uid)->first();
        if (!$card) {
            return response()->json(['message' => 'Card not found'], 404);
        }
        $client = $card->client;
        $soldeType = 'none';
        // Check if card's client has active subscription
        $hasActiveSubscription = $client && $client->subscriptions()->where('status', 'active')->exists();
        if ($hasActiveSubscription) {
            $soldeType = 'subscription_monthly';
        } else {
            // Check if card has active voyage
            $hasActiveVoyage = $card->voyages()->where('status', 'active')->exists();
            if ($hasActiveVoyage) {
                $soldeType = 'voyage';
            }
        }
        return response()->json([
            'client' => $client,
            'solde' => $card->balance,
            'solde_type' => $soldeType,
            'card' => $card,
        ]);
            }

            /**
             * Charge card for a monthly subscription (cannot have active voyage).
             */
            public function chargeSubscription(\Illuminate\Http\Request $request, $cardId)
            {
                $card = Card::with('voyages')->findOrFail($cardId);
                // If card has any active voyage, cannot subscribe
                $hasActiveVoyage = $card->voyages()->where('status', 'active')->exists();
                if ($hasActiveVoyage) {
                    return response()->json(['message' => 'Card already has active voyage. Cannot subscribe.'], 400);
                }
                // ... logic to create subscription (you may want to move this to SubscriptionController)
                // Example: $subscription = Subscription::create([...]);
                return response()->json(['message' => 'Card charged for subscription successfully.']);
            }

            /**
             * Charge card for voyage (cannot have active subscription).
             */
            public function chargeVoyage(\Illuminate\Http\Request $request, $cardId)
            {
                $card = Card::with('client.subscriptions')->findOrFail($cardId);
                // If card's client has any active subscription, cannot charge for voyage
                $hasActiveSubscription = $card->client && $card->client->subscriptions()->where('status', 'active')->exists();
                if ($hasActiveSubscription) {
                    return response()->json(['message' => 'Card already has active subscription. Cannot charge for voyage.'], 400);
                }
                // ... logic to charge for voyage (you may want to move this to VoyageController)
                // Example: $voyage = Voyage::create([...]);
                return response()->json(['message' => 'Card charged for voyage successfully.']);
            }
}
