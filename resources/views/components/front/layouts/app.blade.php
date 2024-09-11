<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
    <script>
        function submitForm({type, url, formData, successCallback}) {
            formData.append("_token", "{{ csrf_token() }}");
            spinner.toggleClass('show')
            $.ajax({
                type: type,
                url: url,
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        successCallback(response)
                    } else{
                        console.log(response)
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $(`.errors`).text('');
                        $.each(errors, function(key, value) {
                            $(`.${key}`).text(value[0]);
                        });
                    }
                    spinner.toggleClass('show')
                }
            });
        }
    </script>
    @yield('script')
</body>

</html>
