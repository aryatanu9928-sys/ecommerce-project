@extends('admin.layouts.admin')

@section('content')

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <h4>Total Users</h4>
        <div class="stat-number">1,234</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📄</div>
        <h4>Total Pages</h4>
        <div class="stat-number">45</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🎓</div>
        <h4>Active Students</h4>
        <div class="stat-number">856</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">👨‍🏫</div>
        <h4>Faculty Members</h4>
        <div class="stat-number">78</div>
    </div>
</div>

<!-- Recent Activity -->
<div class="card">
    <div class="card-header">
        <h3>Recent Activity</h3>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Action</th>
                        <th>User</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-01-15 10:30</td>
                        <td>User Created</td>
                        <td>Admin</td>
                        <td>New user: john.smith@email.com</td>
                    </tr>
                    <tr>
                        <td>2024-01-15 09:15</td>
                        <td>Page Updated</td>
                        <td>Admin</td>
                        <td>Updated About Us page</td>
                    </tr>
                    <tr>
                        <td>2024-01-14 16:45</td>
                        <td>User Deleted</td>
                        <td>Admin</td>
                        <td>Removed inactive user</td>
                    </tr>
                    <tr>
                        <td>2024-01-14 14:20</td>
                        <td>Page Created</td>
                        <td>Admin</td>
                        <td>New page: Contact Information</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <h3>Quick Actions</h3>
    </div>
    <div class="card-body">
        <div class="d-flex gap-1">
            <a href="{{route('admin.user.create')}}" class="btn btn-primary">Add New User</a>
            <a href="{{route('admin.page.create')}}" class="btn btn-success">Create New Page</a>
            <a href="{{route('admin.user.index')}}" class="btn btn-secondary">View All Users</a>
            <a href="{{route('admin.page.index')}}" class="btn btn-secondary">View All Pages</a>
        </div>
    </div>
</div>
</div>
</main>


@endsection