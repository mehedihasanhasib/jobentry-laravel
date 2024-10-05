<div class="card-header bg-primary text-white border-0 d-flex align-items-center justify-content-between">
    <div>{{ $heading }}</div>


    <div class="d-flex">
        @if (isset($module) && isset($addbuttonid) && isset($submitroute))
            <x-front.add_button :module="$module ?? null" :id="$addbuttonid ?? null" :submitroute="$submitRoute ?? null" />
        @endif
        <button class="btn" style="color: white;" id="{{ $id }}" onclick="{{ $click }}">
            <span>Edit</span>
        </button>
    </div>

</div>
