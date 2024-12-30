@extends('dashboard.index')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This ensures the form is sent with PUT method for updating data -->

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number', $user->contact_number) }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $user->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="user_type" class="form-label">User Type</label>
            <select class="form-control" id="user_type" name="user_type" required>
                <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ $user->user_type == 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="user_profile" class="form-label">Profile Picture (Optional)</label>
            <input type="file" class="form-control" id="user_profile" name="user_profile">
            @if($user->user_profile)
                <img src="{{ asset('storage/' . $user->user_profile) }}" alt="Profile" width="100" class="mt-2">
            @else
                <p>No profile picture set</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection