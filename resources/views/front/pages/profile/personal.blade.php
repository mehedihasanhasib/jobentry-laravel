@extends("front.pages.profile.index")

@section("information")
    <div class="col-md-9">
        <div class="card shadow-sm rounded border-0">
            @include("components.front.profile.card_header", ['heading' => 'Personal Information'])

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <span style="font-size: 15px">Lable</span>
                        <p><strong>Value</strong></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
