@extends('dashboard.index')

@section('content')
<div class="container">
    <h1>Categories</h1>

    <!-- Create Category Button -->
    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Create Category</a>

    <!-- Search Bar -->
    <form action="{{ route('category.index') }}" method="GET" class="mb-3" id="searchForm">
        <div class="input-group">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Search by category name..." 
                value="{{ request('search') }}" 
                oninput="document.getElementById('searchForm').submit()"
            >
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    
    <!-- Categories Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->category_name }}</td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('category.edit', $category->category_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    
                    <!-- Delete Button -->
                    <form action="{{ route('category.destroy', $category->category_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination justify-content-end">
        {{ $categories->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection