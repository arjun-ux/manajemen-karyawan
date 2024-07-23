@extends('layouts.main')
@section('content')
<div class="container-login">
    <form class="login-form" action="{{ route('doLogin') }}" method="post">
        @csrf
        <div class="title">LOGIN</div>
        <div class="form-group">
            <input type="text" id="username" name="username" required placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" required placeholder="Password">
        </div>
        <button type="submit">Login</button>
    </form>
</div>
@endsection
