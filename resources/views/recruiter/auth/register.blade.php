@extends('components.recruiter.layouts.guest')
@section('title')
    SignUp
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/userAvatar.css') }}">
    <style>
        .container-fluid {
            width: 73vw !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center wow fadeIn" data-wow-delay="0.1s">
        <div class="row w-100">
            <div class="col-md-8 col-lg-10 col-xl-8 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Create A Recruiter Account</h2>
                        <form id="registrationForm" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <x-front.user_avatar name="company_logo"/>

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
                                    'company_name' => [
                                        'label' => 'Company Name',
                                        'type' => 'text',
                                        'placeholder' => 'Company Name',
                                        'required' => true,
                                    ],
                                    'website' => [
                                        'label' => 'Website',
                                        'type' => 'text',
                                        'placeholder' => 'Company Website',
                                        'required' => false,
                                    ],
                                    'address' => [
                                        'label' => 'Address',
                                        'type' => 'text',
                                        'placeholder' => 'Company Address',
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
                                            <input class="form-control" name="{{ $key }}" type="{{ $field['type'] }}" value="{{ old($key) }}" placeholder="{{ $field['placeholder'] }}" />
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
                                <a class="text-primary" href="{{ route('recruiter.login') }}">Sign in</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <x-front.js.user_avatar_script />
@endsection
