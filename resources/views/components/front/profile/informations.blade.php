@php
    $rows = $informations->count();
@endphp
@if ($rows < 1)
    <x-front.add_button :module="$module ?? null" />
@else
    @foreach ($informations as $key => $information)
        @php
            $textViewId = 'textView' . $key;
            $editViewId = 'editView' . $key;
            $editButton = 'editButton' . $key;
            $informationData = Arr::except($information->getAttributes(), ['user_id', 'id', 'created_at', 'updated_at']);
        @endphp

        <div class="card shadow-sm rounded border-0"> {{-- academy section --}}
            <x-front.profile.card_header :id="$editButton" heading="Academic {{ $key + 1 }}" click="editInput('{{ $textViewId }}', '{{ $editViewId }}', '{{ $editButton }}', '{{ $key }}')" />
            <div class="card-body">
                <div class="row mb-4" id="{{ $textViewId }}"> {{-- show data --}}
                    @foreach ($informationData as $key1 => $data)
                        <x-text :value="$data" :label="$labels[$key1]" />
                    @endforeach
                </div>

                <form action="{{ route('user.profile.education.update') }}" class="row mb-4" id="{{ $editViewId }}" style="display: none"> {{-- edit data --}}
                    <input type="hidden" name="education_id" value="{{ $information->id }}">
                    @foreach ($informationData as $key2 => $data)
                        <x-edit :id="$key2" :name="$key2" :type="$types[$key2]" :value="$data" :label="$labels[$key2]" />
                    @endforeach
                    <x-save_close_buttons saveButtonClick="save(event, $(this), '{{ $callBackRoute }}')" closeButtonClick="editInput('{{ $textViewId }}', '{{ $editViewId }}', '{{ $editButton }}', '{{ $key }}', event)" />
                </form>
            </div>
        </div>
    @endforeach
    <x-front.add_button :module="$module ?? null" />
@endif
