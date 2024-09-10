@php
    $rows = $educations->count();
    // $fields = ['degree', 'exam', 'institute', 'passing_year', 'group', 'cgpa', 'scale'];
@endphp
@if ($rows < 1)
    <div class="card shadow-sm rounded border-0 d-flex align-items-center"> {{-- academy section --}}
        <x-front.no_data_alert class="mt-2" module="education" />
        <x-front.add_button class="mb-2" id="addEducation" module="Education" />
    </div>
@else
    @foreach ($educations as $key => $education)
        @php
            $textViewId = 'textView' . $key;
            $editViewId = 'editView' . $key;
            $educationData = Arr::except($education->getAttributes(), ['user_id', 'id', 'created_at', 'updated_at']);
        @endphp

        <div class="card shadow-sm rounded border-0"> {{-- academy section --}}
            <x-front.profile.card_header id="editButton" heading="Academic {{ $key + 1 }}" click="editInput('{{ $textViewId }}', '{{ $editViewId }}', 'editButton', '{{ $key }}')" />

            <div class="card-body">
                <div class="row mb-4" id="{{ $textViewId }}"> {{-- show data --}}
                    @foreach ($educationData as $key => $data)
                        <x-text :value="$data" :label="$labels[$key]" />
                    @endforeach
                    <x-front.add_button id="addEducation" module="Education" />
                </div>

                <div class="row mb-4" id="{{ $editViewId }}" style="display: none"> {{-- edit data --}}
                    @foreach ($educationData as $key => $data)
                        <x-edit :id="$key" :name="$key" :type="$types[$key]" :value="$data" :label="$labels[$key]" />
                    @endforeach

                    <x-save_close_buttons closeId="educationUpdateCloseButton" saveId="educationUpdateSaveButton" />
                </div>
            </div>
        </div>
    @endforeach
@endif
