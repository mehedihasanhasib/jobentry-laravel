<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    
    @yield('css')
    <link href="{{ asset('logo.svg') }}" rel="icon">

    <x-front.common.css_links />

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <x-front.common.loader />
        <x-front.common.navbar />
       

        @yield('content')

        <x-front.common.footer />
        
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>


    <x-front.common.js_links />

    @yield('script')
</body>

</html>
