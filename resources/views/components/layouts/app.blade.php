<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JobEntry - Job Portal Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @yield('css')
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    @include('components.common.css_links')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        @include('components.common.loader')
        @include('components.common.navbar')
       

        @yield('content')

        @include('components.common.footer')
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('components.common.js_links')
    @yield('script')
</body>

</html>
