@extends('admin.layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>All Block</h3>
        @can('block_create')
        <div class="d-flex gap-1">
            <a href="{{ route('admin.block.create') }}" class="btn btn-primary">Add New Block</a>
        </div>
        @endcan
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Identifier</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($blocks as $block)
                <tr>
                    <td>{{ $block->id }}</td>
                    <td>{{ $block->name }}</td>
                    <td>{{ $block->identifier }}</td>
                    <td>{{ $block->description }}</td>

                    <td>
                        @if($block->image)
                        <img src="{{ Storage::url($block->image) }}" width="80">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>

                    <td>
                        @can('block_edit')
                        <a href="{{ route('admin.block.edit', $block->id) }}">Edit</a>
                        @endcan
                        @can('block_edit')
                        <form action="{{ route('admin.block.destroy', $block->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection