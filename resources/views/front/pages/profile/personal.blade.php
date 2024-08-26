@extends("front.pages.profile.index")
@section("information")
    <div class="col-md-9">
        <div class="card shadow-sm rounded border-0">
            <x-front.profile.card_header id="editButton" heading="Personal Information" click="editInput('textView', 'editView', 'editButton')" />

            @include('components.labels')
            @php
                $userData = Arr::except($user->getAttributes(), ["password", "id"]);
                $personalInfo = Arr::except($user->personalInfo->getAttributes(), ["user_id", "image", "id"]);
            @endphp
            <div class="card-body">
                <div class="row mb-4" id="textView">
                    @foreach ($userData as $key => $data)
                        <x-inputs.text value="{{ $data }}" label="{{ $labels[$key] }}" />
                    @endforeach
                    @foreach ($personalInfo as $key => $data)
                        <x-inputs.text value="{{ $data }}" label="{{ $labels[$key] }}" />
                    @endforeach
                </div>

                <div class="row mb-4" id="editView" style="display: none">
                    @foreach ($userData as $key => $data)
                        <x-inputs.edit id="{{ $key }}" name="{{ $key }}" type="{{ $types[$key] }}" value="{{ $data }}" label="{{ $labels[$key] }}" />
                    @endforeach
                    @foreach ($personalInfo as $key => $data)
                        <x-inputs.edit id="{{ $key }}" name="{{ $key }}" type="{{ $types[$key] }}" value="{{ $data }}" label="{{ $labels[$key] }}" />
                    @endforeach
                    {{-- <x-inputs.edit label="First Name" /> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        let shouldEdit = false;

        function editInput(text, edit, id) {

            shouldEdit = !shouldEdit;
            let textView = $(`#${text}`);
            let editView = $(`#${edit}`);

            let editButton = $(`#${id}`).find('span')

            if (shouldEdit) {
                textView.css('display', 'none');
                editView.css('display', '');
                editButton.text('Save');
            } else {
                textView.css('display', '');
                editView.css('display', 'none');
                editButton.text('Edit');
            }
        }
    </script>
@endsection
