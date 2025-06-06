<!DOCTYPE>
<html>
<head>
    <title>User Page</title>
</head>
<body>
    <h1>Admin Page</h1>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @else
        <p>No Message</p>
    @endif
</body>
</html>