<!DOCTYPE>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to the Laravel Application</h1>
    <button><a href="{{ route('user.login') }}">User Login</a></button>
    <button><a href="{{ route('admin.login') }}">Admin Login</a></button>
</body>
</html>
