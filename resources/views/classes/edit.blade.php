@extends('layouts.app')

@section('title','Edit Class')

@section('header')
    <a href="/classes" class="btn btn-light btn-sm">Classes</a>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-warning py-3">
                    <h4 class="mb-0 fw-bold">Edit Class</h4>
                    <small>Update class information</small>
                </div>

                <div class="card-body p-4">
                    <form action="/classes/{{ $class->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Class Name</label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                placeholder="e.g. Class 10-A"
                                value="{{ old('name', $class->name) }}">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Course Dropdown -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Course</label>
                            <select name="course_id" class="form-control" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id', $class->course_id) == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('course_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Teacher Dropdown -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Teacher</label>
                            <select name="teacher_id" class="form-control">
                                <option value="">Select Teacher (Optional)</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $class->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('teacher_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Start Time
                                </label>

                                <input type="time"
                                    name="start_time"
                                    class="form-control"
                                    value="{{ old('start_time', $class->start_time) }}">

                                @error('start_time')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    End Time
                                </label>

                                <input type="time"
                                    name="end_time"
                                    class="form-control"
                                    value="{{ old('end_time', $class->end_time) }}">

                                @error('end_time')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/classes"
                                class="btn btn-outline-secondary px-4">
                                Cancel
                            </a>

                            <button type="submit"
                                class="btn btn-warning px-4 fw-semibold">
                                Update Class
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection