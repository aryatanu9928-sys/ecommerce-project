@extends('admin.layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Edit User</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method("PUT")

            <!-- Name & Email -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
                </div>
            </div>

            <!-- Password -->
            <div class="form-row mt-3">
                <div class="form-group col-md-6">
                    <label for="password">Password (Leave blank to keep current)</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                </div>

                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm new password">
                </div>
            </div>

            <!-- Roles -->
            <div class="mt-3">
                <label><strong>Assign Roles:</strong></label>
                @foreach($roles as $role)
                <div class="form-check">
                    <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->name }}"
                        class="form-check-input"
                        {{ in_array($role->name, $userRoles) ? 'checked' : '' }}>
                    <label for="role_{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                </div>
                @endforeach
            </div>

            <!-- Active -->
            <div class="form-check mt-3">
                <input type="checkbox" id="is_active" name="is_active" class="form-check-input"
                    {{ $user->is_active ? 'checked' : '' }}>
                <label for="is_active" class="form-check-label">Active User</label>
            </div>

            <!-- Buttons -->
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection