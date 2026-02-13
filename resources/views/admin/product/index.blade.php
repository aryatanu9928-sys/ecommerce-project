@extends('admin.layouts.admin')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Products</h3>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Add Product</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Categories</th>
            <th>Name</th>
            <th>Attributes</th>
            <th>Slug</th>
            <th>Price</th>
            <th>Sale Price</th>
            <th>Image</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>

            <td>
                @if($product->categories->count())
                {{ $product->categories->pluck('name')->join(', ') }}
                @else
                —
                @endif
            </td>

            {{-- Product Name --}}
            <td>{{ $product->name }}</td>

            {{-- Attribute Values --}}
            <td>
                @forelse($product->attributeValues as $av)
                <strong>{{ $av->attribute->name }}:</strong> {{ $av->value }} <br>
                @empty
                —
                @endforelse
            </td>

            <td>{{ $product->slug }}</td>

            {{-- Price --}}
            <td>
                ${{ number_format($product->price, 2) }}
            </td>

            {{-- Sale Price --}}
            <td>
                @if($product->sale_price)
                <strong>${{ number_format($product->sale_price, 2) }}</strong>
                @else
                —
                @endif
            </td>

            {{-- Image --}}
            <td>
                @if($product->thumbnail)
                <img src="{{ asset('storage/'.$product->thumbnail) }}"
                    style="width:70px;height:70px;object-fit:cover;border-radius:50%;">
                @else
                —
                @endif
            </td>

            {{-- Status --}}
            <td>
                @if($product->status)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-secondary">Inactive</span>
                @endif
            </td>

            {{-- Actions --}}
            <td>
                <a href="{{ route('admin.product.edit', $product->id) }}"
                    class="btn btn-sm btn-warning mb-1">Edit</a>

                <form action="{{ route('admin.product.destroy', $product->id) }}"
                    method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection