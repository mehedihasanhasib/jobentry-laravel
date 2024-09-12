<div class="col-md-3 bg-white p-4 shadow-sm rounded" style="min-height: 35vh">
    <ul class="list-group list-group-flush">
        @php
            $links = ['Personal', 'Education', 'Training', 'Employment', 'Log out'];  // Add sidebar links here
            $icons = ['fa fa-user', 'fa fa-graduation-cap', 'fa fa-cog', 'fa fa-briefcase', 'fa fa-sign-out-alt']; // Add icons here
            $ids = ['personal', 'education', 'training', 'employment', 'logout']; // Add ids here
        @endphp
        @foreach ($links as $key => $link)
            <li class="list-group-item p-2 links {{ $key == 0 ? 'active' : '' }}" id="{{ $ids[$key] }}">
                <i class="{{ $icons[$key] }} me-3"></i> {{ $link }}
            </li>
        @endforeach
    </ul>
</div>
