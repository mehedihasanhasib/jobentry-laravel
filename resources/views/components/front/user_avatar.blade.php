<div class="mb-3 d-flex flex-column align-items-center justify-content-center">
    @if (isset($name))
        <label class="form-label">{{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</label>
    @endif
    <div class="position-relative">
        <img id="imagePreview" class="rounded-circle" src="{{ isset($user) ? (isset($user->personalInfo->image) ? asset('storage/' . $user->personalInfo->image) : asset('assets/img/user-dummy-img.jpg')) : asset('assets/img/user-dummy-img.jpg') }}" alt="Avatar" />
        <label class="camera-label" for="image">
            <i class="fa fa-camera"></i>
        </label>
    </div>
    <input class="d-none" id="image" name="{{ $name }}" type="file" accept="image/*" />
    <span class="{{ $name }} text-danger errors mt-2"></span>
</div>
