@extends('components.front.layouts.app')
@section('title')
    Login
@endsection
@section('content')
@include('components.front.common.header', ['heading' => 'Login'])
    <div class="container-fluid d-flex align-items-center justify-content-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="row w-100">
            <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Welcome Back!</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required />
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" />
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <a href="#" class="text-primary">Forgot password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-4">
                                Sign In
                            </button>
                        </form>
                        <div class="text-center">
                            <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary">Sign up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
