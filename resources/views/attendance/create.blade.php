@extends('layouts.app')

@section('title','Mark Attendance')

@section('header')
    <a href="/attendance" class="btn btn-light btn-sm">Attendance</a>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 fw-bold">Mark Attendance</h4>
                    <small>Record student attendance</small>
                </div>

                <div class="card-body p-4">
                    <form action="/attendance" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Student</label>

                            <select name="student_id" class="form-select">
                                <option value="">Select Student</option>

                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}"
                                        {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('student_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Class</label>

                            <select name="class_id" class="form-select">
                                <option value="">Select Class</option>

                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                        - {{ $class->course->name ?? 'N/A' }}
                                        - {{ $class->teacher->name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>

                            @error('class_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Date</label>

                            <input type="date"
                                name="date"
                                class="form-control"
                                value="{{ old('date', date('Y-m-d')) }}">

                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Status</label>

                            <select name="status" class="form-select">
                                <option value="present"
                                    {{ old('status', 'present') == 'present' ? 'selected' : '' }}>
                                    Present
                                </option>

                                <option value="absent"
                                    {{ old('status') == 'absent' ? 'selected' : '' }}>
                                    Absent
                                </option>
                            </select>

                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/attendance" class="btn btn-outline-secondary px-4">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                Mark Attendance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection