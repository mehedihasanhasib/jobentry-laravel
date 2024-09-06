<div class="col-md-6 mt-2">
    <div class="form-group">
        <label>{{ $label }}</label>
        @if ($type === "select")
            <select class="form-select" id="{{ $id }}" name="{{ $name }}">
                @foreach ($options as $option)
                    <option value="{{ $option }}" @selected($option == $value)>{{ $option }}</option>
                @endforeach
            </select>
        @else
            <input class="form-control" id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ $value }}">
        @endif
    </div>
</div>
