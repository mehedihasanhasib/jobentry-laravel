@extends('components.recruiter.layouts.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        .text-gray {
            color: #6c757d;
        }

        .editor {
            height: 30vh;
            overflow-y: auto;
        }

        .time {
            display: block
        }
    </style>
@endsection
@section('content')
    <form id="createJobForm" action="{{ route('recruiter.jobs.store') }}" method="POST" enctype="multipart/form-data" class="card rounded rounded-md p-3">
        @php
            $fields = [
                'title' => [
                    'name' => 'title',
                    'label' => 'Title',
                    'type' => 'text',
                    'placeholder' => 'Enter job title',
                    'required' => true,
                    'col' => 12,
                ],
                'salary' => [
                    'name' => 'salary',
                    'label' => 'Salary',
                    'type' => 'number',
                    'placeholder' => 'Enter salary',
                    'required' => true,
                    'col' => 4,
                ],
                'vacancy' => [
                    'name' => 'vacancy',
                    'label' => 'Vacancy',
                    'type' => 'number',
                    'placeholder' => 'Enter vacancy',
                    'required' => true,
                    'col' => 4,
                ],
                'work_experience' => [
                    'name' => 'work_experience',
                    'label' => 'Work Experience',
                    'type' => 'number',
                    'placeholder' => 'Enter experience in years',
                    'required' => true,
                    'col' => 4,
                ],
                'deadline' => [
                    'name' => 'deadline',
                    'label' => 'Deadline',
                    'type' => 'date',
                    'placeholder' => 'Select deadline',
                    'required' => true,
                    'col' => 4,
                ],
                'location' => [
                    'name' => 'location',
                    'label' => 'Location',
                    'type' => 'select',
                    'placeholder' => 'Select location',
                    'required' => true,
                    'col' => 4,
                ],
                'work_status' => [
                    'name' => 'work_status',
                    'label' => 'Work Status',
                    'type' => 'select',
                    'placeholder' => 'Select work status',
                    'required' => true,
                    'col' => 4,
                ],
                'category' => [
                    'name' => 'category',
                    'label' => 'Category',
                    'type' => 'select',
                    'placeholder' => 'Select category',
                    'required' => true,
                    'col' => 4,
                ],
                'working_days' => [
                    'name' => 'working_days[]',
                    'label' => 'Working Days',
                    'type' => 'select',
                    'placeholder' => 'Select working days',
                    'required' => true,
                    'col' => 4,
                ],
                'working_hours' => [
                    'name' => 'working_hours',
                    'label' => 'Working Hours',
                    'type' => 'select',
                    'placeholder' => 'Select working hours',
                    'required' => true,
                    'col' => 4,
                ],
                'requirements' => [
                    'education' => [
                        'title' => 'Education',
                        'name' => 'education[]',
                        'placeholder' => 'Educational Qualification',
                        'required' => true,
                    ],
                    'experience' => [
                        'title' => 'Work Experience',
                        'name' => 'experience[]',
                        'placeholder' => 'Work Experience',
                        'required' => false,
                    ],
                    'additional' => [
                        'title' => 'Additional',
                        'name' => 'additional[]',
                        'placeholder' => 'Additional Requirements',
                        'required' => false,
                    ],
                ],
                'details' => [
                    'name' => 'details',
                    'label' => 'Responsibilities & Job Details',
                    'type' => 'textarea',
                    'placeholder' => 'Enter job details',
                    'required' => true,
                    'col' => 12,
                ],
                'other_benefits' => [
                    'name' => 'other_benefits',
                    'label' => 'Other Benefits',
                    'type' => 'textarea',
                    'placeholder' => 'Enter other benefits',
                    'required' => false,
                    'col' => 12,
                ],
            ];
        @endphp
        <div class="row g-2">
            <!--fields starts-->
            @foreach ($fields as $key => $field)
                @if ($key == 'requirements')
                    <div class="row g-2 mb-3">
                        <h4 class="text-black">Requirements</h4>
                        @foreach ($field as $key => $requirement)
                            <div class="col-lg-4 requirementSection">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label">{{ $requirement['title'] }} @if ($requirement['required'])
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    <button type="button" class="btn btn-sm btn-primary addRequirementButton"><i class="fa fa-plus"></i></button>
                                </div>
                                <input class="form-control" id="{{ $key }}" type="text" name="{{ $requirement['name'] }}" placeholder="{{ $requirement['placeholder'] }}" @required($requirement['required']) />
                                <span class="{{ $key }} text-danger errors"></span>
                            </div>
                        @endforeach
                    </div>
                @elseif ($key == 'working_hours')
                    <div class="col-lg-{{ $field['col'] }} mt-lg-4">
                        <label class="form-label">{{ $field['label'] }}@if ($field['required'])
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <div class="d-flex gap-2 align-items-center">
                            <label>From:</label>
                            <input name="working_hour_from" class="form-control time" type="time" placeholder="{{ $field['placeholder'] }}" @required($field['required'])>
                            <label>To:</label>
                            <input name="working_hour_to" class="form-control time" type="time" placeholder="{{ $field['placeholder'] }}" @required($field['required'])>
                        </div>
                    </div>
                @else
                    <div class="col-lg-{{ $field['col'] }} mt-lg-4">
                        <div>
                            <label class="form-label">{{ $field['label'] }}@if ($field['required'])
                                    <span class="text-danger">*</span>
                                @endif
                            </label>
                            @if ($field['type'] == 'textarea')
                                <div class="editor" id="{{ $key }}"></div>
                            @elseif($field['type'] == 'select')
                                <select class="form-select" name="{{ $field['name'] }}" @if ($key == 'working_days') multiple @endif>
                                    <option value="" disabled @if ($key != 'working_days') selected @endif>{{ $field['placeholder'] }}</option>
                                    @if ($key == 'work_status')
                                        <option value="{{ base64_encode('Full Time') }}">Full Time</option>
                                        <option value="{{ base64_encode('Full Time') }}">Part Time</option>
                                    @elseif($key == 'category')
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    @elseif($key == 'location')
                                        
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->location_name_en }}</option>
                                        @endforeach
                                    @elseif($key == 'working_days')
                                        @php
                                            $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                                        @endphp
                                        @foreach ($days as $day)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @elseif($field['type'] == 'number')
                                <input id="{{ $key }}" name="{{ $field['name'] }}" type="{{ $field['type'] }}" class="form-control" placeholder="{{ $field['placeholder'] }}" @required($field['required']) min="0" />
                            @else
                                <input id="{{ $key }}" name="{{ $field['name'] }}" type="{{ $field['type'] }}" class="form-control" placeholder="{{ $field['placeholder'] }}" @required($field['required']) />
                            @endif
                        </div>
                        <span class="{{ $key }} text-danger errors"></span>
                    </div>
                @endif
            @endforeach
            <!--fields ends-->
        </div>
        <div class="mt-3">
            <input type="submit" value="Create" class="btn btn-primary"></input>
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script>
        const addRequirementButton = $('.addRequirementButton');
        $(document).ready(function() {

            // add requirements
            $(addRequirementButton).click(function(e) {
                e.preventDefault();
                console.log("clicked")
                var $originalInput = $(this).closest('.requirementSection').find('input');
                const div = $(this).closest('.col-lg-4');
                const textInput = `<div class="d-flex justify-content-between align-items-center mt-2 gap-1 position-relative">
                                    <input type="text" class="form-control" name="${$originalInput.attr('name')}" placeholder="${$originalInput.attr('placeholder')}" />
                                    <button type="button" class="btn btn-sm btn-danger position-absolute end-0 me-1 removeRequirementButton">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>`
                $(div).append(textInput);
            });

            // remove requirements
            $(document).on('click', '.removeRequirementButton', function(e) {
                e.preventDefault();
                $(this).closest('div').remove();
            });

            // quil editor
            const details = new Quill('#details', {
                theme: 'snow',
                placeholder: 'Write Responsibilities & Job Details. (Write in bullet point for best results)',
            });
            const otherBenefits = new Quill('#other_benefits', {
                theme: 'snow',
                placeholder: 'Write other benefits. (Write in bullet point for best results)',
            });

            // submit form
            $('#createJobForm').submit(function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                const url = $(this).attr('action');

                formData.append('details', details.root.innerHTML);
                formData.append('other_benefits', otherBenefits.root.innerHTML);

                console.log(details.root.innerHTML)

                function successCallback(response) {
                    console.log(response);
                }
                submitForm({
                    type: "post",
                    url,
                    formData,
                    successCallback
                })
            });
        });
    </script>
@endsection
