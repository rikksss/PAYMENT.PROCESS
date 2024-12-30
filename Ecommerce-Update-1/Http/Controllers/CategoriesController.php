<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Search based on category_id or category_name
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('category_id', 'like', "%{$search}%")
                         ->orWhere('category_name', 'like', "%{$search}%");
        })->paginate(10);

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'category_name' => 'required|string|unique:categories,category_name',
        ]);

        // Create the category record
        Category::create([
            'category_name' => $validated['category_name'],
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'category_name' => 'required|string|unique:categories,category_name,' . $category->category_id . ',category_id',
        ]);

        // Update the category record
        $category->update([
            'category_name' => $validated['category_name'],
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Delete the category record
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
