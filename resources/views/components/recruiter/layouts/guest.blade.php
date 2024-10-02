<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobEntry Recruiter @yield('title')</title>
    <link href="{{ asset('logo.svg') }}" rel="icon">
    @yield('css')
    <x-front.common.css_links />
</head>

<body>
    <a href="http://localhost:8000" class="navbar-brand d-flex align-items-center justify-content-center text-center py-4 px-4 px-lg-5">
        <h1 class="m-0 text-primary text-center">JobEntry</h1>
    </a>
    @yield('content')


    
    <x-front.common.js_links />
    @yield('script')
</body>

</html>
