@extends('admin.layouts.admin')

@section('content')
<h3>Edit Slider</h3>

<form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Title *</label>
        <input type="text" name="title" class="form-control" value="{{ $slider->title }}" required>
    </div>

    <div class="mb-3">
        <label>Ordering *</label>
        <input type="number" name="ordering" class="form-control" value="{{ $slider->ordering }}" required>
    </div>

    <div class="mb-3">
        <label>Status *</label>
        <select name="status" class="form-control" required>
            <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $slider->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Old Image</label><br>
        <img src="{{ asset('uploads/sliders/' . $slider->image) }}" width="120" class="mb-2">
    </div>

    <div class="mb-3">
        <label>Change Slider Image (Optional)</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection