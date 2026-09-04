@extends('layouts.app')

@section('title','Add Student')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm mx-auto border-0" style="max-width:600px;">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0">Add Student</h4>
            <small>Create a new student record</small>
        </div>

        <div class="card-body p-4">
            <form action="/students" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name') }}" placeholder="Enter student name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email') }}" placeholder="Enter email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone') }}" placeholder="Enter phone number">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">City</label>
                    <input type="text" name="city" class="form-control"
                        value="{{ old('city') }}" placeholder="Enter city">
                    @error('city')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Photo</label>
                    <input type="file" name="photo" id="photo"
                        class="form-control" accept="image/*"
                        onchange="previewPhoto(event)">

                    @error('photo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="mt-3 text-center">
                        <img id="photoPreview"
                            src=""
                            width="120"
                            height="120"
                            class="rounded-circle d-none student-photo"
                            alt="Photo Preview">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Courses</label>

                    @if(isset($courses) && $courses->count())
                        <div class="border rounded p-3">
                            @foreach($courses as $course)
                                <div class="form-check mb-2">
                                    <input type="checkbox"
                                        name="courses[]"
                                        value="{{ $course->id }}"
                                        class="form-check-input"
                                        id="course{{ $course->id }}"
                                        @if(is_array(old('courses')) && in_array($course->id, old('courses'))) checked @endif>

                                    <label class="form-check-label"
                                        for="course{{ $course->id }}">
                                        {{ $course->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            No courses available.
                        </div>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Add Student
                    </button>
                    <a href="/students" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
function previewPhoto(event) {
    const image = document.getElementById('photoPreview');
    const file = event.target.files[0];

    if(file) {
        image.src = URL.createObjectURL(file);
        image.classList.remove('d-none');
    } else {
        image.src = '';
        image.classList.add('d-none');
    }
}
</script>

<style>
.student-photo {
    object-fit:cover;
    border:3px solid #dee2e6;
}
</style>