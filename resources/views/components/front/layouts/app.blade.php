<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('css')
    <link href="{{ asset('logo.svg') }}" rel="icon">

    <x-front.common.css_links />
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <x-front.common.loader />
        <x-front.common.navbar />


        @yield('content')

        <x-front.common.footer />

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>


    <x-front.common.js_links />
    <script src="{{ asset('js/alerts.js') }}"></script>
    <script>
        const loader = $('#spinner');
        function submitForm({
            type,
            url,
            formData,
            successCallback
        }) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            loader.toggleClass('show');

            let ajaxOptions = {
                type: type,
                url: url,
                dataType: "json",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        successCallback(response)
                        notification({icon:"success", text:response.message});
                    } else {
                        loader.toggleClass('show')
                        setTimeout(() => {
                            // sweetAlert({icon:"error", title:"Error", text:response.errors});
                            notification({icon:"error", text:response.errors});
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
                            notification({icon:"error", text:"Validation Failed!"});
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
    </script>
    @yield('script')
</body>

</html>
