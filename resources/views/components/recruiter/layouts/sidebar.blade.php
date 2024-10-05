<!-- Sidebar -->
@php
    $links = [
        [
            'name' => 'Dashboard',
            'route' => route('recruiter.dashboard'),
            'url' => '/',
            'icon' => 'fas fa-home',
        ],
        [
            'name' => 'Jobs',
            'route' => route('recruiter.jobs'),
            'url' => 'jobs',
            'icon' => 'fa fa-briefcase',
        ],
        [
            'name' => 'Create Job',
            'route' => route('recruiter.jobs.create'),
            'url' => 'jobs/create',
            'icon' => 'fa fa-plus',
        ]
    ];
@endphp
<nav id="sidebar" class="px-3 py-3">
    <h3 class="text-center mb-4 text-white fw-bold">JobEntry</h3>
    <ul class="list-unstyled">
        @foreach ($links as $link)
            <li>
                <a href="{{ $link['route'] }}" class="nav-link d-flex align-items-center @if (Request::path() == $link['url']) active @endif">
                    <i class="{{ $link['icon'] }} mb-1"></i>{{ $link['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
