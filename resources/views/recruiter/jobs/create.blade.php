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

        .quill-invalid .ql-editor {
            border: 1px solid red;
        }
    </style>
@endsection
@section('content')
    <form id="jobCreateForm" action="{{ route('recruiter.jobs.store') }}" method="POST" enctype="multipart/form-data" class="card rounded rounded-md p-3 needs-validation" novalidate>
        @csrf
        <div class="row g-2">
            <!-- Job Title -->
            <div class="col-lg-12 mt-lg-4">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="Enter job title" required>
                @error('title')
                    <span class="text-danger errors">{{ $message }}</span>
                @enderror
            </div>

            <!-- Salary -->
            <div class="col-lg-4 mt-lg-4">
                <label class="form-label">Salary <span class="text-danger">*</span></label>
                <input id="salary" name="salary" type="number" class="form-control" placeholder="Enter salary" min="0" value="{{ old('salary') }}" required>
                @error('salary')
                    <span class="text-danger errors">{{ $message }}</span>
                @enderror
            </div>

            <!-- Vacancy -->
            <div class="col-lg-4 mt-lg-4">
                <label class="form-label">Vacancy <span class="text-danger">*</span></label>
                <input id="vacancy" name="vacancy" type="number" class="form-control" placeholder="Enter vacancy" min="0" value="{{ old('vacancy') }}" required>
                @error('vacancy')
                    <span class="text-danger errors">{{ $message }}</span>
                @enderror
            </div>

            <!-- Work Experience -->
            <div class="col-lg-4 mt-lg-4">
                <label class="form-label">Work Experience <span class="text-danger">*</span></label>
                <input id="work_experience" name="work_experience" type="number" class="form-control" placeholder="Enter experience in years" value="{{ old('work_experience') }}" required min="0">
                @error('work_experience')
                    <span class="text-danger errors">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deadline -->
            <div class="col-lg-4 mt-lg-4">
                <label class="form-label">Deadline <span class="text-danger">*</span></label>
                <input id="deadline" name="deadline" type="date" class="form-control" placeholder="Select deadline" value="{{ old('deadline') }}" required>
                @error('deadline')
                    <span class="text-danger errors">{{ $message }}</span>
                @enderror
            </div>

            <!-- Location -->
            <div class="col-lg-4 mt-lg-4">
                <label class="form-label">Location <span class="text-danger">*</span></label>
                <select id="location" name="location" class="form-select" required>
                    <option value="">Select location</option>
                    @foreach ($locations as $location)
                        <option @if ($location->id == old('location')) selected @endif value="{{ $location->id }}">{{ $location->location_name_en }}</option>
                    @endforeach
                </select>
                @error('location')
                    <span class="text-danger errors">{{ $message }}</span>
                @enderror
            </div>

            <!-- Work Status -->
            <div class="col-lg-4 mt-lg-4">
                <label class="form-label">Work Status <span class="text-danger">*</span></label>
                <select id="work_status" name="work_status" class="form-select" required>
                    <option value="" disabled selected>Select work status</option>
                    <option @if (old('work_status') == 'Full Time') selected @endif value="Full Time">Full Time</option>
                    <option @if (old('work_status') == 'Part Time') selected @endif value="Part Time">Part Time</option>
                </select>
                @error('work_status')
                    <span class="text-danger errors">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category -->
            <div class="col-lg-4 mt-lg-4">
                <label class="form-label">Category <span class="text-danger">*</span></label>
                <select id="category" name="category" class="form-select" required>
                    <option value="" disabled selected>Select category</option>
                    @foreach ($categories as $category)
                        <option @if (old('category') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <span class="text-danger errors">{{ $message }}</span>
                @enderror
            </div>

            <!-- Working Hours -->
            <div class="col-lg-4 mt-lg-4">
                <label class="form-label">Working Hours <span class="text-danger">*</span></label>
                <div class="d-flex gap-2 align-items-center">
                    <label>Start:</label>
                    <input name="working_hours[start]" class="form-control time" type="time" value="" required>
                    <label>End:</label>
                    <input name="working_hours[end]" class="form-control time" type="time" value="" required>
                </div>
                @error('working_hours.*')
                    <span class="text-danger errors">{{ $message }}</span>
                @enderror
            </div>

            <div class="row g-2 mb-3">
                <h4 class="text-black">Requirements</h4>

                <!-- Education Requirement -->
                <div class="col-lg-4 requirementSection">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label">Education <span class="text-danger">*</span></label>
                        <button type="button" class="btn btn-sm btn-primary addRequirementButton"><i class="fa fa-plus"></i></button>
                    </div>
                    @if (old('education_requirement') != null)
                        @php
                            $old_education_requirements = old('education_requirement');
                        @endphp
                        @foreach ($old_education_requirements as $old_education_requirement)
                            <input class="form-control mb-2" name="education_requirement[]" type="text" placeholder="Educational Qualification" value="{{ $old_education_requirement }}" required />
                        @endforeach
                    @else
                        <input class="form-control" name="education_requirement[]" type="text" placeholder="Educational Qualification" required />
                    @endif
                    @error('education_requirement.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Work Experience Requirement -->
                <div class="col-lg-4 requirementSection">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label">Work Experience</label>
                        <button type="button" class="btn btn-sm btn-primary addRequirementButton"><i class="fa fa-plus"></i></button>
                    </div>
                    @if (old('experience_requirement') != null)
                        @php
                            $old_experience_requirements = old('experience_requirement');
                        @endphp
                        @foreach ($old_experience_requirements as $old_experience_requirement)
                            <input class="form-control mb-2" name="experience_requirement[]" type="text" placeholder="Work Experience" value="{{ $old_experience_requirement }}" />
                        @endforeach
                    @else
                        <input class="form-control" name="experience_requirement[]" type="text" placeholder="Work Experience" />
                    @endif
                    @error('experience_requirement.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Additional Requirement -->
                <div class="col-lg-4 requirementSection">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label">Additional</label>
                        <button type="button" class="btn btn-sm btn-primary addRequirementButton"><i class="fa fa-plus"></i></button>
                    </div>
                    @if (old('additional_requirement') != null)
                        @php
                            $old_additional_requirements = old('additional_requirement');
                        @endphp
                        @foreach ($old_additional_requirements as $old_additional_requirement)
                            <input class="form-control mb-2" name="additional_requirement[]" type="text " placeholder="Additional Requirement" value="{{ $old_additional_requirement }}" />
                        @endforeach
                    @else
                        <input class="form-control" name="additional_requirement[]" type="text" placeholder="Additional Requirements" />
                    @endif
                    @error('additional_requirement.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Responsibilities & Job Details -->
            <div class="col-lg-12 mt-lg-4" id="detailsEditor">
                <label class="form-label">Responsibilities & Job Details<span class="text-danger">*</span></label>
                <div class="editor" id="details"></div>
                @error('details')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <textarea name="details" id="detailsInput" class="d-none"></textarea>

            <!-- Other Benefits -->
            <div class="col-lg-12 mt-lg-4">
                <label class="form-label">Other Benefits</label>
                <div class="editor" id="other_benefits"></div>
                @error('other_benefits')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <textarea name="other_benefits" id="other_benefits_input" class="d-none"></textarea>
        </div>

        <div class="mt-3">
            <input id="submitButton" type="submit" value="Create" class="btn btn-primary">
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>


    @if ($errors->any())
        @dump($errors);
        <script>
            notification({
                icon: "error",
                text: "Validation Failed!"
            });
        </script>
    @endif
    <script>
        const addRequirementButton = $('.addRequirementButton');
        const form = $('#jobCreateForm');
        const detailsInput = $('#detailsInput');
        const othreBenefitsInput = $('#other_benefits_input');

        // quill editor
        const editorContainer = document.querySelector('#detailsEditor');

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

            form.submit(function(e) {
                // Check if Quill editor is empty
                if (details.getText().trim().length === 0) {
                    event.preventDefault(); // Prevent form submission
                    editorContainer.classList.add('quill-invalid');
                    notification({
                        icon: "warning",
                        text: 'Fill in all required fields.'
                    });
                    return;
                }
                detailsInput.val(details.root.innerHTML)
                othreBenefitsInput.val(otherBenefits.root.innerHTML)
            })
        });

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()

                            notification({
                                icon: "warning",
                                text: 'Fill in all required fields.'
                            });
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
