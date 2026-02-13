@extends('admin.layouts.admin')

@section('content')
<h3>All Sliders</h3>

<a href="{{ route('admin.slider.create') }}" class="btn btn-primary mb-3">Add Slider</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Ordering</th>
            <th>Status</th>
            <th>Image</th>
            <th width="180">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($sliders as $slider)
        <tr>
            <td>{{ $slider->id }}</td>
            <td>{{ $slider->title }}</td>
            <td>{{ $slider->ordering }}</td>
            <td>
                @if($slider->status == 1)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                <img src="{{ asset('uploads/sliders/' . $slider->image) }}" width="60" height="40" style="object-fit:cover;">
            </td>
            <td>
                <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('admin.slider.destroy', $slider->id) }}"
                    method="POST"
                    style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure want to delete?')"
                        class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection