@extends("components.front.layouts.app")
@section('title')
    Profile
@endsection
@section("content")
    <div class="container-fluid p-4" style="background-color: #f8f9fa">
        <div class="row">
            @include('components.front.profile.profile_sidebar')

            @yield('information')
        </div>
    </div>
@endsection