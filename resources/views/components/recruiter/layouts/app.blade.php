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

    <!-- Sweet Alert -->
    <link href="{{ asset('css/sweetAlert.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary-color: #00b074;
            --secondary-color: #f0f7f4;
            --text-color: #2d3748;
            --light-text-color: #718096;
            --accent-color: #4299e1;
        }

        .btn{
            color: #fff
        }

        body {
            background-color: var(--secondary-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
        }

        #sidebar {
            min-width: 280px;
            max-width: 280px;
            min-height: 100vh;
            background-color: var(--primary-color);
            transition: all 0.3s;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        }

        #sidebar.active {
            margin-left: -280px;
        }

        #content {
            width: 100%;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .nav-link {
            color: #ffffff;
            transition: all 0.3s;
            border-radius: 8px;
            margin-bottom: 8px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .nav-link i {
            margin-right: 12px;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #007d5c;
            color: white;
            /* transform: scale(1.1); */
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: none;
            padding: 1.5rem;
        }

        .card-title {
            /* color: var(--primary-color); */
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-body h2 {
            /* color: var(--primary-color); */
            font-weight: 700;
            font-size: 2.5rem;
        }

        .list-group-item {
            border: none;
            padding: 1rem 1.5rem;
            background-color: transparent;
            transition: all 0.3s;
            border-radius: 8px;
        }

        .list-group-item:hover {
            background-color: rgba(0, 176, 116, 0.05);
        }

        /* .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
        } */

        .btn-primary:hover {
            color: #fff
        }

        .badge {
            padding: 0.5em 1em;
            font-weight: 600;
            background-color: var(--primary-color);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .progress {
            height: 8px;
            background-color: #e2e8f0;
        }

        .progress-bar {
            background-color: var(--primary-color);
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -280px;
            }

            #sidebar.active {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="px-3 py-3">
            <h3 class="text-center mb-4 text-white fw-bold">JobEntry</h3>
            <ul class="list-unstyled">
                <li><a href="#" class="nav-link active"><i class="fas fa-home me-3"></i>Dashboard</a></li>
                <li><a href="#" class="nav-link"><i class="fas fa-briefcase me-3"></i>Jobs</a></li>
                <li><a href="#" class="nav-link"><i class="fas fa-user-tie me-3"></i>Candidates</a></li>
                <li><a href="#" class="nav-link"><i class="fas fa-chart-bar me-3"></i>Analytics</a></li>
                <li><a href="#" class="nav-link"><i class="fas fa-cog me-3"></i>Settings</a></li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg mb-4">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary"
                        style="border-radius: 0 !important;">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="ms-auto" style="margin-right: 20px;">

                        <div class="dropdown">
                            <a class="dropdown-toggle d-flex align-items-center" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- <span class="me-2">John Doe</span> -->
                                <div class="avatar">JD</div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="p-4">
                <h2 class="mb-4 fw-bold">Dashboard Overview</h2>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-3">Open Jobs</h5>
                                <h2 class="mb-3">24</h2>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-3">New Applications</h5>
                                <h2 class="mb-3">87</h2>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-3">Interviews Scheduled</h5>
                                <h2 class="mb-3">12</h2>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-3">Offers Sent</h5>
                                <h2 class="mb-3">5</h2>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Recent Applications</h5>
                                <a href="#" class="btn btn-sm btn-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">JD</div>
                                            <div>
                                                <h6 class="mb-0">John Doe</h6>
                                                <small class="text-muted">Applied 2 days ago</small>
                                            </div>
                                        </div>
                                        <span class="badge rounded-pill">Software Engineer</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">JS</div>
                                            <div>
                                                <h6 class="mb-0">Jane Smith</h6>
                                                <small class="text-muted">Applied 3 days ago</small>
                                            </div>
                                        </div>
                                        <span class="badge rounded-pill">UX Designer</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">MJ</div>
                                            <div>
                                                <h6 class="mb-0">Mike Johnson</h6>
                                                <small class="text-muted">Applied 4 days ago</small>
                                            </div>
                                        </div>
                                        <span class="badge rounded-pill">Data Analyst</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Upcoming Interviews</h5>
                                <a href="#" class="btn btn-sm btn-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">SB</div>
                                            <div>
                                                <h6 class="mb-0">Sarah Brown</h6>
                                                <small class="text-muted">Software Engineer</small>
                                            </div>
                                        </div>
                                        <span class="badge rounded-pill">10:00 AM</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">TW</div>
                                            <div>
                                                <h6 class="mb-0">Tom Wilson</h6>
                                                <small class="text-muted">UX Designer</small>
                                            </div>
                                        </div>
                                        <span class="badge rounded-pill">2:30 PM</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">ED</div>
                                            <div>
                                                <h6 class="mb-0">Emily Davis</h6>
                                                <small class="text-muted">Data Analyst</small>
                                            </div>
                                        </div>
                                        <span class="badge rounded-pill">4:15 PM</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.front.common.js_links')
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>

</html>
