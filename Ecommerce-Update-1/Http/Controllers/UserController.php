<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the User.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $users = User::when($search, function ($query, $search) {
            return $query->where('username', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);
    
        return view('users.index', compact('users'));
    }
    

    /**
     * Show the form for creating a new users.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created users in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'contact_number' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:8',
            'user_type' => 'required|string|max:100',
            'user_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload if exists
        if ($request->hasFile('user_profile')) {
            $filePath = $request->file('user_profile')->store('profile_pictures', 'public');
        } else {
            $filePath = null;
        }

        // Create the user record
        User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'],
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
            'user_type' => $validated['user_type'],
            'user_profile' => $filePath,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'contact_number' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'password' => 'nullable|string|min:8',
            'user_type' => 'required|string|max:100',
            'user_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload if exists
        if ($request->hasFile('user_profile')) {
            // Delete the old profile picture if exists
            if ($user->user_profile) {
                Storage::delete('public/' . $user->user_profile);
            }

            // Upload the new profile picture
            $filePath = $request->file('user_profile')->store('profile_pictures', 'public');
        } else {
            $filePath = $user->user_profile; // Keep the existing profile picture if not updated
        }

        // Update the user record
        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'],
            'address' => $validated['address'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
            'user_type' => $validated['user_type'],
            'user_profile' => $filePath,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Delete the profile picture if exists
        if ($user->user_profile) {
            Storage::delete('public/' . $user->user_profile);
        }

        // Delete the user record
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
