@extends('layouts.master')

<!-- Apply background image to the body element -->
<style>
    body {
        background-image: url('{{ asset('images/background1.jpg') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 100vh; /* Ensures the background covers the entire viewport height */
        margin: 0; /* Prevents any extra space around the body */
    }
</style>

<div class="container d-flex justify-content-center align-items-center" 
     style="min-height: 100vh;">

    <!-- Card Wrapper -->
    <div class="card shadow-sm p-4" 
         style="width: 100%; max-width: 500px; border-radius: 8px; background-color: rgba(255, 255, 255, 0.8);">
         
        <!-- Form Title -->
        <h2 class="text-center mb-3" 
            style="font-size: 1.5rem; font-weight: 600; color: #1D4ED8;">
            Create Your Account
        </h2>

        <!-- Success Message -->
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('register.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Two-Column Layout: Username and Email -->
            <div class="row mb-2">
                <div class="col-6">
                    <input type="text" class="form-control form-control-sm" 
                           placeholder="Username" id="username" name="username" 
                           value="{{ old('username') }}" required>
                </div>
                <div class="col-6">
                    <input type="email" class="form-control form-control-sm" 
                           placeholder="Email" id="email" name="email" 
                           value="{{ old('email') }}" required>
                </div>
            </div>

            <!-- Contact Number -->
            <div class="mb-2">
                <input type="text" class="form-control form-control-sm" 
                       placeholder="Contact Number" id="contact_number" 
                       name="contact_number" value="{{ old('contact_number') }}" required>
            </div>

            <!-- Address -->
            <div class="mb-2">
                <textarea class="form-control form-control-sm" 
                          placeholder="Address" id="address" name="address" rows="2" required>{{ old('address') }}</textarea>
            </div>

            <!-- Password and Confirm Password -->
            <div class="row mb-2">
                <div class="col-6">
                    <input type="password" class="form-control form-control-sm" 
                           placeholder="Password" id="password" name="password" required>
                </div>
                <div class="col-6">
                    <input type="password" class="form-control form-control-sm" 
                           placeholder="Confirm Password" id="password_confirmation" 
                           name="password_confirmation" required>
                </div>
            </div>

            <!-- User Type -->
            <div class="mb-2">
                <select class="form-select form-select-sm" id="user_type" name="user_type" required>
                    <option value="customer">Customer</option>
                </select>
            </div>

            <!-- Profile Picture -->
            <div class="mb-3">
                <input type="file" class="form-control form-control-sm" 
                       id="user_profile" name="user_profile">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100" 
                    style="font-size: 0.9rem; font-weight: 600; border-radius: 5px;">
                Register
            </button>
        </form>

        <!-- Login Link -->
        <p class="text-center mt-3 mb-0" style="font-size: 0.9rem;">
            Already have an account? 
            <a href="{{ route('auth.login') }}" style="color: #1D4ED8; text-decoration: none;">
                Login here
            </a>
        </p>
    </div>
</div>