@extends('components.recruiter.layouts.app')

@section('content')
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
@endsection
