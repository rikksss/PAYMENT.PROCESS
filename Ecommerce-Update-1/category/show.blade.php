@extends('dashboard.index')

@section('content')
<div class="container">
    <h2>Category Details</h2>

    <div class="card">
        <div class="card-header">
            <h4>{{ $category->category_name }}</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Category Name:</strong> {{ $category->category_name }}
                </li>
                <li class="list-group-item">
                    <strong>Created At:</strong> {{ $category->created_at->format('Y-m-d H:i') }}
                </li>
                <li class="list-group-item">
                    <strong>Updated At:</strong> {{ $category->updated_at->format('Y-m-d H:i') }}
                </li>
            </ul>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('category.edit', $category->category_id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('category.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection