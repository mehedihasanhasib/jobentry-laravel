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

        .closeButton:hover {
            color: white !important;
        }
    </style>
@endsection
@section('content')
    {{-- @include('components.front.common.header', ['heading' => 'Profile']) --}}
    <div class="container-fluid p-4 wow fadeIn" style="background-color: #f8f9fa">
        <div class="row">
            @include('components.front.profile.profile_sidebar')

            <div class="col-md-9 mt-xsm-3" id="informationSection"></div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="post">
        @csrf
    </form>
@endsection

@section('script')
    <script>
        const informationSection = $('#informationSection');
        const spinner = $('#spinner');
        let rows;
        let shouldEdit;
        let moduleRoute;

        function editInput(text, edit, id, rowIndex = 0, event = null) {
            if (event) {
                event.preventDefault();
            }
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
                spinner.removeClass('show');
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
            const thisLink = $(this);
            const id = $(this).attr('id');
            moduleRoute = routes[id];
            active(thisLink);
            appendHTML("{{ route('user.profile.personal') }}");
            spinner.toggleClass('show');
        });
        $('#education').click(function(e) {
            const thisLink = $(this);
            const id = $(this).attr('id');
            moduleRoute = routes[id];
            active(thisLink);
            appendHTML("{{ route('user.profile.education') }}");
            spinner.toggleClass('show');
        });
        $('#training').click(function(e) {
            const thisLink = $(this);
            const id = $(this).attr('id');
            moduleRoute = routes[id];
            active(thisLink);
            appendHTML("{{ route('user.profile.training') }}");
            spinner.toggleClass('show');
        });

        $('#logout').click(function(e) {
            $('#logout-form').submit();
        });

        
    </script>

    @include('components.front.profile.js.script')
    @include('components.front.profile.js.personal_script')
@endsection
