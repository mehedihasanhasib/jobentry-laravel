@php
    $fields = ['degree', 'exam', 'institute', 'passing_year', 'group', 'cgpa', 'scale'];
    $components = [];
    foreach ($fields as $key => $field) {
        $component = view('components.edit', [
            'id' => $field,
            'name' => $field,
            'type' => $types[$field],
            'value' => null,
            'label' => $labels[$field],
            'options' => [],
        ])->render();
        $components[] = $component;
    }
@endphp

<script>
    const view = @json($components).join('');
    const view1 = `<div class="card shadow-sm rounded border-0">
                        <div class="card-body">
                            <form action="{{ route('user.profile.education.update') }}" class="row mb-4">
                                ${view}
                                <x-save_close_buttons closeId="educationCloseButton" saveId="educationSaveButton" />
                            </form>
                        </div>
                    </div>`
    const view2 = `<div class="card shadow-sm rounded border-0 d-flex align-items-center">
                    <x-front.no_data_alert module="education" class="mt-2" />
                    <x-front.add_button id="addEducation" module="Education" class="mb-2" />
                   </div>`;

    informationSection.on('click', '#addEducation', function(e) {
        informationSection.html('');
        informationSection.html(view1)
    });

    informationSection.on('click', '#educationCloseButton', function(e) {
        e.preventDefault();
        informationSection.html('');
        informationSection.html(view2);
    });

    informationSection.on('click', '#educationSaveButton', function(e) {
        e.preventDefault();
        const form = $(this).closest('form')[0];
        const formData = new FormData(form);
        const url = $(form).attr('action');

        function successCallback() {
            appendHTML("{{ route('user.profile.education') }}");
        }
        submitForm({
            type: "post",
            url,
            formData,
            successCallback
        })
    })
</script>
