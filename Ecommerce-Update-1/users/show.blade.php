@extends('dashboard.index')

@section('content')
<div class="container">
    <h2>User Details</h2>

    <div class="card">
        <div class="card-header">
            <h4>{{ $user->username }}</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Email:</strong> {{ $user->email }}
                </li>
                <li class="list-group-item">
                    <strong>Contact Number:</strong> {{ $user->contact_number }}
                </li>
                <li class="list-group-item">
                    <strong>Address:</strong> {{ $user->address }}
                </li>
                <li class="list-group-item">
                    <strong>User Type:</strong> {{ ucfirst($user->user_type) }}
                </li>
                @if($user->user_profile)
                    <li class="list-group-item">
                        <strong>Profile Picture:</strong>
                        <img src="{{ asset('storage/' . $user->user_profile) }}" alt="Profile" width="100">
                    </li>
                @else
                    <li class="list-group-item">
                        <strong>Profile Picture:</strong> No profile picture set.
                    </li>
                @endif
                <li class="list-group-item">
                    <strong>Created At:</strong> {{ $user->created_at->format('Y-m-d H:i') }}
                </li>
                <li class="list-group-item">
                    <strong>Updated At:</strong> {{ $user->updated_at->format('Y-m-d H:i') }}
                </li>
            </ul>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection