@extends('layouts.app')

@section('title', 'Attendance Management')

@section('header')
    <a href="/dashboard" class="btn btn-light btn-sm">Dashboard</a>
@endsection

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Attendance</h2>
                <p class="text-muted mb-0">Manage student attendance records</p>
            </div>

            <div class="d-flex gap-2">
                <a href="/attendance/report" class="btn btn-outline-primary px-4">
                    Attendance Report
                </a>

                <a href="/attendance/create" class="btn btn-primary px-4">
                    + Mark Attendance
                </a>
            </div>
        </div>

        @if (session('success'))
            <div id="successMessage" class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if ($attendances->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Student</th>
                                    <th>Class</th>
                                    <th>Course</th>
                                    <th>Teacher</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td class="ps-4">
                                            #{{ $attendance->id }}
                                        </td>

                                        <td>
                                            {{ $attendance->student->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $attendance->classModel->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $attendance->classModel->course->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $attendance->classModel->teacher->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $attendance->date }}
                                        </td>

                                        <td>
                                            @if ($attendance->status == 'present')
                                                <span class="badge bg-success">
                                                    Present
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Absent
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="/attendance/{{ $attendance->id }}/edit"
                                                class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <form action="/attendance/{{ $attendance->id }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this attendance?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center py-4">
                        {{ $attendances->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <h5 class="text-muted">No attendance records found</h5>

                        <p class="text-muted mb-3">
                            Mark your first attendance.
                        </p>

                        <a href="/attendance/create" class="btn btn-primary">
                            + Mark Attendance
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<script>
    setTimeout(function() {
        let message = document.getElementById('successMessage');

        if (message) {
            message.style.transition = 'opacity 0.5s';
            message.style.opacity = '0';

            setTimeout(function() {
                message.remove();
            }, 500);
        }
    }, 3000);
</script>

<style>
    html {
        overflow-y: scroll;
    }

    .table th,
    .table td {
        white-space: nowrap;
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
    }

    .pagination .page-link {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border-radius: 50% !important;
    }
</style>