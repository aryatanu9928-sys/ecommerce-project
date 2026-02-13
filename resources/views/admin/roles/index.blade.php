@extends('admin.layouts.admin')

@section('content')
<div class="content-area">
    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h3>All Roles</h3>
            <a href="{{ route('admin.role.create') }}" class="btn btn-primary">Add Role</a>
        </div>

        <div class="table-container">
            <table class="table" border="1" cellpadding="8">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>

                        <td>

                            <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>


                            <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this role?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>


                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No roles found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection