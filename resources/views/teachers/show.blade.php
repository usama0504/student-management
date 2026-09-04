@extends('layouts.app')

@section('title','Teacher Details')

@section('header')
    <a href="/teachers" class="btn btn-light btn-sm">Teachers</a>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 fw-bold">Teacher Details</h4>
                    <small>View complete teacher information</small>
                </div>

                <div class="card-body p-4">

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-muted">Teacher ID</div>
                        <div class="col-md-8">#{{ $teacher->id }}</div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-muted">Name</div>
                        <div class="col-md-8 fw-semibold">
                            {{ $teacher->name }}
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-muted">Email</div>
                        <div class="col-md-8">
                            {{ $teacher->email }}
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-muted">Phone</div>
                        <div class="col-md-8">
                            {{ $teacher->phone }}
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-muted">Subject</div>
                        <div class="col-md-8">
                            <span class="badge bg-primary">
                                {{ $teacher->subject }}
                            </span>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-4">
                        <div class="col-md-4 fw-semibold text-muted">
                            Qualification
                        </div>
                        <div class="col-md-8">
                            {{ $teacher->qualification ?? 'Not provided' }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/teachers" class="btn btn-outline-secondary">
                            ← Back
                        </a>

                        <a href="/teachers/{{ $teacher->id }}/edit"
                            class="btn btn-warning">
                            Edit Teacher
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection