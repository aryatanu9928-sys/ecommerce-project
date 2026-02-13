<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = ProductAttribute::with('values')->get();
        return view('admin.attribute.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|string',
            'status' => 'required',
            'values' => 'required',

        ]);

        $attribute = ProductAttribute::create([
            'name' => $request->name,
            'slug' =>  $request->slug,
            'status' => $request->status,

        ]);

        foreach ($request->values as $val) {
            ProductAttributeValue::create([
                'attribute_id' => $attribute->id,
                'value'        => $val['name'],
                'slug'         => strtolower(str_replace(' ', '-', $val['name'])),
                'status'       => $val['status'],
            ]);
        }


        return redirect()->route('admin.attribute.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAttribute $productAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    // public function edit(ProductAttribute $productAttribute)
    // {
    //     $productAttribute->load('values');
    //     return view('admin.attribute.edit', compact('productAttribute'));
    // }
    public function edit($id)
    {
        $productAttribute = ProductAttribute::with('values')->findOrFail($id);

        return view('admin.attribute.edit', compact('productAttribute'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attribute = ProductAttribute::findOrFail($id);

        $attribute->update([
            'name' => $request->name,
        ]);

        // Update existing values
        if ($request->existing_values) {
            foreach ($request->existing_values as $valueId => $value) {
                ProductAttributeValue::where('id', $valueId)->update([
                    'value' => $value
                ]);
            }
        }

        // Add new value
        if ($request->attribute_value) {
            ProductAttributeValue::create([
                'attribute_id' => $attribute->id,
                'value' => $request->attribute_value
            ]);
        }

        return redirect()->route('admin.attribute.index')
            ->with('success', 'Attribute updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAttribute $productAttribute)
    {
        $productAttribute->delete();
        return redirect()->route('admin.attribute.index');
    }
}
