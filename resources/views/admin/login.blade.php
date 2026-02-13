<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - EduTech College</title>
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>Admin Panel</h1>
                <p>EduTech College Management System</p>
            </div>

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>

            <div class="text-center" style="margin-top: 1rem;">
                <a href="#" style="color: #667eea; text-decoration: none;">Forgot Password?</a>
            </div>
        </div>
    </div>
</body>

</html>