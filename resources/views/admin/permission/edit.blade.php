@extends('admin.layouts.admin')
@section('content')
<h3>Add Permission</h3>

<form action="{{ route('admin.permission.update', $permissions->id) }}" method="POST">

    @csrf
    @method('PUT')
    <div class="mb-3">
        <label> Name *</label>
        <input type="text" name="name" class="form-control" value="{{ $permissions->name }}">
    </div>



    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection