<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::where('role', '!=', 'client')->get();
        return response()->json(['success' => true, 'data' => $users]);
    }

    // Store a newly created user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(['admin', 'agent'])],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        return response()->json(['success' => true, 'data' => $user], 201);
    }

    // Display the specified user
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
        return response()->json(['success' => true, 'data' => $user]);
    }

    // Update the specified user
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
        $validated = $request->validate([
            'username' => 'sometimes|required|string|max:255',
            'email' => ['sometimes', 'required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|required|string|min:6',
            'role' => ['sometimes', 'required', Rule::in(['admin', 'agent'])],
        ]);
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        $user->update($validated);
        return response()->json(['success' => true, 'data' => $user]);
    }

    // Remove the specified user
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['success' => true, 'message' => 'User deleted']);
    }
}
