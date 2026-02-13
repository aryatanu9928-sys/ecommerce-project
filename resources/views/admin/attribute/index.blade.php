@extends('admin.layouts.admin')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>Attributes</h3>
        <a href="{{ route('admin.attribute.create') }}" class="btn btn-primary">
            Add Attribute
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Attribute Name</th>
                <th>Values</th>
                <th>Status</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attributes as $key => $attribute)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $attribute->name }}</td>
                <td>
                    @if($attribute->values->count())
                    @foreach($attribute->values as $val)
                    <span class="badge bg-info">
                        {{ $val->value }}
                    </span>
                    @endforeach
                    @else
                    <span class="text-muted">No values</span>
                    @endif
                </td>
                <td>
                    @if($attribute->status)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.attribute.edit', $attribute->id) }}"
                        class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('admin.attribute.destroy', $attribute->id) }}"
                        method="POST"
                        style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">
                    No attributes found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection