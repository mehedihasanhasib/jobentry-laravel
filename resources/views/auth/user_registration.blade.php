@extends('components.front.layouts.app')
@section('title')
    Signup
@endsection

@section('css')
    <style>
        .position-relative {
            display: inline-block;
            position: relative;
            margin-bottom: 20px;
        }

        .rounded-circle {
            width: 165px;
            height: 165px;
            border-radius: 50%;
            background-color: #0088ff;
            /* Blue background */
            object-fit: cover;
            border: 4px solid #fff;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            transition: all 0.3s ease;
        }

        /* .position-relative:hover .rounded-circle {
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        } */

        .camera-label {
            position: absolute;
            bottom: -7px;
            left: 50%;
            transform: translateX(-50%);
            width: 200%;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.6);
            border-bottom: 4px solid #fff;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            overflow: hidden;
            padding-top: 6px;
        }

        .camera-label::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg,
                    transparent,
                    rgba(255, 255, 255, 0.6),
                    transparent);
            transition: 0.5s;
        }

        .position-relative:hover .camera-label::before {
            left: 100%;
        }

        .camera-label i {
            /* color: #00b074; */
            font-size: 18px;
            margin-top: -15px;
            transition: all 0.3s ease;
        }

        .position-relative:hover .camera-label i {
            transform: scale(1.2);
        }

        .profile_picture {
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
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
                            <div class="mb-3 d-flex flex-column align-items-center justify-content-center">
                                <div class="position-relative">
                                    <img id="imagePreview" class="rounded-circle" src="{{ asset('assets/img/user-dummy-img.jpg') }}" alt="Avatar" />
                                    <label class="camera-label" for="image">
                                        <i class="fa fa-camera"></i>
                                    </label>
                                </div>
                                <input class="d-none" id="image" name="profile_picture" type="file" accept="image/*" />
                                <span class="profile_picture text-danger errors mt-2"></span>
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
        // $(document).ready(function() {
        $('#image').on('change', function(e) {
            const files = e.target.files;
            if (files.length > 0) {
                const file = files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
        // });
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
