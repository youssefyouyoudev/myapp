<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Card;
use App\Models\Voyage;
use App\Models\Payment;
use App\Models\Subscription;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
            'stats' => [
                'usersCount'        => User::count(),
                'clientsCount'      => Client::count(),
                'cardsCount'        => Card::count(),
                'voyagesCount'      => Voyage::count(),
                'paymentsCount'     => Payment::count(),
                'subscriptionsCount'=> Subscription::count(),
            ]
        ]);
    }
}
