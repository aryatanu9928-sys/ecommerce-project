@extends('admin.layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Role</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Role Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
            </div>

            <div class="mb-3">
                <label>Permissions</label>
                @foreach($permissions as $permission)
                <div>
                    <input
                        type="checkbox"
                        name="permissions[]"
                        value="{{ $permission->id }}"
                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                    {{ $permission->name }}
                </div>
                @endforeach
            </div>

            <button class="btn btn-primary mt-2">Update</button>
            <a href="{{ route('admin.role.index') }}" class="btn btn-secondary mt-2">Back</a>
        </form>
    </div>
</div>
@endsection