<div class="mb-3 d-flex flex-column align-items-center justify-content-center">
    <div class="position-relative">
        <img id="imagePreview" class="rounded-circle" src="{{ isset($user) ? asset('storage/'.$user->personalInfo->image) : asset('assets/img/user-dummy-img.jpg') }}" alt="Avatar" />
        <label class="camera-label" for="image">
            <i class="fa fa-camera"></i>
        </label>
    </div>
    <input class="d-none" id="image" name="profile_picture" type="file" accept="image/*" />
    <span class="profile_picture text-danger errors mt-2"></span>
</div>