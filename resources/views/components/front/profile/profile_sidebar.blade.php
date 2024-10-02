<div class="col-md-3 bg-white p-4 shadow-sm rounded">
    <ul class="list-group list-group-flush">
        <x-front.user_avatar :user="$user" />
        @php
            $links = ['Personal', 'Education', 'Training', 'Employment', 'Log out']; // Add sidebar links here
            $icons = ['fa fa-user', 'fa fa-graduation-cap', 'fa fa-cog', 'fa fa-briefcase', 'fa fa-sign-out-alt']; // Add icons here
            $ids = ['personal', 'education', 'training', 'employment', 'logout']; // Add ids here
            // add index function route for new module
            $routes = [
                'Personal' => route('user.profile.personal'),
                'Education' => route('user.profile.education'),
                'Training' => route('user.profile.training'),
                'Employment' => route('user.profile.employment'),
                'Log out' => null,
            ];
        @endphp
        @foreach ($links as $key => $link)
            <li class="list-group-item p-2 links {{ $key == 0 ? 'active' : '' }}" id="{{ $ids[$key] }}" onclick="changeModule($(this), '{{ $routes[$link] }}')">
                <i class="{{ $icons[$key] }} me-3"></i> {{ $link }}
            </li>
        @endforeach
    </ul>
</div>
