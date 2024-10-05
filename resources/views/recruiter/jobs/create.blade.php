@extends('components.recruiter.layouts.app')

@section('css')
@endsection
@section('content')
    <form action="#" class="card rounded rounded-md p-3">
        @php
            $fields = [
                'title' => [
                    'label' => 'Title',
                    'type' => 'text',
                    'placeholder' => 'Enter job title',
                    'required' => true,
                ],
                // [
                //     'details' => 
                // ],
            ];
        @endphp
        <div class="row g-4">
            <div class="col-lg-6">
                <div>
                    <label for="job-title-Input" class="form-label">Job Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="job-title-Input" placeholder="Enter job title" required />
                </div>
            </div>
        </div>
    </form>
@endsection
