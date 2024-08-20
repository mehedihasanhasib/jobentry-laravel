@extends("front.pages.profile.index")

@section("information")
    <div class="col-md-9">
        <div class="card shadow-sm rounded border-0">
            <x-front.profile.card_header heading="Personal Information" />

            <div class="card-body">
                <div class="row mb-4" id="textView">
                        <x-front.profile.text value="Mehedi Hasan" label="First Name" />
                        <x-front.profile.text value="Hasib" label="Last Name" />
                        <x-front.profile.text value="hasib@email.com" label="Email" />
                        <x-front.profile.text value="Abul Kalam Azad" label="Father Name" />
                        <x-front.profile.text value="Masuda Begum" label="Mother Name" />
                        <x-front.profile.text value="05 Dec 1998" label="Date of Birth" />
                        <x-front.profile.text value="Male" label="Gender" />
                        <x-front.profile.text value="01965046625" label="Phone" />
                </div>

                <div class="row mb-4" id="editView" style="display: none">
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input class="form-control" id="firstName" name="first_name" type="text" value="Mehedi Hasan">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let edit = false;
        $('#editButton').click(function (e) {
            edit = !edit;

            let textView = $('#textView');
            let editView = $('#editView');
            let editButton = $('#editButton span')

            if (edit) {
                textView.css('display', 'none');
                editView.css('display', '');
                editButton.text('Save');
            } else{
                textView.css('display', '');
                editView.css('display', 'none'); 
                editButton.text('Edit');
            }
        });
    </script>
@endsection
