@extends("components.front.layouts.app")
@section("title")
    Signup
@endsection
@section("content")
    @include("components.front.common.header", ["heading" => "Sign Up"])
    <div class="container-fluid d-flex align-items-center justify-content-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="row w-100">
            <div class="col-md-8 col-lg-10 col-xl-8 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Create an Account</h2>
                        <form>
                            <div class="mb-3 d-flex justify-content-center">
                                <img class="rounded-circle" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar" style="width: 150px;" />
                                <label for="image" style="cursor: pointer">
                                    <i class="fa fa-camera"></i>
                                </label>
                                <input class="d-none" id="image" name="image" type="file">
                            </div>
                            @php
                                $fields = [
                                    "name" => [
                                        "label" => "Name",
                                        "type" => "text",
                                        "placeholder" => "Enter your name",
                                        "required" => true,
                                    ],
                                    "email" => [
                                        "label" => "Email",
                                        "type" => "email",
                                        "placeholder" => "Enter your email",
                                        "required" => true,
                                    ],
                                    "dob" => [
                                        "label" => "Date of Birth",
                                        "type" => "date",
                                        "placeholder" => "Select Date of Birth",
                                        "required" => true,
                                    ],
                                    "phone" => [
                                        "label" => "Phone Number",
                                        "type" => "tel",
                                        "placeholder" => "Enter your phone number",
                                        "required" => true,
                                    ],
                                    "password" => [
                                        "label" => "Password",
                                        "type" => "password",
                                        "placeholder" => "Password",
                                        "required" => true,
                                    ],
                                    "confirm_password" => [
                                        "label" => "Confirm Password",
                                        "type" => "password",
                                        "placeholder" => "Confirm Password",
                                        "required" => true,
                                    ],
                                ];
                            @endphp
                            <div class="row">
                                @foreach ($fields as $key => $field)
                                    <div class="form-group mb-3 col-lg-6">
                                        {{-- <div> --}}
                                            <label class="form-label">{{ $field["label"] }}</label>
                                            {{-- @if ($field["required"])
                                                <span class="text-danger">*</span>
                                            @endif --}}
                                        {{-- </div> --}}

                                        <div class="input-group">
                                            {{-- <span class="input-group-text bg-primary text-white">
                                                <i class="fa fa-user"></i>
                                            </span> --}}
                                            <input class="form-control" name="{{ $key }}" type="{{ $field["type"] }}" placeholder="{{ $field["placeholder"] }}" @required($field["required"]) />
                                        </div>
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
                                <a class="text-primary" href="{{ route("login") }}">Sign in</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
