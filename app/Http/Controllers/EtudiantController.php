<?php


namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{

    public function index()
    {
        return Etudiant::paginate(20);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'status' => 'required|in:active,suspended',
            'cin' => 'required|string|max:255|unique:etudiants,cin',
            'date_of_birth' => 'required|date',
            'school' => 'required|string|max:255',
        ]);

        $etudiant = Etudiant::create($validated);
        return response()->json($etudiant, 201);
    }

    public function show(Etudiant $etudiant)
    {
        $etudiant->load([
            'cards',
            'payments',
            'subscriptions',
            'activeSubscription',
            'activeVoyage'
        ]);
        return response()->json($etudiant);
    }

    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'full_name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:active,suspended',
            'cin' => 'sometimes|string|max:255|unique:etudiants,cin,' . $etudiant->id,
            'date_of_birth' => 'sometimes|date',
            'school' => 'sometimes|string|max:255',
        ]);

        $etudiant->update($validated);
        return response()->json($etudiant);
    }

    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return response()->json(['message' => 'Etudiant deleted successfully']);
    }
}
