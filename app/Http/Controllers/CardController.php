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
    public function linkToClient(\Illuminate\Http\Request $request, $nfcUid)
{
    // 1. Validate that the client_id exists.
    $request->validate([
        'client_id' => 'required|exists:clients,id',
    ]);

    // 2. Find a card by its nfc_uid, or prepare to create a new one.
    // This assumes you have a unique 'nfc_uid' column on your 'cards' table.
    $card = \App\Models\Card::firstOrNew(['nfc_uid' => $nfcUid]);

    // 3. If the card is new (i.e., it doesn't exist in the database yet),
    //    set its default properties.
    if (!$card->exists) {
        $now = now();
        // Set expiration to July 31st of the next school year
        $year = $now->month >= 9 ? $now->year + 1 : $now->year;
        $expiration = \Carbon\Carbon::create($year, 7, 31, 23, 59, 59);

        $card->balance = 0;
        $card->status = 'active';
        $card->start_date = $now;
        $card->expiration_date = $expiration;
        $card->uuid = $nfcUid;
    }

    // 4. Find the client and link it to the card.
    $client = \App\Models\Client::findOrFail($request->client_id);
    $card->client_id = $client->id;

    // 5. Save the card. This will either INSERT a new card or UPDATE the existing one.
    $card->save();

    // 6. Return a success response.
    return response()->json([
        'message' => 'Card linked to client successfully.',
        'card' => new \App\Http\Resources\CardResource($card->fresh()->load(['client', 'voyages', 'cardSolds'])),
        'client' => $client,
    ]);
}
            /**
             * Get client info and card balance by NFC UID.
             */
// In your Laravel Controller for the client-solde endpoint

public function clientSoldeByUid($nfc_uid)
{
    // Find the card by its NFC UID, and load the client relationship
    $card = \App\Models\Card::with(['client', 'voyages', 'subscriptions'])->where('nfc_uid', $nfc_uid)->first();

    // If the card or the client link doesn't exist, return a clear "not linked" response
    if (!$card || !$card->client) {
        return response()->json([
            'isLinked' => false,
            'client' => null,
            'cardStatus' => $card ? $card->status : 'Not Found',
            'balance' => $card ? (float)$card->balance : null,
            'cardId' => $card ? $card->id : null,
            'cardUuid' => $nfc_uid,
            'voyages' => $card ? $card->voyages : [],
            'subscriptions' => $card ? $card->subscriptions : [],
        ]);
    }

    $client = $card->client;

    return response()->json([
        'isLinked' => true,
        'client' => [
            'id' => $client->id, // Essential: Include the client ID
            'user_id' => $client->user_id,
            'full_name' => $client->full_name,
            'phone' => $client->phone,
            'email' => $client->email,
            'status' => $client->status,
            'cin' => $client->cin,
            'date_of_birth' => $client->date_of_birth,
            'school' => $client->school,
            'created_at' => $client->created_at,
            'updated_at' => $client->updated_at,
        ],
        'cardStatus' => $card->status,
        'balance' => (float)$card->balance,
        'cardId' => $card->id, // Add the card's ID
        'cardUuid' => $card->uuid, // Add the card's UUID
        'voyages' => $card->voyages,
        'subscriptions' => $card->subscriptions,
    ]);
}
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
