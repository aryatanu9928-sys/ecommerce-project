@extends('admin.layouts.admin')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>All Enquiries</h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($enquiries as $enquiry)
                <tr>
                    <td>{{ $enquiry->id }}</td>
                    <td>{{ $enquiry->name }}</td>
                    <td>{{ $enquiry->email }}</td>
                    <td>{{ $enquiry->phone }}</td>
                    <td>{{ $enquiry->message }}</td>
                    <td>
                        {{ $enquiry->is_read ? 'Read' : 'Unread' }}
                    </td>

                    <td>
                        @if(!$enquiry->is_read)
                        <a href="{{ route('admin.enquiries.markRead', $enquiry->id) }}"
                            class="btn btn-sm btn-success mb-1">
                            Mark as Read
                        </a>
                        @endif

                        <form action="{{ route('admin.enquiry.destroy', $enquiry->id) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Delete this enquiry?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection