@extends('components.front.layouts.app')
@section('title')
    Signup
@endsection
@section('content')
    @include('components.front.common.header', ['heading' => 'Sign Up'])
    <div class="container-fluid d-flex align-items-center justify-content-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="row w-100">
            <div class="col-md-8 col-lg-10 col-xl-8 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Create an Account</h2>
                        <form id="registrationForm" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3 d-flex justify-content-center">
                                <img class="rounded-circle" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar"
                                    style="width: 150px;" />
                                <label for="image" style="cursor: pointer">
                                    <i class="fa fa-camera"></i>
                                </label>
                                <input class="d-none" id="image" name="image" type="file">
                            </div>
                            @php
                                $fields = [
                                    'name' => [
                                        'label' => 'Name',
                                        'type' => 'text',
                                        'placeholder' => 'Enter your name',
                                        'required' => true,
                                    ],
                                    'email' => [
                                        'label' => 'Email',
                                        'type' => 'email',
                                        'placeholder' => 'Enter your email',
                                        'required' => true,
                                    ],
                                    'dob' => [
                                        'label' => 'Date of Birth',
                                        'type' => 'date',
                                        'placeholder' => 'Select Date of Birth',
                                        'required' => true,
                                    ],
                                    'phone' => [
                                        'label' => 'Phone Number',
                                        'type' => 'tel',
                                        'placeholder' => 'Enter your phone number',
                                        'required' => true,
                                    ],
                                    'password' => [
                                        'label' => 'Password',
                                        'type' => 'password',
                                        'placeholder' => 'Password',
                                        'required' => true,
                                    ],
                                    'password_confirmation' => [
                                        'label' => 'Confirm Password',
                                        'type' => 'password',
                                        'placeholder' => 'Confirm Password',
                                        'required' => true,
                                    ],
                                ];
                            @endphp
                            <div class="row">
                                @foreach ($fields as $key => $field)
                                    <div class="form-group mb-3 col-lg-6">
                                        <label class="form-label">{{ $field['label'] }}</label>
                                        <div class="input-group">
                                            <input class="form-control" name="{{ $key }}"
                                                type="{{ $field['type'] }}" value="{{ old($key) }}"
                                                placeholder="{{ $field['placeholder'] }}" />
                                        </div>
                                        <span class="{{ $key }} text-danger errors"></span>
                                    </div>
                                @endforeach
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

@section('script')
    <script>
        

        $('#registrationForm').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this)
            submitForm({type:"post", url:"/register", formData})
        });
    </script>
@endsection
