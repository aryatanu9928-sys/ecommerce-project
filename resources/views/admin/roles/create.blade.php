@extends('admin.layouts.admin')

@section('content')

<form action="{{ route('admin.role.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" required>
        </div>

        <h4>Assign Permissions</h4>

        <div style="margin-bottom: 10px;">
            <input type="checkbox" id="select-all">
            <strong>Select All</strong>
        </div>

        @foreach($permissions as $permission)
        <div>
            <input type="checkbox" class="permission-checkbox" name="permissions[]" value="{{ $permission->id }}">
            {{ $permission->name }}
        </div>
        @endforeach

        <div class="d-flex gap-1" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Create Role</button>
            <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
</form>
</div>
</div>
</div>
</main>
</div>

<!-- JS Script -->
<script>
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>


@endsection