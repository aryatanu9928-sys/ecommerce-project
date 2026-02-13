@extends('admin.layouts.admin')

@section('content')

<h3 class="mb-4">Edit Attribute</h3>

<form action="{{ route('admin.attribute.update', ['attribute' => $productAttribute->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $productAttribute->name }}" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Attribute Value *</label>

        @foreach($productAttribute
        ->values as $v)
        <input type="text"
            name="existing_values[{{ $v->id }}]"
            value="{{ $v->value }}"
            class="form-control mb-2">
        @endforeach

        <input type="text" name="attribute_value"
            placeholder="Add New Value (Optional)"
            class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Slug *</label>
        <input type="text" name="slug" value="{{ $productAttribute->slug }}" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Status *</label>
        <select name="status" class="form-control">
            <option value="1" {{  $productAttribute->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{  $productAttribute->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Update</button>

</form>

@endsection