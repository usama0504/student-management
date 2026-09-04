@extends('layouts.app')

@section('title','Add Teacher')

@section('header')
    <a href="/teachers" class="btn btn-light btn-sm">Teachers</a>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 fw-bold">Add Teacher</h4>
                    <small>Create a new teacher record</small>
                </div>

                <div class="card-body p-4">
                    <form action="/teachers" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Enter teacher name"
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Enter teacher email"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                placeholder="Enter phone number"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Subject</label>
                            <input type="text" name="subject" class="form-control"
                                placeholder="e.g. Mathematics"
                                value="{{ old('subject') }}">
                            @error('subject')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Qualification</label>
                            <input type="text" name="qualification" class="form-control"
                                placeholder="e.g. BS Computer Science"
                                value="{{ old('qualification') }}">
                            @error('qualification')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/teachers" class="btn btn-outline-secondary px-4">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                + Add Teacher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection