@extends('dashboard.index')

@section('content')
<div class="container">
    <h2>Create Category</h2>

    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Input Field -->
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" required>
        </div>

        <!-- Buttons -->
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection