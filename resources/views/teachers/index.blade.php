@extends('layouts.app')

@section('title', 'Teachers Management')

@section('header')
    <a href="/dashboard" class="btn btn-light btn-sm">Dashboard</a>
@endsection

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Teachers</h2>
                <p class="text-muted mb-0">Manage all registered teachers</p>
            </div>
            <a href="/teachers/create" class="btn btn-primary px-4">+ Add Teacher</a>
        </div>

        @if (session('success'))
            <div id="successMessage" class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if ($teachers->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Qualification</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td class="ps-4">#{{ $teacher->id }}</td>
                                        <td class="fw-semibold">{{ $teacher->name }}</td>
                                        <td>{{ $teacher->email }}</td>
                                        <td>{{ $teacher->phone }}</td>

                                        <td>
                                            <span class="badge bg-primary">
                                                {{ $teacher->subject }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $teacher->qualification ?? 'Not provided' }}
                                        </td>

                                        <td class="text-center">
                                            <a href="/teachers/{{ $teacher->id }}" class="btn btn-info btn-sm text-white">
                                                View
                                            </a>
                                            <a href="/teachers/{{ $teacher->id }}/edit" class="btn btn-warning btn-sm">
                                                Edit
                                            </a>

                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $teacher->id }}">
                                                Delete
                                            </button>

                                            <div class="modal fade" id="deleteModal{{ $teacher->id }}" tabindex="-1"
                                                aria-hidden="true">

                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bold">
                                                                Delete Teacher
                                                            </h5>

                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal">
                                                            </button>
                                                        </div>

                                                        <div class="modal-body text-start">
                                                            Are you sure you want to delete
                                                            <strong>{{ $teacher->name }}</strong>?
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Cancel
                                                            </button>

                                                            <form action="/teachers/{{ $teacher->id }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-danger">
                                                                    Yes, Delete
                                                                </button>
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
                        {{ $teachers->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <h5 class="text-muted">No teachers found</h5>
                        <p class="text-muted mb-3">
                            Add your first teacher.
                        </p>

                        <a href="/teachers/create" class="btn btn-primary">
                            + Add Teacher
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
