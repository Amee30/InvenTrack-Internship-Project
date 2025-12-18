<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500',
        ]);

        Category::create($request->all());

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
        ]);

        $category->update($request->all());

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // check if category is being used
        if ($category->barangs()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category because it is associated with existing items.');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
