@php
    // add database fields name for new module
    $fields = [
        'education' => ['degree', 'exam', 'institute', 'passing_year', 'group', 'cgpa', 'scale'],
        'training' => ['title', 'institute', 'duration', 'start_date', 'topic', 'location'],
        'employment' => ['company_name', 'company_location', 'designation', 'responsibilities', 'from', 'to'],
    ];
    $components = [];
    foreach ($fields as $key => $field) {
        $array = [];
        foreach ($field as $key2 => $value) {
            $component = view('components.edit', [
                'id' => $value,
                'name' => $value,
                'type' => $types[$value],
                'value' => null,
                'label' => $labels[$value],
                'options' => [],
            ])->render();
            $array[] = $component;
        }

        $components[$key] = $array;
    }

    // add index function route for new module
    $routes = [
        'personal' => route('user.profile.personal'),
        'education' => route('user.profile.education'),
        'training' => route('user.profile.training'),
        'employment' => route('user.profile.employment'),
    ];
@endphp

<script>
    const fields = @json($components);
    const routes = @json($routes);

    function view1(moduleRoute, moduleFields, submitRoute) {
        return `<div class="card shadow-sm rounded border-0" id="addEducationForm">
                    <div class="card-body">
                        <form action="${submitRoute}" class="row mb-4">
                            ${moduleFields}
                            <x-save_close_buttons saveButtonClick="save(event, $(this), '${moduleRoute}')" closeButtonClick="Close(event, '${moduleRoute}')" />
                        </form>
                    </div>
                </div>`
    }

    function Close(event, url) {
        event.preventDefault();
        appendHTML(url);
    };

    function addInformation(button) {
        const id = button.attr('id');
        const submitRoute = button.attr('data-submitroute');
        informationSection.html('');
        informationSection.html(view1(moduleRoute, fields[id].join(''), submitRoute))
    }

    function save(event, button, callBackRoute) {
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

    function deleteInfo(event, button, deleteRoute, callBackRoute) {
        event.preventDefault();
        const form = button.closest('form');
        const id = $(form).find('input[type="hidden"]').val();
        const url = deleteRoute;

        function successCallback() {
            appendHTML(callBackRoute);
        }
        sweetAlertConfirm({
            icon: 'warning',
            title: 'Are you sure?',
            text: 'Do you want to proceed with this action?'
        }).then((confirmed) => {
            if (confirmed) {
                submitForm({
                    type: "DELETE",
                    url,
                    formData: {
                        id: id
                    },
                    successCallback
                })
            }
        });

    }
</script>
