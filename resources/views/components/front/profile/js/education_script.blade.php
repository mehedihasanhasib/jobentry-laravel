@php
    // types are defined in appservice provider
    $fields = ['degree', 'exam', 'institute', 'passing_year', 'group', 'cgpa', 'scale'];
    $components = [];
    foreach ($fields as $key => $field) {
        $component = view('components.edit', [
            'id' => 1,
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
    const fields = @json($fields);
    let view = @json($components).join('');
    
    $('#informationSection').on('click', '#addEducation', function(e) {
        view = `<div class="card shadow-sm rounded border-0">
                    <div class="card-body">
                        <div class="row mb-4">
                            ${view}
                        </div>
                    </div>
                </div>`
        informationSection.html(view)
    });
</script>
