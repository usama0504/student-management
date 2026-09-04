@extends('layouts.app')

@section('title', 'Edit Fee')

@section('header')
    <a href="/dashboard" class="btn btn-light btn-sm">Dashboard</a>
@endsection

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Edit Fee</h2>
            <p class="text-muted mb-0">Update student fee record</p>
        </div>

        <a href="/fees" class="btn btn-secondary">
            Back to Fees
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="/fees/{{ $fee->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Student ID</label>
                    <input type="number"
                           name="student_id"
                           class="form-control"
                           value="{{ old('student_id', $fee->student_id) }}">

                    @error('student_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Fee Amount</label>
                    <input type="number"
                           name="fee_amount"
                           class="form-control"
                           value="{{ old('fee_amount', $fee->fee_amount) }}"
                           step="0.01">

                    @error('fee_amount')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Paid Amount</label>
                    <input type="number"
                           name="paid_amount"
                           class="form-control"
                           value="{{ old('paid_amount', $fee->paid_amount) }}"
                           step="0.01">

                    @error('paid_amount')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Due Date</label>
                    <input type="date"
                           name="due_date"
                           class="form-control"
                           value="{{ old('due_date', $fee->due_date) }}">

                    @error('due_date')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    Update Fee
                </button>

                <a href="/fees" class="btn btn-secondary">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>
@endsection