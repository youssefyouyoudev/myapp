<?php
namespace App\Http\Controllers;

use App\Models\VoyagePlan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoyagePlanController extends Controller
{
    public function index()
    {
        return JsonResource::collection(VoyagePlan::all());
    }

    public function store(Request $request)
    {
        $plan = VoyagePlan::create($request->validate([
            'price' => 'required|numeric',
            'number_of_voyages' => 'required|integer',
            'expiration' => 'required|in:6_month,1_year',
        ]));
        return new JsonResource($plan);
    }

    public function show(VoyagePlan $voyagePlan)
    {
        return new JsonResource($voyagePlan);
    }

    public function update(Request $request, VoyagePlan $voyagePlan)
    {
        $voyagePlan->update($request->validate([
            'price' => 'sometimes|numeric',
            'number_of_voyages' => 'sometimes|integer',
            'expiration' => 'sometimes|in:6_month,1_year',
        ]));
        return new JsonResource($voyagePlan);
    }

    public function destroy(VoyagePlan $voyagePlan)
    {
        $voyagePlan->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
