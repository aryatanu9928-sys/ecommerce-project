@extends('admin.layouts.admin')

@section('content')
<form action="{{ route('admin.attribute.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Slug *</label>
        <input type="text" name="slug" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Status *</label>
        <select name="status" class="form-control">
            <option value="1" selected>Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <div class="form-group mt-4">
        <label>Attribute Values *</label>
        <table class="table table-bordered" id="attributeTable">
            <thead>
                <tr>
                    <th>Value Name</th>
                    <th>Status</th>
                    <th width="60">
                        <button type="button" class="btn btn-primary btn-sm" onclick="addRow()">+</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="values[0][name]" class="form-control" required>
                    </td>
                    <td>
                        <select name="values[0][status]" class="form-control" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">X</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Save</button>
</form>

<script>
    let index = 1;

    function addRow() {
        const tbody = document.querySelector('#attributeTable tbody');
        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td><input type="text" name="values[${index}][name]" class="form-control" required></td>
                <td>
                    <select name="values[${index}][status]" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">X</button></td>
            </tr>
        `);
        index++;
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
    }
</script>

@endsection