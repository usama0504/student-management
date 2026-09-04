@extends('layouts.app')

@section('title', 'Classes Management')

@section('header')
    <a href="/dashboard" class="btn btn-light btn-sm">Dashboard</a>
@endsection

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Classes</h2>
                <p class="text-muted mb-0">Manage all classes and schedules</p>
            </div>
            <a href="/classes/create" class="btn btn-primary px-4">+ Create Class</a>
        </div>

        @if (session('success'))
            <div id="successMessage" class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if ($classes->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Class Name</th>
                                    <th>Course</th>
                                    <th>Teacher</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $class)
                                    <tr>
                                        <td class="ps-4">#{{ $class->id }}</td>
                                        <td class="fw-semibold">{{ $class->name }}</td>
                                        {{-- Updated here: access course name property --}}
                                        <td><span class="badge bg-primary">{{ $class->course->name ?? 'N/A' }}</span></td>
                                        <td>{{ $class->teacher->name ?? 'Not assigned' }}</td>
                                        <td>{{ $class->start_time ? date('h:i A', strtotime($class->start_time)) : 'Not set' }}
                                        </td>
                                        <td>{{ $class->end_time ? date('h:i A', strtotime($class->end_time)) : 'Not set' }}
                                        </td>
                                        <td class="text-center">
                                            <a href="/classes/{{ $class->id }}/edit"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $class->id }}">Delete</button>

                                            <div class="modal fade" id="deleteModal{{ $class->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bold">Delete Class</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            Are you sure you want to delete
                                                            <strong>{{ $class->name }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <form action="/classes/{{ $class->id }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Yes,
                                                                    Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center py-4">
                        {{ $classes->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <h5 class="text-muted">No classes found</h5>
                        <p class="text-muted mb-3">Create your first class.</p>
                        <a href="/classes/create" class="btn btn-primary">+ Create Class</a>
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