@extends('admin.layouts.admin')

@section('content')
<form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="form-group mb-3">
        <label>Parent Category</label>
        <select name="parent_id" class="form-control">
            <option value="">-- Select Parent Category --</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" value="{{ $category->name }}" required>
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" value="{{ $category->slug }}">
    </div>

    <div class="form-group">
        <label>Products</label>

        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="form-check mb-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="product_ids[]"
                        value="{{ $product->id }}"
                        id="product_{{ $product->id }}"
                        {{ $category->products->contains($product->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="product_{{ $product->id }}">
                        {{ $product->name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <div class="form-group">
        <label>Current Image:</label><br>
        @if($category->image)
        <img src="{{ asset('storage/'.$category->image) }}" width="80"><br>
        @endif
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label>Status *</label>
        <select name="status">
            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Category</button>
</form>
@endsection