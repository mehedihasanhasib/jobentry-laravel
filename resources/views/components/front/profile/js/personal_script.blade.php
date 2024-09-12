<script>
    informationSection.on('click', '#personalSaveButton', function(e) {
        e.preventDefault();
        const form = $(this).closest('form')[0];
        const formData = new FormData(form);
        const url = $(form).attr('action');
        function successCallback(){
            appendHTML("{{ route('user.profile.personal') }}");
        }
        submitForm({type:"post", url, formData, successCallback})
    });
</script>
