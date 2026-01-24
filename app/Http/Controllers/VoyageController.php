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
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class VoyageController extends Controller
{

    /**
    * Charge an etudiant for a voyage.
     */
    public function charge($etudiantId, \Illuminate\Http\Request $request)
{
    try {
        // 1. Added 'number_of_voyages' to validation rules.
        $validated = $request->validate([
            'voyage_plan_id' => 'required|exists:voyage_plans,id',
            'card_uuid' => 'required|exists:cards,uuid',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'number_of_voyages' => 'required|integer|min:1',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation error in voyage charge:', [
            'errors' => $e->errors(),
            'input' => $request->all()
        ]);
        return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
    }
    $card = \App\Models\Card::where('uuid', $validated['card_uuid'])->firstOrFail();
    $data = $validated;
    $data['uuid'] = $request->uuid ?? (string) \Illuminate\Support\Str::uuid();
    $data['card_id'] = $card->id;
    // Fix: fetch etudiant_id from card relation or fail if not set
    if (!$card->etudiant_id) {
        return response()->json(['message' => 'Card is not linked to any etudiant'], 422);
    }
    $data['etudiant_id'] = $card->etudiant_id;
    $data['scanned_at'] = now();

    // 2. Get the value from the validated data.
    $newNumberVoyages = (int)$data['number_of_voyages'];
    unset($data['card_uuid']);

    // 3. Changed 'number_voyages' to 'number_of_voyages' everywhere below.
    $voyage = \App\Models\Voyage::where('card_id', $card->id)
        ->where('voyage_plan_id', $data['voyage_plan_id'])
        ->orderByDesc('id')
        ->first();

    if ($voyage) {
        // Assumes the DB column is 'number_of_voyages'
        $voyage->number_voyages += $newNumberVoyages;
        $voyage->save();
        $action = 'recharged_existing_voyage';
    } else {
        // 'number_of_voyages' is already in $data from validation
        $voyage = \App\Models\Voyage::create($data);
        $action = 'created_new_voyage';
    }

    // Assumes the DB column is 'number_of_voyages'
    $card->number_voyages += $newNumberVoyages;
    $card->save();

    \App\Models\Payment::create([
        'uuid' => (string) \Illuminate\Support\Str::uuid(),
        'user_id' => $request->user_id ?? null,
        'etudiant_id' => $card->etudiant_id,
        'card_id' => $card->id,
        'amount' => $voyage->amount,
        'method' => 'espece',
        'reference' => null,
    ]);
    $this->logUserAction($action, 'Voyage', $voyage->id, [
        'request' => $request->all(),
        'voyage_id' => $voyage->id,
    ]);
    return response()->json([
        'message' => 'Etudiant charged for voyage successfully.',
        'etudiant_id' => $card->etudiant_id,
        'voyage' => [
            'id' => $voyage->id,
            'plan' => $voyage->plan->name ?? null,
            'amount' => (float)$voyage->amount,
            'card_id' => $card->id,
            'scanned_at' => $voyage->scanned_at,
            'number_of_voyages' => $voyage->number_of_voyages,
        ],
        'card' => [
            'id' => $card->id,
            'nfc_uid' => $card->nfc_uid,
            'balance' => (float)$card->balance,
            // also updated here for consistency in the response
            'number_of_voyages' => $card->number_voyages,
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
        $subscription = $card->etudiant->subscriptions()->where('status', 'active')
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
                'etudiant_id' => $card->etudiant_id,
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
            // Log after successful voyage creation
            $this->logUserAction('create_voyage', 'Voyage', $voyage->id, [
                'request' => $data,
                'voyage_id' => $voyage->id,
            ]);
        });
        return response()->json(['message' => 'Voyage recorded successfully']);
    }

    public function show(Voyage $voyage)
    {
        return new VoyageResource($voyage->load('card'));
    }
}
