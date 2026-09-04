@extends('layouts.app')

@section('title', 'Attendance Report')

@section('header')
    <a href="/attendance" class="btn btn-light btn-sm">Attendance</a>
@endsection

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Attendance Report</h2>
            <p class="text-muted mb-0">View attendance summary and records</p>
        </div>

        <a href="/attendance/create" class="btn btn-primary px-4">
            + Mark Attendance
        </a>
    </div>

    {{-- Date Filter --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="/attendance/report" method="GET" class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Select Date</label>

                    <input
                        type="date"
                        name="date"
                        class="form-control"
                        value="{{ $date }}"
                    >
                </div>

                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">
                        Filter
                    </button>

                    <a href="/attendance/report" class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Summary --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Total</p>
                    <h2 class="fw-bold mb-0">{{ $total }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Present</p>
                    <h2 class="fw-bold text-success mb-0">{{ $present }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Absent</p>
                    <h2 class="fw-bold text-danger mb-0">{{ $absent }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Attendance Table --}}
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

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">
                    <h5 class="text-muted">No attendance records found</h5>
                    <p class="text-muted mb-0">
                        No attendance is available for this date.
                    </p>
                </div>

            @endif

        </div>

    </div>

</div>
@endsection

<style>
    html {
        overflow-y: scroll;
    }

    .table th,
    .table td {
        white-space: nowrap;
    }
</style>