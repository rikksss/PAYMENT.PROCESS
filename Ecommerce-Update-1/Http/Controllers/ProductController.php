<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    $query = $request->input('search');
    $products = Product::when($query, function ($queryBuilder) use ($query) {
        return $queryBuilder->where('product_name', 'like', '%' . $query . '%');
    })->paginate(4);


    return view('products.index', compact('products'))
        ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    public function create()
    {
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        
        return view('products.create', compact('categories', 'brands', 'user'));
        
    }

    public function store(Request $request)
    {
         
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'product_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,category_id',
            'brand_id' => 'required|exists:brands,brand_id',
            'stock_quantity' => 'required|integer',
            'product_image' => 'nullable|image|max:2048',
        ]);
    
        $productImage = null;
        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image')->store('product_images', 'public');
        }
    
        // Sa stock qty nya e based ang Stock Status
        $stockQuantity = $request->input('stock_quantity');
        $stockStatus = $stockQuantity > 0 ? 'In Stock' : 'Out of Stock';
    
        Product::create([
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'product_price' => $request->input('product_price'),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'user_id' => Auth::id(),
            'stock_quantity' => $stockQuantity,
            'stock_status' => $stockStatus,
            'product_image' => $productImage,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    { 
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    // public function update(Request $request, Product $product)
    // {
    //     $request->validate([  
    //     ]);
    //     $product->update($request->all());
    //     return redirect()->route('products.index')
    //     ->with('success','Products updated successfully');
    // }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'product_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,category_id',
            'brand_id' => 'required|exists:brands,brand_id',
            'stock_quantity' => 'required|integer',
            'product_image' => 'nullable|image|max:2048',
    ]);

    // Determine Stock Status based on Stock Quantity
    $stockQuantity = $request->input('stock_quantity');
    $stockStatus = $stockQuantity > 0 ? 'In Stock' : 'Out of Stock';

    // Handle Product Image Upload if updated
    if ($request->hasFile('product_image')) {
        $productImage = $request->file('product_image')->store('product_images', 'public');
        $product->product_image = $productImage;
    }

    // Update Product Fields
    $product->update([
        'product_name' => $request->input('product_name'),
        'description' => $request->input('description'),
        'product_price' => $request->input('product_price'),
        'category_id' => $request->input('category_id'),
        'brand_id' => $request->input('brand_id'),
        'stock_quantity' => $stockQuantity,
        'stock_status' => $stockStatus,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}


    public function destroy(Product $product)
    { 
        $product->delete();
                return redirect()->route('products.index')
                ->with('success','Product deleted successfully');
    }    
}
