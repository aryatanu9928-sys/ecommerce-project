@extends('admin.layouts.admin')

@section('content')
<h3>Add Slider</h3>

<form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Title *</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Ordering *</label>
        <input type="number" name="ordering" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Status *</label>
        <select name="status" class="form-control" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Slider Image *</label>
        <input type="file" name="image" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection