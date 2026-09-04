@extends('layouts.app')

@section('title','Students Management')

@section('header')
    <a href="/dashboard" class="btn btn-light btn-sm">Dashboard</a>
@endsection

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Students</h2>
            <p class="text-muted mb-0">Manage all registered students</p>
        </div>
        <a href="/students/create" class="btn btn-primary px-4">+ Add Student</a>
    </div>

    @if(session('success'))
        <div id="successMessage" class="alert alert-success border-0 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="/students" method="GET">
                <div class="input-group">
                    <input type="text" name="search" value="{{ $search }}"
                        class="form-control"
                        placeholder="Search by name, email, phone or city...">
                    <button type="submit" class="btn btn-primary px-4">Search</button>
                    <a href="/students" class="btn btn-outline-secondary px-4">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($students->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Photo</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Courses</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td class="ps-4">
                                        @if($student->photo)
                                            <img src="{{ asset('storage/'.$student->photo) }}"
                                                width="50" height="50"
                                                class="rounded-circle student-photo"
                                                alt="{{ $student->name }}">
                                        @else
                                            <img src="{{ asset('images/default-avatar.png') }}"
                                                width="50" height="50"
                                                class="rounded-circle student-photo"
                                                alt="Default Photo">
                                        @endif
                                    </td>

                                    <td>
                                        <span class="fw-semibold">#{{ $student->id }}</span>
                                    </td>

                                    <td>
                                        <span class="fw-semibold">{{ $student->name }}</span>
                                    </td>

                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>

                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $student->city }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($student->courses->count())
                                            @foreach($student->courses as $course)
                                                <span class="badge bg-primary mb-1">
                                                    {{ $course->name }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No course</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="/students/{{ $student->id }}"
                                            class="btn btn-info btn-sm text-white">
                                            View
                                        </a>

                                        <a href="/students/{{ $student->id }}/edit"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $student->id }}">
                                            Delete
                                        </button>

                                        <div class="modal fade"
                                            id="deleteModal{{ $student->id }}"
                                            tabindex="-1"
                                            aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold">
                                                            Delete Student
                                                        </h5>
                                                        <button type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body text-start">
                                                        Are you sure you want to delete
                                                        <strong>{{ $student->name }}</strong>?
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Cancel
                                                        </button>

                                                        <form action="/students/{{ $student->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">
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
                    {{ $students->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <h5 class="text-muted">No students found</h5>
                    <p class="text-muted mb-3">
                        Try another search or add a new student.
                    </p>
                    <a href="/students/create" class="btn btn-primary">
                        + Add Student
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

    if(message) {
        message.style.transition = 'opacity 0.5s';
        message.style.opacity = '0';

        setTimeout(function() {
            message.remove();
        }, 500);
    }
}, 3000);
</script>

<style>
html { overflow-y:scroll; }

.student-photo {
    object-fit:cover;
    border:2px solid #dee2e6;
}

.table th,
.table td {
    white-space:nowrap;
}

.pagination {
    display:flex;
    align-items:center;
    gap:6px;
    margin:0;
}

.pagination .page-item {
    margin:0;
}

.pagination .page-link {
    width:40px;
    height:40px;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:0;
    border:1px solid #dee2e6;
    border-radius:50% !important;
    color:#0d6efd;
    background:#fff;
}

.pagination .page-item.active .page-link {
    background:#0d6efd;
    border-color:#0d6efd;
    color:#fff;
}

.pagination .page-link:hover {
    background:#0d6efd;
    border-color:#0d6efd;
    color:#fff;
}

.pagination .page-item.disabled .page-link {
    background:#f1f3f5;
    color:#adb5bd;
}

.pagination .page-link:focus {
    box-shadow:none;
}
</style>