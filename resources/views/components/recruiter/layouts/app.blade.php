<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{ asset('css/sweetAlert.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('recruiter/style.css') }}">

    @yield('css')
</head>

<body>
    <div class="d-flex">
        <x-recruiter.layouts.sidebar />

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary" style="border-radius: 0;">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="ms-auto">
                        <div class="dropdown">
                            <a class="d-flex align-items-center" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown">
                                <div class="avatar">
                                    {{ Str::upper(Str::take(Auth::guard('recruiter')->user()->company_name, 1)) }}
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('recruiter.logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="p-4">
                @yield('content')
            </div>
        </div>

        @include('components.front.common.js_links')
        <script>
            document.getElementById('sidebarCollapse').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('active');
            });

            $('button').click(function(e) {
                e.preventDefault();
                $(this).blur();
            });
        </script>
        @yield('script')
</body>


</html>
