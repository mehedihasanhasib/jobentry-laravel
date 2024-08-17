<!-- Header End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">{{ $heading }}</h1>
        {{-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                @foreach ($links as $link)
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" @class(['text-white', 'active' => Route::is($route)])>{{ $link }}</a>
                    </li>
                    @endforeach
                    <li class="breadcrumb-item text-white active" aria-current="page">Jobs</li>
                </ol>
        </nav> --}}
    </div>
</div>
<!-- Header End -->
