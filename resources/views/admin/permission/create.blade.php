@extends('admin.layouts.admin')

@section('content')

<h1>Permission Form</h1>


<form action="{{ route('admin.permission.store')}}" method="POST">
    @csrf
    <div>
        <label>Name:</label>
        <input type="text" name="name" required>
    </div>
    <button type="submit" class="logout-btn">Save</button>
</form>


@endsection