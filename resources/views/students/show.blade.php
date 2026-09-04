@extends('layouts.app')

@section('title','Student Details')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm mx-auto border-0" style="max-width:650px;">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0">Student Details</h4>
            <small>Complete student information</small>
        </div>

        <div class="card-body p-4">
            <div class="text-center mb-4">
                @if($student->photo)
                    <img src="{{ asset('storage/'.$student->photo) }}"
                        width="120" height="120"
                        class="rounded-circle student-photo"
                        alt="{{ $student->name }}">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}"
                        width="120" height="120"
                        class="rounded-circle student-photo"
                        alt="Default Photo">
                @endif

                <h5 class="fw-bold mt-3 mb-1">{{ $student->name }}</h5>
                <span class="text-muted">Student #{{ $student->id }}</span>
            </div>

            <hr>

            <div class="info-row">
                <strong>ID</strong>
                <span>#{{ $student->id }}</span>
            </div>

            <div class="info-row">
                <strong>Name</strong>
                <span>{{ $student->name }}</span>
            </div>

            <div class="info-row">
                <strong>Email</strong>
                <span>{{ $student->email }}</span>
            </div>

            <div class="info-row">
                <strong>Phone</strong>
                <span>{{ $student->phone }}</span>
            </div>

            <div class="info-row">
                <strong>City</strong>
                <span class="badge bg-light text-dark border">
                    {{ $student->city }}
                </span>
            </div>

            <hr>

            <div class="mb-3">
                <strong>Courses</strong>

                <div class="mt-2">
                    @if($student->courses->count())
                        @foreach($student->courses as $course)
                            <span class="badge bg-primary me-1 mb-1">
                                {{ $course->name }}
                            </span>
                        @endforeach
                    @else
                        <span class="text-muted">No course assigned.</span>
                    @endif
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                @if(request('from') == 'dashboard')
                    <a href="/dashboard" class="btn btn-secondary">Back</a>
                @else
                    <a href="/students" class="btn btn-secondary">Back</a>
                @endif

                <a href="/students/{{ $student->id }}/edit"
                    class="btn btn-warning">
                    Edit Student
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.student-photo {
    object-fit:cover;
    border:3px solid #dee2e6;
}

.info-row {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 0;
    border-bottom:1px solid #f1f1f1;
}

.info-row strong {
    color:#495057;
}
</style>