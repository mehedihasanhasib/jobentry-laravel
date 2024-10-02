@extends('components.recruiter.layouts.guest')
@section('title')
    SignIn
@endsection
@section('content')
    <div class="heading">Signin as Recruiter</div>
    <form>
        <input type="text" placeholder="Username" required>
        <input type="password" placeholder="Password" required>
        <button type="submit" class="login-button">Sign In</button>
    </form>
    <div class="links">
        <a href="#">Forgot password?</a>
        <a href="{{ route('recruiter.register') }}">Signup</a>
    </div>
@endsection
