@section('css')
    <style>
        .links{
            cursor: pointer;
        }
        .links:hover{
            background-color: rgb(240, 240, 240)
        }
    </style>
@endsection
<div class="col-md-3 bg-white p-4 shadow-sm rounded">
    <ul class="list-group list-group-flush">
        @php
            $links = ['Personal Information', 'Education'];
            $icons = ['fa fa-user','fa fa-cog'];
            $ids = ['personal', 'education'];
        @endphp
        @foreach ($links as $key => $item)
            <li class="list-group-item p-2 links" id="{{ $ids[$key] }}">
                <i class="{{ $icons[$key] }} me-3"></i> {{ $item }}
            </li>
        @endforeach
    </ul>
</div>
