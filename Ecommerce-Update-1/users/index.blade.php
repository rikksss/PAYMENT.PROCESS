@extends('dashboard.index')

@section('content')
<div class="container">
    <h1>Users List</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>

    <!-- Search Bar -->
    <form action="{{ route('users.index') }}" method="GET" class="mb-3" id="searchForm">
        <div class="input-group">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Search by username or email..." 
                value="{{ request('search') }}" 
                oninput="document.getElementById('searchForm').submit()"
            >
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->contact_number }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ ucfirst($user->user_type) }}</td>
                <td>
                    <!-- View Button -->
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>

                    <!-- Delete Button -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Display Pagination Links aligned to the right with smaller buttons -->
    <div class="pagination justify-content-end">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection