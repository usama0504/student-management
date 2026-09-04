@extends('layouts.app')

@section('title', 'Course Details')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0 mx-auto" style="max-width: 600px;">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Course Details</h4>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <strong>Course Name:</strong>
                    {{ $course->name }}
                </div>

                <div class="mb-3">
                    <strong>Description:</strong>
                    {{ $course->description }}
                </div>

                <div class="mb-3">
                    <strong>Duration:</strong>
                    {{ $course->duration }}
                </div>

                <div class="mb-3">
                    <strong>Fee:</strong>
                    {{ $course->fee }}
                </div>

                <hr>

                <h5 class="mb-3">Students</h5>

                @if ($course->students->count())
                    <ul>
                        @foreach ($course->students as $student)
                            <li>{{ $student->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No students assigned.</p>
                @endif

                <a href="/courses" class="btn btn-secondary mt-3">
                    Back
                </a>

            </div>
        </div>
    </div>
@endsection