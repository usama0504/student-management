@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
    <div class="d-flex gap-3">
        <a href="/students" class="btn btn-light btn-sm">Students</a>
        <a href="/courses" class="btn btn-light btn-sm">Courses</a>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>
@endsection

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Dashboard</h2>
                <p class="text-muted mb-0">Student Management Overview</p>
            </div>
            <a href="/students/create" class="btn btn-primary">+ Add Student</a>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card text-white bg-primary shadow-sm border-0">
                    <div class="card-body">
                        <h6>Total Students</h6>
                        <h2 class="mb-0">{{ $totalStudents }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-white bg-warning shadow-sm border-0">
                    <div class="card-body">
                        <h6>Total Courses</h6>
                        <h2 class="mb-0">{{ $totalCourses }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Latest Students</h5>
            </div>

            <div class="card-body p-0">
                @if ($latestStudents->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Photo</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Courses</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($latestStudents as $student)
                                    <tr>
                                        <td class="ps-4">
                                            @if ($student->photo)
                                                <img src="{{ asset('storage/' . $student->photo) }}" width="45"
                                                    height="45" class="rounded-circle student-photo"
                                                    alt="{{ $student->name }}">
                                            @else
                                                <img src="{{ asset('images/default-avatar.png') }}" width="45"
                                                    height="45" class="rounded-circle student-photo" alt="Default Photo">
                                            @endif
                                        </td>

                                        <td>#{{ $student->id }}</td>
                                        <td class="fw-semibold">{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ $student->city }}
                                            </span>
                                        </td>

                                        <td>
                                            @if ($student->courses->count())
                                                @foreach ($student->courses as $course)
                                                    <span class="badge bg-primary mb-1">
                                                        {{ $course->name }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No course</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="/students/{{ $student->id }}?from=dashboard"
                                                class="btn btn-info btn-sm text-white">
                                                View
                                            </a>

                                            <a href="/students/{{ $student->id }}/edit?from=dashboard"
                                                class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-muted py-4 mb-0">
                        No students found.
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection

<style>
    .student-photo {
        object-fit: cover;
        border: 2px solid #dee2e6;
    }

    .table th,
    .table td {
        white-space: nowrap;
    }
</style>
