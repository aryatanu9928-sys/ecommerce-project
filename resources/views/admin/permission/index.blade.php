@extends('admin.layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Permission Management</h3>

        <div class="d-flex gap-1">


            <a href="{{ route('admin.permission.create') }}" class="btn btn-primary">+Add New Permission</a>

        </div>

    </div>

    <div class="card-body">

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>


                            <div class="action-buttons">
                                <a href="{{ route('admin.permission.edit', $permission->id) }}" class="btn btn-sm btn-primary">Edit</a>



                                <form action="{{ route('admin.permission.destroy', $permission->id) }}"
                                    method="POST" onsubmit="return confirm('Are you sure?')"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="logout-btn">Delete</button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection