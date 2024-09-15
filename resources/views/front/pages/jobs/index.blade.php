@extends('components.front.layouts.app')

@section('title')
    Find Jobs
@endsection
@section('content')
    {{-- @include('components.front.common.header', [
        'heading' => 'Job List',
    ]) --}}
    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        @include('components.front.filter_jobs')

        @include('components.front.job_list')
    </div>
    <!-- Jobs End -->
@endsection
