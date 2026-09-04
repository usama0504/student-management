@extends('layouts.app')

@section('title', 'Edit Course')

@section('header')
    <a href="/courses" class="btn btn-light btn-sm">Courses</a>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning py-3">
                    <h4 class="mb-0 fw-bold">Edit Course</h4>
                    <small>Update course information</small>
                </div>

                <div class="card-body p-4">
                    <form action="/courses/{{ $course->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Course Name</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Enter course name"
                                value="{{ old('name', $course->name) }}">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="4"
                                placeholder="Enter course description">{{ old('description', $course->description) }}</textarea>

                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Duration</label>
                            <input type="text" name="duration" class="form-control"
                                placeholder="e.g. 3 Months"
                                value="{{ old('duration', $course->duration) }}">

                            @error('duration')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Course Fee</label>

                            <div class="input-group">
                                <span class="input-group-text">Rs.</span>
                                <input type="number" name="fee" class="form-control"
                                    placeholder="Enter course fee"
                                    value="{{ old('fee', $course->fee) }}">
                            </div>

                            @error('fee')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/courses" class="btn btn-outline-secondary px-4">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-warning px-4 fw-semibold">
                                Update Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection