@extends('dashboard.index')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="font-size: 2rem;">LazaPee</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Notifications Dropdown -->
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                        <li><a class="dropdown-item" href="#">New message received</a></li>
                        <li><a class="dropdown-item" href="#">New user registered</a></li>
                        <li><a class="dropdown-item" href="#">Review added</a></li>
                    </ul>
                </li>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- Check if profile image exists and load it -->
                        @if(Auth::user()->user_profile && file_exists(public_path('storage/' . Auth::user()->user_profile)))
                            <img src="{{ asset('storage/' . Auth::user()->user_profile) }}" alt="{{ Auth::user()->username }}'s Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                        @else
                            <!-- Fallback if no image exists -->
                            <div class="rounded-circle bg-white border border-2" style="width: 30px; height: 30px;"></div>
                        @endif
                        {{ Auth::user()->username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Product List</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a class="btn btn-primary" href="{{ route('products.create') }}">Create New Product</a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    
        <form method="GET" action="{{ route('products.index') }}" class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search products..." aria-label="Search products" value="{{ request()->input('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>User Email</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock Status</th>
                        <th>Stock Quantity</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                {{ $product->user->email ?? 'No user assigned' }}
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category->category_name }}</td>
                            <td>₱{{ number_format($product->product_price, 2) }}</td>
                            <td style="color: {{ $product->stock_status === 'Out of Stock' ? 'red' : 'green' }};">
                                {{ $product->stock_status }}
                            </td>
                            <td>{{ $product->stock_quantity }} units</td>
                            <td>
                                <img src="{{ asset('images/' . $product->product_image) }}" alt="Product Image" class="rounded" style="width: 100px; height: 50px; object-fit: cover;">

                                {{-- <img src="{{ asset('images/' . $product->product_image) }}" class="rounded" style="width: 100px; height: 50px; object-fit: cover;"> --}}
                            </td>
                            <td>
                                
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <button type="button" class="btn btn-link text-primary" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->product_id }}">
                                        <i class="fas fa-eye" style="font-size: 1rem;"></i>
                                    </button>
    
                                    <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-link text-primary" title="Edit">
                                        <i class="fas fa-edit" style="font-size: 1rem;"></i>
                                    </a>
    
                                    <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger" title="Delete">
                                            <i class="fas fa-trash" style="font-size: 1rem;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
    
                        <!-- gawas sa form (view product details)) -->
                        <div class="modal fade" id="productModal{{ $product->product_id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->product_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="productModalLabel{{ $product->product_id }}">{{ $product->product_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-0">
                                            
                                            <div class="col-md-6">
                                                <img src="{{ asset('images/' . $product->product_image) }}" class="img-fluid rounded-start" alt="{{ $product->product_name }}" style="border-radius: 20px;">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <h3 class="card-title">{{ $product->product_name }}</h3>
                                                    <p class="text-muted">{{ $product->category->category_name }} : {{ $product->brand->brand_name }}</p>
                                                    <p><strong>Price:</strong> ₱{{ number_format($product->product_price, 2) }}</p>
                                                    <p><strong>Description:</strong> {{ $product->description }}</p>
                                                    <p><strong>Stock Quantity:</strong> {{ $product->stock_quantity }} units</p>
                                                    <p><strong>Status:</strong> {{ $product->stock_status }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-primary">Edit Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <!-- pagintn -->
        {!! $products->links() !!}
    </div>
    
 

@endsection
