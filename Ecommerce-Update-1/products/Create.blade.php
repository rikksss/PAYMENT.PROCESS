@extends('dashboard.index')

@section('content')
<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">
    <a class="btn btn-secondary btn-sm" href="{{ route('products.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Products
    </a>
    <h2 class="text-dark mb-0">Add New Product</h2>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm rounded-lg p-5">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Left Side -->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="product_name"><strong>Product Name</strong></label>
                            <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Enter Product Name" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="product_price"><strong>Price</strong></label>
                            <input type="number" id="product_price" name="product_price" step="0.01" class="form-control" placeholder="Enter Price" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="category_id"><strong>Category</strong></label>
                            <select id="category_id" name="category_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="brand_id"><strong>Brand</strong></label>
                            <select id="brand_id" name="brand_id" class="form-control" required>
                                <option value="">-- Select Brand --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="stock_quantity"><strong>Stock Quantity</strong></label>
                            <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" placeholder="Enter Stock Quantity" required>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="form-group">
                            <label for="description"><strong>Description</strong></label>
                            <textarea id="description" name="description" class="form-control" rows="5" placeholder="Enter Product Description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="form-group">
                        <label for="product_image"><strong>Product Image</strong></label>
                        <input type="file" id="product_image" name="product_image" class="form-control" onchange="previewImage(event)" required>
                        <div class="mt-2" id="previewContainer" style="display: none;">
                            <img id="newImagePreview" alt="New Image Preview" style="max-width: 100%; max-height: 500px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save"></i> Save Product</button>
            </div>
        </div>
    </form>
</div>

    
    <script>
        function previewImage(event) {
            const fileInput = event.target;
            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('newImagePreview');
            
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
        
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block'; 
                };
        
                reader.readAsDataURL(fileInput.files[0]); 
            }
        }
        </script>

        
 


@endsection
