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
                // 'details' => [
                //     'name' => 'details',
                //     'label' => 'Job Details',
                //     'type' => 'textarea',
                //     'placeholder' => 'Enter job details',
                //     'required' => true,
                // ],
                'requirements' => [
                    'name' => 'requirements[]',
                    'label' => 'Job Requirements',
                    'type' => 'text',
                    'placeholder' => 'Enter job requirement',
                    'required' => true,
                ],
            ];
        @endphp
        <div class="row g-4">
            @foreach ($fields as $key => $field)
                <div class="col-lg-6">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label">{{ $field['label'] }}
                                @if ($field['required'])
                                    <span class="text-danger">*</span>
                                @endif
                            </label>
                            @if ($key == 'requirements')
                                <span>
                                    <button id="addRequirement" type="button" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus text-white"></i>
                                    </button>
                                </span>
                            @endif
                        </div>

                        <div>
                            @if ($field['type'] == 'text')
                                <input id="{{ $key }}" name="{{ $field['name'] }}" type="{{ $field['type'] }}" class="form-control" placeholder="{{ $field['placeholder'] }}" @required($field['required']) />
                            @elseif ($field['type'] == 'textarea')
                                <textarea name="{{ $field['name'] }}" class="form-control" placeholder="{{ $field['placeholder'] }}" @required($field['required'])></textarea>
                            @endif
                        </div>
                    </div>
                    <span class="{{ $key }} text-danger errors"></span>
                </div>
            @endforeach
        </div>
    </form>
@endsection

@section('script')
    <script>
        const addRequirementButton = $('#addRequirement');

        $(addRequirementButton).click(function(e) {
            e.preventDefault();

            // Find the input field and its parent div
            const textInput = $('#requirements'); // Assuming 'requirements' is the id of the input field
            const div = textInput.closest('div');

            // Clone the input field and clear its value (if needed)
            const clonedInput = textInput.clone().val('');
            $(clonedInput).addClass('mt-2');
            // Append the cloned input to the div
            $(div).append(clonedInput);
        });
    </script>
@endsection
