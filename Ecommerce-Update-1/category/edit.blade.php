@extends('dashboard.index')

@section('content')
<div class="container">
    <h2>Edit Category</h2>

    <form action="{{ route('category.update', $category->category_id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Use PUT method for updates -->

        <!-- Category Name -->
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" 
                   value="{{ old('category_name', $category->category_name) }}" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection