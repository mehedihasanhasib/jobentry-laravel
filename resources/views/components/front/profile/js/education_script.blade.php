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
    $addButton = view('components.front.add_button', ['module' => 'Education'])->render();
@endphp

<script>
    const fields = @json($components).join('');
    const educationRoute = "{{ route('user.profile.education') }}";

    const view1 = `<div class="card shadow-sm rounded border-0" id="addEducationForm">
                        <div class="card-body">
                            <form action="{{ route('user.profile.education.update') }}" class="row mb-4">
                                ${fields}
                                <x-save_close_buttons saveId="educationSaveButton" click="educationClose(event, '${educationRoute}')" />
                            </form>
                        </div>
                    </div>`
    const view2 = @json($addButton);

    informationSection.on('click', '#addInformation', function(e) {
        informationSection.html('');
        informationSection.html(view1)
    });

    function educationClose(event, url) {
        event.preventDefault();
        spinner.toggleClass('show')
        appendHTML(url);
    };

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
