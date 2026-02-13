@extends('admin.layouts.admin')

@section('content')

<h3 class="mb-4">Edit Product</h3>

<form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')



    {{-- NAME --}}
    <div class="form-group mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>

    {{-- SLUG --}}
    <div class="form-group mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
    </div>

    {{-- SKU --}}
    <div class="form-group mb-3">
        <label>SKU</label>
        <input type="text" name="sku" class="form-control" value="{{ $product->sku }}" required>
    </div>

    {{-- PRICE --}}
    <div class="form-group mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>

    {{-- SALE PRICE --}}
    <div class="form-group mb-3">
        <label>Sale Price</label>
        <input type="number" name="sale_price" class="form-control" value="{{ $product->sale_price }}">
    </div>

    {{-- QUANTITY --}}
    <div class="form-group mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
    </div>

    {{-- THUMBNAIL --}}
    <div class="form-group mb-3">
        <label>Thumbnail</label><br>

        @if($product->thumbnail)
        <div class="mb-2">
            <img
                src="{{ asset('storage/' . $product->thumbnail) }}"
                alt="Product Image"
                style="width:120px; height:auto;">
        </div>
        @endif

        <input type="file" name="thumbnail" class="form-control">
    </div>

    {{-- DESCRIPTION --}}
    <div class="form-group mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>

    {{-- SHORT DESCRIPTION --}}
    <div class="form-group mb-3">
        <label>Short Description</label>
        <textarea name="short_description" class="form-control">{{ $product->short_description }}</textarea>
    </div>

    {{-- STATUS --}}
    <div class="form-group mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    {{-- CATEGORY --}}
    <div class="form-group mb-3">
        <label>Category</label>

        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4">
                <div class="form-check mb-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="categories[]"
                        value="{{ $category->id }}"
                        id="category_{{ $category->id }}"
                        {{ $product->categories->contains($category->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="category_{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    {{-- ATTRIBUTES --}}
    <div class="form-group mb-4">
        <label>Assign Attributes</label>

        @foreach($attributes as $attribute)
        <div class="mb-3 border p-2 rounded">
            <strong>{{ $attribute->name }}</strong>

            <div class="row mt-2">
                @foreach($attribute->values as $val)
                <div class="col-md-3">
                    <div class="form-check mb-1">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="attribute_values[]"
                            value="{{ $val->id }}"
                            id="attr_{{ $val->id }}"
                            {{ $product->attributeValues->contains($val->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="attr_{{ $val->id }}">
                            {{ $val->value }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>


    <button type="submit" class="btn btn-primary w-100">Update</button>

</form>

@endsection