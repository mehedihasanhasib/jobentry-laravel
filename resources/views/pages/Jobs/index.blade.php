@extends('components.layouts.app')

@section('title')
    Find Jobs
@endsection
@section('content')
    @include('components.common.header', [
        'heading' => 'Job List',
        'links' => ['Home', 'Jobs'],
        'route' => 'jobs'
    ])
    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        @include('components.filter_jobs')

        @include('components.job_list')
    </div>
    <!-- Jobs End -->
@endsection
