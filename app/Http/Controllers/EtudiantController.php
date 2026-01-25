<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import the Storage facade

class EtudiantController extends Controller
{
    /**
     * Display a paginated list of etudiants.
     */
    public function index()
    {
        // No changes needed here.
        $etudiants = Etudiant::with(['cards', 'subscriptions']);
        return $etudiants->paginate(20);
    }

    /**
     * Store a newly created etudiant in storage, including handling file uploads.
     */
    public function store(Request $request)
    {
        // --- CORRECTED VALIDATION ---
        // Validates that the uploaded files are actual images.
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'telephone' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'carte_nationale' => 'required|string|max:255|unique:etudiants,carte_nationale',
            'carte_etudiant' => 'nullable|string|max:255',

            // Image validation rules: must be an image, with specific types and size limit.
            'img_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_carte_nationale' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_carte_nationale_verso' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_carte_etudiant' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // --- CORRECTED IMAGE HANDLING ---
        // An array of the image fields to process.
        $imageFields = ['img_user', 'img_carte_nationale', 'img_carte_nationale_verso', 'img_carte_etudiant'];

        // Loop through each image field, check if a file was uploaded, and store it.
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Store the file in 'storage/app/public/<field_name>' and save the path.
                $path = $request->file($field)->store($field, 'public');
                $validated[$field] = $path;
            }
        }

        $etudiant = Etudiant::create($validated);
        return response()->json($etudiant, 201);
    }

    /**
     * Display the specified etudiant.
     */
    public function show(Etudiant $etudiant)
    {
        // No changes needed here, but this is good practice.
        $etudiant->load([
            'cards',
            'payments',
            'subscriptions',
            'activeSubscription',
            'activeVoyage'
        ]);
        return response()->json($etudiant);
    }

    /**
     * Update the specified etudiant in storage, including handling file uploads.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        // --- CORRECTED VALIDATION ---
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'nom' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'etablissement' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:etudiants,email,' . $etudiant->id,
            'telephone' => 'sometimes|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'carte_nationale' => 'sometimes|string|max:255|unique:etudiants,carte_nationale,' . $etudiant->id,
            'carte_etudiant' => 'nullable|string|max:255',

            // Image validation rules
            'img_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_carte_nationale' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_carte_nationale_verso' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_carte_etudiant' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // --- CORRECTED IMAGE HANDLING ---
        $imageFields = ['img_user', 'img_carte_nationale', 'img_carte_nationale_verso', 'img_carte_etudiant'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // If a new image is uploaded, delete the old one first.
                if ($etudiant->{$field}) {
                    Storage::disk('public')->delete($etudiant->{$field});
                }
                // Store the new image and update the path in the validated data.
                $path = $request->file($field)->store($field, 'public');
                $validated[$field] = $path;
            }
        }

        $etudiant->update($validated);
        return response()->json($etudiant);
    }

    /**
     * Remove the specified etudiant from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        // --- CORRECTED DELETION ---
        // The logic to delete image files is now in the Etudiant model (see below).
        // This is cleaner and ensures images are always deleted when an etudiant is.
        $etudiant->delete();
        return response()->json(['message' => 'Etudiant deleted successfully']);
    }
}
