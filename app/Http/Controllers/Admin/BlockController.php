<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;

class BlockController extends Controller
{
    public function index()
    {
        $blocks = Block::all();
        return view('admin.block.index', compact('blocks'));
    }

    public function create()
    {
        return view('admin.block.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'identifier' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/blocks', 'public');
        }

        Block::create([
            'name' => $request->name,
            'identifier' => $request->identifier,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.block.index');
    }

    public function edit($id)
    {
        $blocks = Block::findOrFail($id);
        return view('admin.block.edit', compact('blocks'));
    }

    public function update(Request $request, $id)
    {
        $block = Block::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'identifier' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'identifier' => $request->identifier,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/blocks', 'public');
            $data['image'] = $imagePath;
        }

        $block->update($data);

        return redirect()->route('admin.block.index');
    }

    public function destroy($id)
    {
        Block::destroy($id);
        return redirect()->route('admin.block.index');
    }
}
