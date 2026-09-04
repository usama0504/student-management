@extends('layouts.app')

@section('title', 'Student Details')

@section('header')
    <a href="/students" class="btn btn-light btn-sm">← Students</a>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg overflow-hidden student-card">

                    <div class="profile-header text-white text-center">
                        @if ($student->photo)
                            <img src="{{ asset('storage/' . $student->photo) }}" class="student-photo"
                                alt="{{ $student->name }}">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" class="student-photo" alt="Default Photo">
                        @endif

                        <h2 class="fw-bold mt-3 mb-1">{{ $student->name }}</h2>

                        <div class="student-id">
                            Student ID #{{ $student->id }}
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">

                        <h5 class="fw-bold mb-3">Student Information</h5>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="info-card">
                                    <span class="info-icon">✉️</span>
                                    <div>
                                        <small class="text-muted d-block">Email</small>
                                        <strong class="text-break">{{ $student->email }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <span class="info-icon">📱</span>
                                    <div>
                                        <small class="text-muted d-block">Phone</small>
                                        <strong>{{ $student->phone }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <span class="info-icon">📍</span>
                                    <div>
                                        <small class="text-muted d-block">City</small>
                                        <strong>{{ $student->city }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <span class="info-icon">📚</span>
                                    <div>
                                        <small class="text-muted d-block">Courses</small>
                                        <strong>{{ $student->courses->count() }} Enrolled</strong>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold mb-3">Enrolled Courses</h5>

                        @if ($student->courses->count())
                            <div class="course-list">
                                @foreach ($student->courses as $course)
                                    <div class="course-item">
                                        <span>📚</span>
                                        <strong>{{ $course->name }}</strong>
                                        <small class="text-muted ms-auto">
                                            {{ $course->duration }}
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center text-muted bg-light p-4 rounded">
                                No course assigned.
                            </div>
                        @endif

                        <div class="d-flex gap-2 mt-4 pt-3 border-top">

                            @if (request('from') == 'dashboard')
                                <a href="/dashboard" class="btn btn-outline-secondary">
                                    ← Back
                                </a>
                            @else
                                <a href="/students" class="btn btn-outline-secondary">
                                    ← Back
                                </a>
                            @endif

                            <a href="/students/{{ $student->id }}/edit" class="btn btn-warning">
                                ✏️ Edit Student
                            </a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .student-card {
        border-radius: 18px
    }

    .profile-header {
        background: linear-gradient(135deg, #0d6efd, #084298);
        padding: 35px 20px
    }

    .student-photo {
        width: 125px;
        height: 125px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .2)
    }

    .info-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        background: #f8f9fa;
        border: 1px solid #eee;
        border-radius: 12px;
        height: 100%
    }

    .info-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 10px;
        font-size: 18px;
        flex-shrink: 0
    }

    .student-id {
        display: inline-block;
        margin-top: 8px;
        padding: 5px 12px;
        background: rgba(255, 255, 255, .18);
        border: 1px solid rgba(255, 255, 255, .3);
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
    }

    .course-list {
        display: flex;
        flex-direction: column;
        gap: 10px
    }

    .course-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        background: #f8f9fa;
        border: 1px solid #eee;
        border-radius: 10px
    }

    @media(max-width:576px) {
        .student-photo {
            width: 110px;
            height: 110px
        }

        .card-body {
            padding: 25px !important
        }
    }
</style>
