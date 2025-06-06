<h1>User Login</h1>
<form action="{{ route('user.login.action') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>
@if (session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif
