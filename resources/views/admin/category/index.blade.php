@extends('admin.layouts.admin')

@section('content')
<div class="content-area">
    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h3>All Categories</h3>
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                Add New Category
            </a>
        </div>

        <div class="table-container">
            <table class="table table-bordered" cellpadding="8">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>

                        <td>
                            {{ $category->name }}

                        </td>

                        {{-- PRODUCTS --}}
                        <td>
                            @forelse($category->products as $product)
                            <span class="badge bg-info">{{ $product->name }}</span>
                            @empty
                            <span class="text-muted">No Products</span>
                            @endforelse
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($category->status)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        {{-- IMAGE --}}
                        <td>
                            @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}" width="60">
                            @else
                            No Image
                            @endif
                        </td>

                        {{-- ACTION --}}
                        <td>
                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('admin.category.destroy', $category->id) }}"
                                method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this category?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No categories found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection