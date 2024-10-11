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
    </style>
@endsection
@section('content')
    <form action="#" class="card rounded rounded-md p-3">
        @php
            $fields = [
                'title' => [
                    'name' => 'title',
                    'label' => 'Title',
                    'type' => 'text',
                    'placeholder' => 'Enter job title',
                    'required' => true,
                ],
                'salary' => [
                    'name' => 'salary',
                    'label' => 'Salary',
                    'type' => 'text',
                    'placeholder' => 'Enter salary',
                    'required' => true,
                ],
                'vacancy' => [
                    'name' => 'vacancy',
                    'label' => 'Vacancy',
                    'type' => 'number',
                    'placeholder' => 'Enter vacancy',
                    'required' => true,
                ],
                'deadline' => [
                    'name' => 'deadline',
                    'label' => 'Deadline',
                    'type' => 'date',
                    'placeholder' => 'Select deadline',
                    'required' => true,
                ],
                'location' => [
                    'name' => 'location',
                    'label' => 'Location',
                    'type' => 'select',
                    'placeholder' => 'Select location',
                    'required' => true,
                ],
                'work_status' => [
                    'name' => 'work_status',
                    'label' => 'Work Status',
                    'type' => 'select',
                    'placeholder' => 'Select work status',
                    'required' => true,
                ],
                'details' => [
                    'name' => 'details',
                    'label' => 'Job Details',
                    'type' => 'textarea',
                    'placeholder' => 'Enter job details',
                    'required' => true,
                ],
                'other_benefits' => [
                    'name' => 'other_benefits',
                    'label' => 'Other Benefits',
                    'type' => 'textarea',
                    'placeholder' => 'Enter other benefits',
                    'required' => false,
                ]
            ];
        @endphp
        <div class="row g-2">
            <!--fields starts-->
            @foreach ($fields as $key => $field)
                <div class="col-lg-{{ $field['type'] == 'textarea' ? '12' : '6' }}">
                    <div>
                        <label class="form-label">{{ $field['label'] }}@if ($field['required'])
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        @if ($field['type'] == 'textarea')
                            <div class="editor" id="{{ $key }}"></div>
                            {{-- <textarea name="{{ $field['name'] }}" class="form-control" placeholder="{{ $field['placeholder'] }}" rows="6" @required($field['required'])></textarea> --}}
                        @elseif($field['type'] == 'select')
                            <select class="form-select" name="{{ $field['name'] }}">
                                <option value="" disabled selected>{{ $field['placeholder'] }}</option>
                                @if ($key == 'work_status')
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                @endif
                            </select>
                        @else
                            <input id="{{ $key }}" name="{{ $field['name'] }}" type="{{ $field['type'] }}" class="form-control" placeholder="{{ $field['placeholder'] }}" @required($field['required']) />
                        @endif
                    </div>
                    <span class="{{ $key }} text-danger errors"></span>
                </div>
            @endforeach
            <!--fields ends-->

            <!--requirement starts-->
            <div class="row g-2">
                <h4 class="text-black">Requirements</h4>
                @php
                    $requirements = [
                        'education' => [
                            'title' => 'Education',
                            'name' => 'education[]',
                            'placeholder' => 'Educational Qualification',
                            'required' => true,
                        ],
                        'experience' => [
                            'title' => 'Experience',
                            'name' => 'experience[]',
                            'placeholder' => 'Work Experience',
                            'required' => true,
                        ],
                        'additional' => [
                            'title' => 'Additional',
                            'name' => 'additional[]',
                            'placeholder' => 'Additional Requirements',
                            'required' => false,
                        ],
                    ];
                @endphp
                @foreach ($requirements as $key => $requirement)
                    <div class="col-lg-4 requirementSection">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label">{{ $requirement['title'] }} @if ($requirement['required'])
                                    <span class="text-danger">*</span>
                                @endif
                            </label>
                            <button type="button" class="btn btn-sm btn-primary addRequirementButton"><i class="fa fa-plus"></i></button>
                        </div>
                        <input class="form-control" id="{{ $key }}" type="text" name="{{ $requirement['name'] }}" placeholder="{{ $requirement['placeholder'] }}" @required($requirement['required']) />
                    </div>
                @endforeach
            </div>
            <!--requirement starts-->
        </div>
        <div class="mt-3">
            <input type="submit" class="btn btn-primary"></input>
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        const addRequirementButton = $('.addRequirementButton');

        // add requirements
        $(addRequirementButton).click(function(e) {
            e.preventDefault();
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

        // fetching location
        $.ajax({
            url: "https://bdapis.com/api/v1.2/districts",
            success: function(response) {
                if (response.status.code === 200) {
                    const locations = response.data;
                    locations.forEach(location => {
                        // create option and append the option to a select named "location"
                        const option = `<option value="${location.district}">${location.district}</option>`
                        $('select[name="location"]').append(option);
                    });
                }
            }
        });

        // quil editor
        const details = new Quill('#details', {
            theme: 'snow',
            placeholder: 'Write Responsibilities & Job Details',
        });
        const otherBenefits = new Quill('#other_benefits', {
            theme: 'snow',
            placeholder: 'Write Responsibilities & Job Details',
        });

        // submit form
    </script>
@endsection
