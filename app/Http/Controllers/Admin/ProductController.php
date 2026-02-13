<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'categories',
            'attributeValues.attribute'
        ])->get();

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $attributes = ProductAttribute::with('values')->get();
        return view('admin.product.create', compact('categories', 'attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'sku'       => 'required',
            'price'     => 'required',
            'quantity'  => 'required',
            'thumbnail' => 'required|image',
        ]);

        $image = $request->file('thumbnail')->store('product-images', 'public');

        $product = Product::create([
            'name'              => $request->name,
            'slug'              => $request->slug ?? Str::slug($request->name),
            'sku'               => $request->sku,
            'price'             => $request->price,
            'sale_price'        => $request->sale_price,
            'quantity'          => $request->quantity,
            'thumbnail'         => $image,
            'description'       => $request->description,
            'short_description' => $request->short_description,
            'status'            => $request->status ?? 1,
        ]);

        // Save categories
        $product->categories()->sync($request->categories ?? []);

        // Save attribute values
        $syncData = [];
        foreach ($request->attribute_values ?? [] as $valueId) {
            $value = ProductAttributeValue::find($valueId);
            if ($value) {
                $syncData[$valueId] = ['attribute_id' => $value->attribute_id];
            }
        }
        $product->attributeValues()->sync($syncData);

        return redirect()->route('admin.product.index')
            ->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $product->load('attributeValues');
        $categories = Category::where('status', 1)->get();
        $attributes = ProductAttribute::with('values')->get();

        return view('admin.product.edit', compact('product', 'categories', 'attributes'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'thumbnail' => 'nullable|image',
        ]);

        $image = $product->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail')->store('product-images', 'public');
        }

        $product->update([
            'name'              => $request->name,
            'slug'              => $request->slug ?? Str::slug($request->name),
            'sku'               => $request->sku,
            'price'             => $request->price,
            'sale_price'        => $request->sale_price,
            'quantity'          => $request->quantity,
            'thumbnail'         => $image,
            'description'       => $request->description,
            'short_description' => $request->short_description,
            'status'            => $request->status ?? 1,
        ]);

        $product->categories()->sync($request->categories ?? []);

        $syncData = [];
        foreach ($request->attribute_values ?? [] as $valueId) {
            $value = ProductAttributeValue::find($valueId);
            if ($value) {
                $syncData[$valueId] = ['attribute_id' => $value->attribute_id];
            }
        }
        $product->attributeValues()->sync($syncData);

        return redirect()->route('admin.product.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index');
    }

    public function show($slug)
    {
        $product = Product::with('attributeValues')->where('slug', $slug)->firstOrFail();

        $categories = Category::all();

        return view('frontend.product.show', compact('product', 'categories'));
    }
}
