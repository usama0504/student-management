@extends('layouts.app')

@section('title','Edit Student')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm mx-auto border-0" style="max-width:600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Student</h4>
        </div>

        <div class="card-body">
            <form action="/students/{{ $student->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="from" value="{{ request('from') }}">

                @if($student->photo)
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/'.$student->photo) }}" width="100" height="100"
                            class="rounded-circle" style="object-fit:cover;">
                        <div class="text-muted small mt-1">Current Photo</div>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name',$student->name) }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email',$student->email) }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone',$student->phone) }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city',$student->city) }}">
                    @error('city')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    @error('photo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="text-muted">Leave empty if you don't want to change the photo.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Courses</label>

                    @if($courses->count())
                        <div class="border rounded p-3">
                            @foreach($courses as $course)
                                <div class="form-check mb-2">
                                    <input type="checkbox"
                                        name="courses[]"
                                        value="{{ $course->id }}"
                                        class="form-check-input"
                                        id="course{{ $course->id }}"
                                        @if($student->courses->contains($course->id)) checked @endif>

                                    <label class="form-check-label" for="course{{ $course->id }}">
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
                    <button type="submit" class="btn btn-primary">Update Student</button>

                    @if(request('from') == 'dashboard')
                        <a href="/dashboard" class="btn btn-secondary">Back</a>
                    @else
                        <a href="/students" class="btn btn-secondary">Back</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection