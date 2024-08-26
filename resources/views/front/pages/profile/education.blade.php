@extends("front.pages.profile.index")
@section("information")
    @php
        $rows = $educations->count();
    @endphp
    <div class="col-md-9">
        @foreach ($educations as $key => $education)
            @php
                $educationData = Arr::except($education->getAttributes(), ["user_id", "id"]);
            @endphp
            <div class="card shadow-sm rounded border-0">
                @php
                    $textViewId = "textView" . $key;
                    $editViewId = "editView" . $key;
                @endphp
                <x-front.profile.card_header id="editButton" heading="Personal Information" click="editInput('{{ $textViewId }}', '{{ $editViewId }}', 'editButton', '{{ $key }}')" />

                <div class="card-body">
                    <div class="row mb-4" id="{{ $textViewId }}">
                        @foreach ($educationData as $key => $data)
                            <x-inputs.text value="{{ $data }}" label="{{ $labels[$key] }}" />
                        @endforeach
                    </div>

                    <div class="row mb-4" id="{{ $editViewId }}" style="display: none">
                        @foreach ($educationData as $key => $data)
                            <x-inputs.edit id="{{ $key }}" name="{{ $key }}" type="{{ $types[$key] }}" value="{{ $data }}" label="{{ $labels[$key] }}" />
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
