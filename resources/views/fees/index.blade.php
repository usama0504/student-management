@extends('layouts.app')

@section('title', 'Fee Management')

@section('header')
    <a href="/dashboard" class="btn btn-light btn-sm">Dashboard</a>
@endsection

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Fees</h2>
                <p class="text-muted mb-0">Manage student fee records</p>
            </div>

            <div class="d-flex gap-2">
                <a href="/fees/history" class="btn btn-outline-primary px-4">
                    Fee History
                </a>

                <a href="/fees/create" class="btn btn-primary px-4">
                    + Add Fee
                </a>
            </div>
        </div>

        @if (session('success'))
            <div id="successMessage" class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form action="/fees" method="GET">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input type="number" name="search" class="form-control" value="{{ $search }}"
                                placeholder="Search by Student ID">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                Search
                            </button>
                        </div>

                        <div class="col-md-2">
                            <a href="/fees" class="btn btn-outline-secondary w-100">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if ($fees->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Student ID</th>
                                    <th>Fee</th>
                                    <th>Paid</th>
                                    <th>Pending</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($fees as $fee)
                                    <tr>
                                        <td class="ps-4">#{{ $fee->id }}</td>
                                        <td>{{ $fee->student_id }}</td>
                                        <td>{{ number_format($fee->fee_amount, 2) }}</td>
                                        <td>{{ number_format($fee->paid_amount, 2) }}</td>
                                        <td>{{ number_format($fee->pending_amount, 2) }}</td>
                                        <td>{{ $fee->due_date ?? 'N/A' }}</td>

                                        <td>
                                            @if ($fee->status == 'paid')
                                                <span class="badge bg-success">
                                                    Paid
                                                </span>
                                            @elseif($fee->status == 'partial')
                                                <span class="badge bg-warning text-dark">
                                                    Partial
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="/fees/{{ $fee->id }}/edit" class="btn btn-sm btn-warning">
                                                Edit
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center py-4">
                        {{ $fees->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <h5 class="text-muted">No fee records found</h5>
                        <p class="text-muted mb-3">
                            Add your first student fee.
                        </p>

                        <a href="/fees/create" class="btn btn-primary">
                            + Add Fee
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
