<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Card;
use App\Models\CardSold;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('client', 'card')->paginate(20);
        return PaymentResource::collection($payments);
    }

    public function store(StorePaymentRequest $request)
    {
        $data = $request->validated();
        $card = Card::where('uuid', $data['card_uuid'])->firstOrFail();
        $amount = $data['amount'];
        DB::transaction(function () use ($data, $card, $amount) {
            $old = $card->balance;
            $card->balance += $amount;
            $card->save();
            $payment = Payment::create([
                'uuid' => Str::uuid(),
                'client_id' => $card->client_id,
                'card_id' => $card->id,
                'amount' => $amount,
                'method' => $data['method'],
                'reference' => $data['reference'] ?? null,
            ]);
            CardSold::create([
                'card_id' => $card->id,
                'old_balance' => $old,
                'new_balance' => $card->balance,
                'reason' => 'charge',
                'created_at' => now(),
            ]);
        });
        return response()->json(['message' => 'Card charged successfully', 'balance' => $card->balance]);
    }

    public function show(Payment $payment)
    {
        return new PaymentResource($payment->load('client', 'card'));
    }
}
