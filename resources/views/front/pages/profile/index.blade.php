@extends('components.front.layouts.app')
@section('title')
    Profile
@endsection
@section('css')
    <style>
        .links {
            cursor: pointer;
        }

        .links:hover {
            background-color: rgb(240, 240, 240)
        }

        #closeButton:hover{
            color: white;
        }
    </style>
@endsection
@section('content')
    @include('components.front.common.header', ['heading' => 'Profile'])
    <div class="container-fluid p-4 wow fadeIn" style="background-color: #f8f9fa">
        <div class="row">
            @include('components.front.profile.profile_sidebar')

            <div class="col-md-9 mt-xsm-3" id="informationSection"></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const informationSection = $('#informationSection');
        let rows;
        let shouldEdit;

        function editInput(text, edit, id, rowIndex = 0) {
            shouldEdit[rowIndex] = !shouldEdit[rowIndex];
            const textView = $(`#${text}`);
            const editView = $(`#${edit}`);
            const editButton = $(`#${id}`);

            if (textView && editView && editButton) {
                textView.toggle();
                editView.toggle();
                editButton.toggle();
            }
        }

        function appendHTML(route) {
            $.get(route, function(data) {
                rows = data.rows;
                shouldEdit = Array(rows).fill(false);
                informationSection.html('');
                informationSection.html(data.view);
            });
        }

        function active(element) {
            $.each($('.links'), function(indexInArray, valueOfElement) {
                $(valueOfElement).removeClass('active');
            });
            $(element).addClass('active');
        }

        appendHTML("{{ route('user.profile.personal') }}");

        $('#personal').click(function(e) {
            active($(this));
            appendHTML("{{ route('user.profile.personal') }}");
        });
        $('#education').click(function(e) {
            active($(this));
            appendHTML("{{ route('user.profile.education') }}");
        });
    </script>

    @include('components.front.profile.js.education_script')
    @include('components.front.profile.js.personal_script')
@endsection
