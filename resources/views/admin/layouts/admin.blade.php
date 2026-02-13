<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
</head>

<body>
    <div class="admin-layout">

        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>EduTech Admin</h2>
            </div>

            <div class="sidebar-nav">

                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active">Dashboard</a>
                </div>

                <!-- Users -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage Users</a>
                    <div class="nav-submenu">
                        <div class="nav-item">
                            <a href="{{ route('admin.user.create') }}" class="nav-link">Add User</a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link">Users List</a>
                        </div>
                    </div>
                </div>

                <!-- Pages -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage Pages</a>
                    <div class="nav-submenu">
                        <div class="nav-item">
                            <a href="{{ route('admin.page.create') }}" class="nav-link">Add Page</a>
                        </div>

                        <div class="nav-item">
                            <a href="{{ route('admin.page.index') }}" class="nav-link">Pages List</a>
                        </div>
                    </div>
                </div>

                <!-- Sliders -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage Sliders</a>
                    <div class="nav-submenu">

                        <div class="nav-item">
                            <a href="{{ route('admin.slider.create') }}" class="nav-link">Add Slider</a>
                        </div>

                        <div class="nav-item">
                            <a href="{{ route('admin.slider.index') }}" class="nav-link">Sliders List</a>
                        </div>

                    </div>
                </div>

                <!-- Blocks -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage Blocks</a>
                    <div class="nav-submenu">

                        <div class="nav-item">
                            <a href="{{ route('admin.block.create') }}" class="nav-link">Block Page</a>
                        </div>

                        <div class="nav-item">
                            <a href="{{ route('admin.block.index') }}" class="nav-link">Block List</a>
                        </div>


                    </div>
                </div>

                <!-- Roles -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage Roles</a>
                    <div class="nav-submenu">
                        <div class="nav-item">
                            <a href="{{ route('admin.role.create') }}" class="nav-link">Add Role</a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('admin.role.index') }}" class="nav-link">Role List</a>
                        </div>
                    </div>
                </div>

                <!-- Permissions -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Permissions</a>
                    <div class="nav-submenu">
                        <div class="nav-item">
                            <a href="{{ route('admin.permission.create') }}" class="nav-link">Add Permission</a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('admin.permission.index') }}" class="nav-link">Permission List</a>
                        </div>
                    </div>
                </div>

                <!-- Products -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage Products</a>
                    <div class="nav-submenu">
                        <div class="nav-item">
                            <a href="{{ route('admin.product.create') }}" class="nav-link">Add Product</a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link">Product List</a>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage Categories</a>
                    <div class="nav-submenu">
                        <div class="nav-item">
                            <a href="{{ route('admin.category.create') }}" class="nav-link">Add Category</a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link">Category List</a>
                        </div>
                    </div>
                </div>

                <!-- Attributes -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage Attributes</a>
                    <div class="nav-submenu">
                        <div class="nav-item">
                            <a href="{{ route('admin.attribute.create') }}" class="nav-link">Add Attribute</a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('admin.attribute.index') }}" class="nav-link">Attribute List</a>
                        </div>
                    </div>
                </div>

                <!-- Coupons -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage Coupons</a>
                    <div class="nav-submenu">
                        <div class="nav-item">
                            <a href="{{ route('admin.coupon.create') }}" class="nav-link">Add Coupons</a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('admin.coupon.index') }}" class="nav-link">Coupon List</a>
                        </div>
                    </div>
                </div>


                <!-- Coupons -->
                <div class="nav-item">
                    <a href="#" class="nav-link">Manage order</a>
                    <div class="nav-submenu">
                        <div class="nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="nav-link">order list</a>
                        </div>

                    </div>
                </div>

                <!-- Enquiry -->
                <div class="nav-item">
                    <a href="{{ route('admin.enquiry.index') }}" class="nav-link active">Enquiry</a>
                </div>



            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">

            <!-- Top Bar -->
            <header class="top-bar">
                <button class="mobile-menu-toggle" onclick="toggleSidebar()">☰</button>
                <h1>Dashboard</h1>

                <div class="user-info">
                    @auth
                    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                    @endauth

                    @guest
                    <a href="{{ route('admin.login') }}">Login</a>
                    @endguest
                </div>
            </header>

            <!-- Content -->
            <div class="content-area">
                @yield('content')
            </div>

        </main>

    </div>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
</body>

</html>