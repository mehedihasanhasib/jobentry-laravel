<div class="col-md-3 bg-white p-4 shadow-sm rounded">
    <ul class="list-group list-group-flush">
        <li class="list-group-item p-0 {{ Route::is("user.profile.personal") ? "active" : "" }}">
            <a class="nav-link p-2 {{ Route::is("user.profile.personal") ? "text-white" : "" }}" href="{{ route("user.profile.personal") }}">
                <i class="fa fa-user me-3"></i> Personal Information
            </a>
        </li>
        <li class="list-group-item p-0 {{ Route::is("user.profile.education") ? "active" : "" }}">
            <a class="nav-link p-2 {{ Route::is("user.profile.education") ? "text-white" : "" }}" href="{{ route('user.profile.education') }}">
                <i class="fa fa-cog me-3"></i> Education
            </a>
        </li>
        <li class="list-group-item p-0">
            <a class="nav-link p-2" href="#">
                <i class="fa fa-bell me-3"></i> Notifications
            </a>
        </li>
        <li class="list-group-item p-0">
            <a class="nav-link p-2" href="#">
                <i class="fa fa-sign-out-alt me-3"></i> Logout
            </a>
        </li>
    </ul>
</div>
