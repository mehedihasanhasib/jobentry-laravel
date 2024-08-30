@extends("components.front.layouts.app")
@section("title")
    Profile
@endsection
@section("content")
    @include("components.front.common.header", ["heading" => "Profile"])
    <div class="container-fluid p-4 wow fadeIn" style="background-color: #f8f9fa">
        <div class="row">
            @include("components.front.profile.profile_sidebar")

            <div class="col-md-9 mt-xsm-3">
                @yield("information")
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        const rows = @json($rows);
        const shouldEdit = Array(rows).fill(false);

        function editInput(text, edit, id, rowIndex = 0) {
            shouldEdit[rowIndex] = !shouldEdit[rowIndex];
            const textView = $(`#${text}`);
            const editView = $(`#${edit}`);
            const editButton = $(`#${id}`).find('span');

            if (textView && editView && editButton) {
                textView.toggle();
                editView.toggle();
                editButton.text(shouldEdit[rowIndex] ? 'Save' : 'Edit');
            }
        }
    </script>
    @yield("profilescript")
@endsection
