<div class="mt-2 d-flex justify-content-end gap-2">
    @if ($delete ?? false)
    <button class="btn btn-danger" onclick="{{ $deleteButtonClick ?? null }}">Delete</button>
    @endif
    <button class="btn btn-outline-primary closeButton" onclick="{{ $closeButtonClick ?? null }}">Close</button>
    <button type="submit" class="btn btn-primary" onclick="{{ $saveButtonClick ?? null }}">Save</button>
</div>
