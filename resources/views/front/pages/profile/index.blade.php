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
    @include('components.front.common.header', ['heading' => 'Profile'])
    <div class="container-fluid p-4 wow fadeIn" style="background-color: #f8f9fa">
        <div class="row">
            @include('components.front.profile.profile_sidebar')

            <div class="col-md-9 mt-xsm-3 p-0" id="informationSection"></div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="post">
        @csrf
    </form>
@endsection

@section('script')
    <script>
        const informationSection = $('#informationSection');
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
            loader.toggleClass('show');
            $.get(route, function(data) {
                loader.removeClass('show');
                rows = data.rows;
                shouldEdit = Array(rows).fill(false);
                informationSection.html('');
                informationSection.html(data.view);
            });
        }

        function active(element) {
            $.each($('.links'), function(index, Element) {
                $(Element).removeClass('active');
            });
            $(element).addClass('active');
        }

        appendHTML("{{ route('user.profile.personal') }}");

        function changeModule(clickedLink, linkRoute){
            const id = clickedLink.attr('id');
            if(id == 'logout'){
                $('#logout-form').submit();
                return false;
            }
            moduleRoute = routes[id];
            active(clickedLink);
            appendHTML(linkRoute);
        }    
    </script>

    @include('components.front.profile.js.script')
    @include('components.front.profile.js.personal_script')
@endsection
