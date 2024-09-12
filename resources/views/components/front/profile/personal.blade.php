@if ($user)
    @php
        $rows = $user->count();
    @endphp
    <div class="card shadow-sm rounded border-0">
        <x-front.profile.card_header id="editButton" heading="Personal Information" click="editInput('textView', 'editView', 'editButton')" />

        @php
            $userData = Arr::only($user->getAttributes(), ['name', 'email']);
            $personalInfo = Arr::except($user->personalInfo->getAttributes(), ['user_id', 'image', 'id', 'created_at', 'updated_at']);
        @endphp
        <div class="card-body">
            <div class="row mb-4" id="textView">
                @foreach ($userData as $key => $data)
                    <x-text :value="$data" :label="$labels[$key]" />
                @endforeach
                @foreach ($personalInfo as $key => $data)
                    <x-text :value="$data" :label="$labels[$key]" />
                @endforeach
            </div>

            <form class="row mb-4" id="editView" style="display: none" action="{{ route('user.profile.personal.update') }}" method="POST">
                @foreach ($userData as $key => $data)
                    <x-edit :id="$key" :name="$key" :type="$types[$key]" :value="$data" :label="$labels[$key]" />
                @endforeach
                @foreach ($personalInfo as $key => $data)
                    <x-edit :id="$key" :name="$key" :type="$types[$key]" :value="$data" :label="$labels[$key]" :options="$genders" />
                @endforeach
                {{-- <x-save_close_buttons closeId="personalCloseButton" saveId="personalSaveButton" /> --}}
                <x-save_close_buttons saveButtonClick="save(event, $(this), '{{ route('user.profile.personal') }}')" closeButtonClick="editInput('textView', 'editView', 'editButton', 0, event)" />
            </form>
        </div>
    </div>
@else
    @php
        $rows = 0;
    @endphp
    <x-front.no_data_alert module="personal" />
@endif
