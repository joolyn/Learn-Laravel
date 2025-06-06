<!DOCTYPE>
<html>
<head>
    <title>User Page</title>
</head>
<body>
    <h1>User Page</h1>
    @if (!session('username'))
        <p>You are not logged in.</p>
    @else
        <p>Logged in as: {{ session('username') }}</p>
    @endif
</body>
</html>