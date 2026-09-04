@extends('layouts.app')

@section('title', 'Fee History')

@section('header')
    <a href="/dashboard" class="btn btn-light btn-sm">Dashboard</a>
@endsection

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Fee History</h2>
            <p class="text-muted mb-0">View all student fee records</p>
        </div>

        <div class="d-flex gap-2">
            <a href="/fees" class="btn btn-secondary">
                Back to Fees
            </a>

            <a href="/fees/create" class="btn btn-primary">
                + Add Fee
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($fees->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Student ID</th>
                                <th>Fee Amount</th>
                                <th>Paid Amount</th>
                                <th>Pending Amount</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Added On</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($fees as $fee)
                                <tr>
                                    <td class="ps-4">#{{ $fee->id }}</td>

                                    <td>
                                        {{ $fee->student_id }}
                                    </td>

                                    <td>
                                        {{ number_format($fee->fee_amount, 2) }}
                                    </td>

                                    <td>
                                        {{ number_format($fee->paid_amount, 2) }}
                                    </td>

                                    <td>
                                        {{ number_format($fee->pending_amount, 2) }}
                                    </td>

                                    <td>
                                        {{ $fee->due_date ?? 'N/A' }}
                                    </td>

                                    <td>
                                        @if($fee->status == 'paid')
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
                                        {{ $fee->created_at->format('d M Y') }}
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
                    <h5 class="text-muted">No fee history found</h5>

                    <p class="text-muted mb-3">
                        There are no fee records available yet.
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