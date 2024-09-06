{{-- @extends("front.pages.profile.index")
@section("information") --}}
    @php
        $rows = $educations->count();
        $fields = ["degree", "exam", "institute", "passing_year", "group", "cgpa", "scale"];
        $component = view('components.inputs.edit', [
            'id' => 1,
            'name' => 'fatherName',
            'type' => 'text',
            'value' => null,
            'label' => 'Father Name',
            'options' => []
        ])->render();
    @endphp
    @if ($rows < 1)
        <div class="card shadow-sm rounded border-0" id="acaddemicContainer"> {{-- academy section --}}
            <x-front.no_data_alert module="education" />
        </div>
        <x-front.add_button id="addEducation" module="Education" />
    @else
        @foreach ($educations as $key => $education)
            {{-- ids for each academy section --}}
            @php
                $textViewId = "textView" . $key;
                $editViewId = "editView" . $key;
                $educationData = Arr::except($education->getAttributes(), ["user_id", "id", "created_at", "updated_at"]);
            @endphp

            <div class="card shadow-sm rounded border-0" id="acaddemicContainer"> {{-- academy section --}}
                <x-front.profile.card_header id="editButton" heading="Personal Information" click="editInput('{{ $textViewId }}', '{{ $editViewId }}', 'editButton', '{{ $key }}')" />

                <div class="card-body">
                    <div class="row mb-4" id="{{ $textViewId }}"> {{-- show data --}}
                        @foreach ($educationData as $key => $data)
                            <x-inputs.text :value="$data" :label="$labels[$key]" />
                        @endforeach
                    </div>

                    {{-- ------------------------------------------------------------------------------- --}}

                    <div class="row mb-4" id="{{ $editViewId }}" style="display: none"> {{-- edit data --}}
                        @foreach ($educationData as $key => $data)
                            <x-inputs.edit :id="$key" :name="$key" :type="$types[$key]" :value="$data" :label="$labels[$key]" />
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @endif
{{-- @endsection --}}
