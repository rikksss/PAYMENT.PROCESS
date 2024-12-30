@extends('layouts.master')

<div class="container-fluid d-flex align-items-center justify-content-center" 
    style="height: 100vh; 
           background: url('{{ asset('images/background1.jpg') }}') no-repeat center center; 
           background-size: cover;">

    <!-- Back Button -->
    <div style="position: absolute; top: 20px; left: 20px;">
        <a href="javascript:history.back()" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>

    <div class="d-flex align-items-center justify-content-between" style="width: 100%; max-width: 1000px; gap: 30px;">
        <!-- About Us Section -->
        <div class="about-us text-white" style="max-width: 450px;">
            <h1 style="font-size: 2.2rem; margin-bottom: 20px;">WeazaPee</h1>
            <p style="font-size: 1.2rem; line-height: 1.6;">
                LazaPee Ecommerce is your ultimate online shopping hub for high-quality products. 
                From trendy fashion to the latest electronics, we provide seamless, secure, and reliable shopping 
                with amazing deals and timely deliveries.
            </p>
        </div>

        <!-- Login Form -->
        <div class="card" style="width: 100%; 
                                 max-width: 450px; 
                                 padding: 25px; 
                                 background-color: rgba(255, 255, 255, 0.95); 
                                 border: none; 
                                 border-radius: 10px;">
            <h2 class="text-center mb-4" style="font-size: 2rem;">Sign In</h2>

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label" style="font-size: 1.1rem;">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label" style="font-size: 1.1rem;">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100" style="font-size: 1.1rem;">
                    Login
                </button>
            </form>

            <p class="text-center mt-3" style="font-size: 1rem;">
                Don't have an account? <a href="{{ route('register') }}">Register here</a>
            </p>
        </div>
    </div>
</div>
