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
    $routes = [
        'personal' => route('user.profile.personal'),
        'education' => route('user.profile.education'),
        'training' => route('user.profile.training'),
    ];
@endphp

<script>
    const fields = @json($components).join('');
    const routes = @json($routes);

    function view1(moduleRoute) {
        return `<div class="card shadow-sm rounded border-0" id="addEducationForm">
                    <div class="card-body">
                        <form action="{{ route('user.profile.education.update') }}" class="row mb-4">
                            ${fields}
                            <x-save_close_buttons saveButtonClick="save(event, $(this), '${moduleRoute}')" closeButtonClick="close(event, '${moduleRoute}')" />
                        </form>
                    </div>
                </div>`
    }

    informationSection.on('click', '#addInformation', function(e) {
        informationSection.html('');
        informationSection.html(view1(moduleRoute))
    });

    function close(event, url) {
        event.preventDefault();
        spinner.toggleClass('show')
        appendHTML(url);
    };
    
    function save(event, button, callBackRoute){
        event.preventDefault();
        const form = button.closest('form')[0];
        const formData = new FormData(form);
        const url = $(form).attr('action');

        function successCallback() {
            appendHTML(callBackRoute);
        }
        submitForm({
            type: "post",
            url,
            formData,
            successCallback
        })
    }
</script>
