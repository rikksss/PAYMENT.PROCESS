@extends('dashboard.index')

@section('content')
<div class="container">
    <h2>Create User</h2>

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="user_type" class="form-label">User Type</label>
            <select class="form-control" id="user_type" name="user_type" required>
                <option value="admin">Admin</option>
                <option value="customer">Customer</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="user_profile" class="form-label">User Profile (Optional)</label>
            <input type="file" class="form-control" id="user_profile" name="user_profile">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection