<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();

        return response()->json($users, 200);
    }

    public function userView(Request $request)
    {
        return response()->json($request->user()->load('role'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_tlp' => 'nullable|numeric',
            'address' => 'nullable|max:255|string',
            'city' => 'nullable|max:255|string',
            'province' => 'nullable|max:255|string',
            'role_id'  => 'required'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'no_tlp' => $validated['no_tlp'],
            'role_id' => $validated['role_id'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'province' => $validated['province'],
        ]);

        return response()->json(['message' => 'User adding successfully'], 200);
    }

    public function show($id)
    {
        $users = User::with('role')->findOrFail($id);

        return response()->json($users, 200);
    }

    public function edit($id, Request $request)
    {
        $users = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'no_tlp' => 'nullable|numeric',
            'address' => 'nullable|max:255|string',
            'city' => 'nullable|max:255|string',
            'province' => 'nullable|max:255|string',
            'role_id'  => 'required'
        ]);

        $users->update($validated);

        return response()->json(['message' => 'User edit successfully'], 200);
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return response()->json(['message' => 'User delete successfully'], 200);
    }
}
