@extends('admin.layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>All Pages</h3>
        @can('page_create')
        <div class="d-flex gap-1">
            <a href="{{ route('admin.page.create') }}" class="btn btn-primary">Add New Page</a>
        </div>
        @endcan
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Heading</th>
                    <th>URL Key</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->heading }}</td>
                    <td>{{ $page->url_key }}</td>
                    <td>{{ $page->description, 50 }}</td>

                    <td>
                        @can('page_edit')
                        <a href="{{ route('admin.page.edit', $page->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                        @endcan

                        @can('page_index')
                        <form action="{{ route('admin.page.destroy', $page->id) }}"
                            method="POST"
                            style="display:inline-block;"
                            onsubmit="return confirm('Are you sure you want to delete this page?');">

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>

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