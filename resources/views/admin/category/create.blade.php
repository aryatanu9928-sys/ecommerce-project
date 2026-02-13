@extends('admin.layouts.admin')

@section('content')
<form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group mb-3">
        <label>Parent Category</label>
        <select name="parent_id" class="form-control">
            <option value="">-- Select Parent Category --</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group mb-3">
        <label>Name *</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Products</label>
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input"
                        type="checkbox"
                        name="product_ids[]"
                        value="{{ $product->id }}"
                        id="product_{{ $product->id }}">
                    <label class="form-check-label" for="product_{{ $product->id }}">
                        {{ $product->name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="form-group mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <button class="btn btn-primary">Save</button>
</form>
@endsection