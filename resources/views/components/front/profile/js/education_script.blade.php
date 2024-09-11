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
    $addButton = view('components.front.add_button', ['id' => 'addEducation', 'module' => 'Education'])->render();
@endphp

<script>
    const fields = @json($components).join('');
    const view1 = `<div class="card shadow-sm rounded border-0" id="addEducationForm">
                        <div class="card-body">
                            <form action="{{ route('user.profile.education.update') }}" class="row mb-4">
                                ${fields}
                                <x-save_close_buttons closeId="educationCloseButton" saveId="educationSaveButton" />
                            </form>
                        </div>
                    </div>`
    const view2 = @json($addButton);

    informationSection.on('click', '#addEducation', function(e) {
        informationSection.html('');
        informationSection.html(view1)
    });

    informationSection.on('click', '#educationCloseButton', function(e) {
        e.preventDefault();
        // informationSection.html('');
        // informationSection.html(view2);
        appendHTML("{{ route('user.profile.education') }}");
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
