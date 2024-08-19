@extends("components.front.layouts.app")
@section("content")
@include('components.front.common.header', ['heading' => 'Sign Up'])
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="row w-100">
            <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Create an Account</h2>
                        <form onsubmit="handleSubmit(event)">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input
                                           class="form-control" type="text" placeholder="Full Name" required />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input
                                           class="form-control" type="email" placeholder="Email Address" required />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input
                                           class="form-control" type="password" placeholder="Password" required />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input
                                           class="form-control" type="password" placeholder="Confirm Password" required />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select class="form-select" required>
                                        <option value="jobseeker">Job Seeker</option>
                                        <option value="employer">Employer</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary w-100 mb-4" type="submit">
                                Sign Up
                            </button>
                        </form>
                        <div class="text-center">
                            <p>
                                Already have an account?
                                <a class="text-primary" href="{{ route('login') }}">Sign in</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
