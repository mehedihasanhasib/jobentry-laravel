@extends('components.front.layouts.app')
@section('title')
    Signup
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/userAvatar.css') }}">
@endsection
@section('content')
    {{-- @include('components.front.common.header', ['heading' => 'Sign Up']) --}}
    <div class="container-fluid mt-5 d-flex align-items-center justify-content-center wow fadeIn" data-wow-delay="0.1s">
        <div class="row w-100">
            <div class="col-md-8 col-lg-10 col-xl-8 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Create an Account</h2>
                        <form id="registrationForm" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <x-front.user_avatar name="profile_picture" />

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
                                            <input class="form-control" name="{{ $key }}" type="{{ $field['type'] }}" value="{{ old($key) }}" placeholder="{{ $field['placeholder'] }}" @required($field['required']) />
                                        </div>
                                        <span class="{{ $key }} text-danger errors"></span>
                                    </div>
                                @endforeach
                            </div>
                            <input class="btn btn-primary w-100 mb-4" value="Sign Up" type="submit"></input>
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

            function successCallback(response) {
                window.location.href = response.url;
            }
            submitForm({
                type: "post",
                url: "/register",
                formData,
                successCallback
            })
        });
    </script>
@endsection
