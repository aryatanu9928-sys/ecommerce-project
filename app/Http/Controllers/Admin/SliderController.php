<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }


    public function create()
    {
        return view('admin.slider.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'ordering'  => 'required|integer',
            'status'    => 'required|boolean',
            'image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/sliders'), $imageName);

        // Create slider
        Slider::create([
            'title'     => $request->title,
            'ordering'  => $request->ordering,
            'status'    => $request->status,
            'image'     => $imageName,
        ]);

        return redirect()->route('admin.slider.index');
    }


    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }


    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'title'     => 'required',
            'ordering'  => 'required|integer',
            'status'    => 'required|boolean',
            'image'     => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'title'     => $request->title,
            'ordering'  => $request->ordering,
            'status'    => $request->status,
        ];

        if ($request->hasFile('image')) {

            $oldPath = public_path('uploads/sliders/' . $slider->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/sliders'), $imageName);

            $data['image'] = $imageName;
        }

        $slider->update($data);

        return redirect()->route('admin.slider.index');
    }


    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        $oldPath = public_path('uploads/sliders/' . $slider->image);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }

        $slider->delete();

        return redirect()->route('admin.slider.index');
    }
}
