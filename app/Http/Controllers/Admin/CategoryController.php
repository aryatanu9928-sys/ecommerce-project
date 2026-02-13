<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::with(['parent', 'products'])->get();
        return view('admin.category.index', compact('categories'));
    }

    // Show form to create new category
    public function create()
    {
        $categories = Category::all();
        $products   = Product::all();
        return view('admin.category.create', compact('categories', 'products'));
    }

    // Store new category
    public function store(Request $request)
    {
        $category = Category::create([
            'name'        => $request->name,
            'slug'        => $request->slug ?? Str::slug($request->name),
            'description' => $request->description,
            'parent_id'   => $request->parent_id ?: null,
            'status'      => $request->status,
        ]);

        // Sync products if selected
        if ($request->product_ids) {
            $category->products()->sync($request->product_ids);
        }

        return redirect()->route('admin.category.index')
            ->with('success', 'Category created successfully');
    }



    // Show edit form for a category
    public function edit($id)
    {
        $category = Category::with('products')->findOrFail($id);
        $products = Product::all();
        $categories = Category::where('id', '!=', $id)->get();

        return view('admin.category.edit', compact('category', 'products', 'categories'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->parent_id = $request->parent_id;

        if ($request->has('product_ids')) {
            $category->products()->sync($request->product_ids);
        } else {
            $category->products()->sync([]);
        }

        if ($request->hasFile('image')) {

            if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
                unlink(storage_path('app/public/' . $category->image));
            }

            $path = $request->file('image')->store('categories', 'public');
            $category->image = $path;
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully!');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image && file_exists(public_path('uploads/category/' . $category->image))) {
            unlink(public_path('uploads/category/' . $category->image));
        }

        $category->products()->detach();

        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category deleted successfully!');
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products;
        return view('frontend.category.show', compact('category', 'products'));
    }
}
