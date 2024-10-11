@extends('components.recruiter.layouts.app')

@section('css')
    <style>
        .text-gray {
            color: #6c757d;
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
                'details' => [
                    'name' => 'details',
                    'label' => 'Job Details',
                    'type' => 'textarea',
                    'placeholder' => 'Enter job details',
                    'required' => true,
                ],
            ];
        @endphp
        <div class="row g-2">
            @foreach ($fields as $key => $field)
                <div class="col-lg-6">
                    <div>
                        <label class="form-label">{{ $field['label'] }}
                            @if ($field['required'])
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        @if ($field['type'] == 'textarea')
                            <textarea name="{{ $field['name'] }}" class="form-control" placeholder="{{ $field['placeholder'] }}" @required($field['required'])></textarea>
                        @else
                            <input id="{{ $key }}" name="{{ $field['name'] }}" type="{{ $field['type'] }}" class="form-control" placeholder="{{ $field['placeholder'] }}" @required($field['required']) />
                        @endif
                    </div>
                    <span class="{{ $key }} text-danger errors"></span>
                </div>
            @endforeach
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
        </div>
    </form>
@endsection

@section('script')
    <script>
        const addRequirementButton = $('.addRequirementButton');

        $(addRequirementButton).click(function(e) {
            e.preventDefault();
            const div = $(this).closest('.col-lg-4');
            const textInput = `<div class="d-flex justify-content-between align-items-center mt-2 gap-1 position-relative">
                                    <input type="text" class="form-control" name="" placeholder="" />
                                    <button type="button" class="btn btn-sm btn-danger position-absolute end-0 me-1 removeRequirementButton">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>`
            $(div).append(textInput);
        });

        $(document).on('click', '.removeRequirementButton', function(e) {
            e.preventDefault();
            $(this).closest('div').fadeOut(function() {
                $(this).remove();
            });
        });
    </script>
@endsection
