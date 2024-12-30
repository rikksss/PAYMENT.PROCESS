<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');  // Adjust the view as needed
    }

    // Handle user registration
    public function register(Request $request)
    {
        // Validate the input fields
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'contact_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|string|max:50',
            'user_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'username.required' => 'Please enter a username.',
            'email.required' => 'Please enter an email address.',
            'password.required' => 'Please enter a password.',
            // Additional custom error messages can go here
        ]);

        // If validation fails, return back with errors
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Handle file upload if provided
        $profilePicture = null;
        if ($request->hasFile('user_profile')) {
            $profilePicture = $request->file('user_profile')->store('profile_pictures', 'public');
        }

        // Create the user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'user_profile' => $profilePicture, // Store the profile picture path
        ]);

        // Log the user in
        Auth::login($user);  // Ensure the user is correctly logged in

        // Flash success message
        session()->flash('success', 'Account successfully created.');

            return redirect()->route('auth.login'); // Redirect to admin dashboard
        
     
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');  // Adjust the view as needed
    }

    // Handle user login
    public function login(Request $request)
    {
        // Validate the login credentials
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // If validation fails, return back with errors
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Attempt to log in the user
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Flash success message
            session()->flash('success', 'Successfully logged in.');

            // Redirect based on user type
            if ($user->user_type == 'admin') {
                return redirect()->route('dashboard.content'); // Redirect to admin dashboard
            } else {
                
                return redirect()->route('customershomepage.index'); // Redirect to customer homepage
            }
        } else {
            // Flash error message for invalid login credentials
            return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput();
        }
    }

    // Handle user logout
    public function logout()
    {
        Auth::logout();  // Log the user out
        session()->flash('success', 'You have been logged out.');  // Flash logout success message
        return redirect()->route('auth.login'); // Redirect to login page
    }
}