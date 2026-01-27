<?php

        namespace App\Http\Controllers;

        use App\Models\Card;
        use App\Http\Requests\StoreCardRequest;
        use App\Http\Requests\UpdateCardRequest;
        use App\Http\Resources\CardResource;
        use Illuminate\Support\Str;
        use Illuminate\Http\Request;
        use Carbon\Carbon;

    class CardController extends Controller{
        /**
         * Update the etudiant linked to a card.
         * @param \Illuminate\Http\Request $request
         * @param int $cardId
         * @return \Illuminate\Http\JsonResponse
         */
        public function updateEtudiant(Request $request, $cardId)
        {
            $request->validate([
                'etudiant_id' => 'required|exists:etudiants,id',
            ]);
            $card = Card::findOrFail($cardId);
            $etudiant = \App\Models\Etudiant::findOrFail($request->etudiant_id);
            $card->etudiant_id = $etudiant->id;
            $card->save();
            return response()->json([
                'message' => 'Etudiant updated for card successfully.',
                'card' => new \App\Http\Resources\CardResource($card->fresh()->load(['etudiant', 'voyages', 'cardSolds'])),
                'etudiant' => $etudiant,
            ]);
        }
    /**
     * Validate a card for voyage or subscription.
     *
     * - If the card has an active subscription, allow up to 4 validations per day.
     * - If not, decrement solde (balance) by 1 if possible.
     */
  function validateCard($cardId)
{
    // Eager load the card with its student and all 'active' status subscriptions.
    // Date filtering will be handled in code to provide better error messages.
    $card = Card::with(['etudiant.subscriptions' => function($q) {
        $q->where('status', 'active')->with('plan');
    }])->findOrFail($cardId);

    $now = now();
    $today = $now->toDateString();

    // 1. Check validation limit for the day.
    $todayValidations = \App\Models\Validation::where('card_id', $card->id)
        ->whereDate('validated_at', $today)
        ->count();

    if ($todayValidations >= 4) {
        return response()->json([
            'success' => false,
            'reason' => 'Validation limit reached (4 per day)',
        ], 403);
    }

    // 2. Find a currently active subscription or a future-dated one.
    $activeSubscription = null;
    $futureSubscription = null;
    if ($card->etudiant) {
        // Sort by start_date to handle cases with multiple subscriptions
        $subscriptions = $card->etudiant->subscriptions->sortBy('start_date');

        foreach ($subscriptions as $subscription) {
            $startDate = Carbon::parse($subscription->start_date)->startOfDay();
            $endDate = Carbon::parse($subscription->end_date)->endOfDay();

            if ($now->between($startDate, $endDate)) {
                $activeSubscription = $subscription;
                break; // Found a valid subscription, no need to check others.
            }

            if ($startDate->isFuture() && !$futureSubscription) {
                $futureSubscription = $subscription; // Found the next upcoming subscription.
            }
        }
    }

    // 3. If a subscription is currently active, succeed.
    if ($activeSubscription) {
        \App\Models\Validation::create([
            'card_id' => $card->id,
            'validated_at' => $now,
        ]);

        return response()->json([
            'success' => true,
            'type' => 'subscription',
            'message' => 'Validation allowed (subscription)',
            'remaining' => 4 - ($todayValidations + 1),
            'subscription_details' => [
                'type' => optional($activeSubscription->plan)->name,
                'price' => optional($activeSubscription->plan)->price,
                'start_date' => $activeSubscription->start_date,
                'end_date' => $activeSubscription->end_date,
            ]
        ]);
    }

    // 4. If no active subscription, check for voyages.
    $voyage = \App\Models\Voyage::where('card_id', $card->id)
        ->where('number_voyages', '>', 0)
        ->orderByDesc('id')
        ->first();

    if ($voyage) {
        $voyage->decrement('number_voyages');
        // Also decrement card's number_voyages if it's a separate counter
        if ($card->number_voyages > 0) {
            $card->decrement('number_voyages');
        }

        \App\Models\Validation::create([
            'card_id' => $card->id,
            'validated_at' => $now,
        ]);

        return response()->json([
            'success' => true,
            'type' => 'voyage',
            'message' => 'Validation allowed (voyage solde)',
            'remaining' => $voyage->number_voyages,
        ]);
    }

    // 5. If all checks fail, provide the most specific error reason.
    if ($futureSubscription) {
        return response()->json([
            'success' => false,
            'reason' => 'Subscription not active yet. Starts on ' . Carbon::parse($futureSubscription->start_date)->toDateString(),
        ], 403);
    }

    return response()->json([
        'success' => false,
        'reason' => 'Insufficient solde and no active subscription',
    ], 403);
}
    public function index()
    {
        $cards = Card::with('etudiant', 'voyages', 'cardSolds')->paginate(20);
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
            'data' => new CardResource($card->load(['etudiant', 'voyages', 'cardSolds']))
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
            'data' => new CardResource($card->fresh()->load(['etudiant', 'voyages', 'cardSolds']))
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
    * Link a card to an etudiant and return both card and etudiant info.
     */
    public function linkToEtudiant(\Illuminate\Http\Request $request, $nfcUid)
{
    // 1. Validate that the etudiant_id exists.
    $request->validate([
        'etudiant_id' => 'required|exists:etudiants,id',
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
    $etudiant = \App\Models\Etudiant::findOrFail($request->etudiant_id);
    $card->etudiant_id = $etudiant->id;

    // 5. Save the card. This will either INSERT a new card or UPDATE the existing one.
    $card->save();

    // 6. Return a success response.
    return response()->json([
        'message' => 'Card linked to etudiant successfully.',
        'card' => new \App\Http\Resources\CardResource($card->fresh()->load(['etudiant', 'voyages', 'cardSolds'])),
        'etudiant' => $etudiant,
    ]);
}
            /**
             * Get etudiant info and card balance by NFC UID.
             */
// In your Laravel Controller for the etudiant-solde endpoint

public function etudiantSoldeByUid($nfc_uid)
{
    // Find the card by its NFC UID, and load the etudiant relationship
    $card = \App\Models\Card::with(['etudiant', 'voyages', 'subscriptions'])->where('nfc_uid', $nfc_uid)->first();
    // Get last 5 validations for this card
    $lastValidations = [];
    if ($card) {
        $lastValidations = \App\Models\Validation::where('card_id', $card->id)
            ->orderByDesc('validated_at')
            ->limit(5)
            ->get(['id', 'validated_at', 'created_at']);
    }

    // If the card or the etudiant link doesn't exist, return a clear "not linked" response
    if (!$card || !$card->etudiant) {
        return response()->json([
            'isLinked' => false,
            'etudiant' => null,
            'cardStatus' => $card ? $card->status : 'Not Found',
            'balance' => $card ? (float)$card->balance : null,
            'cardId' => $card ? $card->id : null,
            'cardUuid' => $nfc_uid,
            'voyages' => $card ? $card->voyages : [],
            'subscriptions' => $card ? $card->subscriptions : [],
            'lastValidations' => $lastValidations,
        ]);
    }

    $etudiant = $card->etudiant;

    return response()->json([
        'isLinked' => true,
        'etudiant' => [
            'id' => $etudiant->id,
            'user_id' => $etudiant->user_id,
            'nom' => $etudiant->nom,
            'prenom' => $etudiant->prenom,
            'etablissement' => $etudiant->etablissement,
            'email' => $etudiant->email,
            'telephone' => $etudiant->telephone,
            'adresse' => $etudiant->adresse,
            'carte_nationale' => $etudiant->carte_nationale,
            'carte_etudiant' => $etudiant->carte_etudiant,
            'img_user' => $etudiant->img_user,
            'img_carte_nationale' => $etudiant->img_carte_nationale,
            'img_carte_nationale_verso' => $etudiant->img_carte_nationale_verso,
            'img_carte_etudiant' => $etudiant->img_carte_etudiant,
            'created_at' => $etudiant->created_at,
            'updated_at' => $etudiant->updated_at,
        ],
        'cardStatus' => $card->status,
        'balance' => (float)$card->balance,
        'number_voyages' => $card->number_voyages,
        'cardId' => $card->id,
        'cardUuid' => $card->uuid,
        'voyages' => $card->voyages,
        'subscriptions' => $card->subscriptions->load('plan'),
        'lastValidations' => $lastValidations,
    ]);
}
            public function chargeVoyage(\Illuminate\Http\Request $request, $cardId)
            {
                $card = Card::with('etudiant.subscriptions')->findOrFail($cardId);
                // If card's etudiant has any active subscription, cannot charge for voyage
                $hasActiveSubscription = $card->etudiant && $card->etudiant->subscriptions()->where('status', 'active')->exists();
                if ($hasActiveSubscription) {
                    return response()->json(['message' => 'Card already has active subscription. Cannot charge for voyage.'], 400);
                }
                // ... logic to charge for voyage (you may want to move this to VoyageController)
                // Example: $voyage = Voyage::create([...]);
                return response()->json(['message' => 'Card charged for voyage successfully.']);
            }
}
