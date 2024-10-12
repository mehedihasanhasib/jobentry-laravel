function submitForm({
    type,
    url,
    formData,
    successCallback = undefined
}) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if (loader) {
        loader.toggleClass('show');
    } else {
        console.log("no loader found")
    }
    let ajaxOptions = {
        type: type,
        url: url,
        dataType: "json",
        data: formData,
        success: function(response) {
            if (response.success) {
                if (successCallback != undefined) {
                    successCallback(response)
                }
                notification({
                    icon: "success",
                    text: response.message
                });
            } else {
                loader.toggleClass('show')
                setTimeout(() => {
                    // sweetAlert({icon:"error", title:"Error", text:response.errors});
                    notification({
                        icon: "error",
                        text: response.errors
                    });
                }, 500);
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                $(`.errors`).text('');
                $.each(errors, function(key, value) {
                    $(`.${key}`).text(value[0]);
                });
                setTimeout(() => {
                    notification({
                        icon: "error",
                        text: "Validation Failed!"
                    });
                }, 500);
            }
            loader.toggleClass('show')
        }
    };

    // Check if formData is an instance of FormData
    if (formData instanceof FormData) {
        ajaxOptions.processData = false;
        ajaxOptions.contentType = false;
    }

    $.ajax(ajaxOptions);
}