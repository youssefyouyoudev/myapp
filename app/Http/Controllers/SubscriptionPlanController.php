<?php
namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        return JsonResource::collection(SubscriptionPlan::all());
    }

    public function store(Request $request)
    {
        $plan = SubscriptionPlan::create($request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|in:monthly,2_month,3_month,yearly',
        ]));
        return new JsonResource($plan);
    }

    public function show(SubscriptionPlan $subscriptionPlan)
    {
        return new JsonResource($subscriptionPlan);
    }

    public function update(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->update($request->validate([
            'name' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'type' => 'sometimes|in:monthly,2_month,3_month,yearly',
        ]));
        return new JsonResource($subscriptionPlan);
    }

    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
