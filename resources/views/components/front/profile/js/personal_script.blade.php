<script>
    informationSection.on('click', '#closeButton', function(e) {
        e.preventDefault();
        $('#editView').toggle();
        $('#textView').toggle();
        $('#editButton').toggle();
    });

    informationSection.on('click', '#saveButton', function(e) {
        e.preventDefault();
        const form = $(this).closest('form')[0];
        const formData = new FormData(form);
        const url = $(form).attr('action');
        submitForm({type:"post", url, formData})
    });
</script>
