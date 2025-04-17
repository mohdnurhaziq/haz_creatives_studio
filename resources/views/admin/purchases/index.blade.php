@extends('layouts.admin')

@section('title', 'Manage Records - Haz Creatives Studio')

@section('header', 'Manage Records')

@section('content')
<div class="container-fluid">
    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Income</h5>
                    <p class="card-title stats-number text-success">RM {{ number_format($totalIncome, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Expenses</h5>
                    <p class="card-title stats-number text-danger">RM {{ number_format($totalExpense, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Net Amount</h5>
                    <p class="card-title stats-number {{ $netAmount >= 0 ? 'text-success' : 'text-danger' }}">
                        RM {{ number_format($netAmount, 2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('admin.purchases.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Record
                    </a>
                    <a href="{{ route('admin.purchases.report') }}" class="btn btn-info ms-2">
                        <i class="fas fa-chart-line"></i> View Report
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Records List -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Recent Records</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->purchase_date->format('d M Y') }}</td>
                            <td>
                                {{ $purchase->item_name }}
                                @if($purchase->invoice_number)
                                <br>
                                <small class="text-muted">Invoice: {{ $purchase->invoice_number }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $purchase->type === 'income' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($purchase->type) }}
                                </span>
                            </td>
                            <td>{{ $purchase->formatted_amount }}</td>
                            <td>
                                @if($purchase->assignedUser)
                                    {{ $purchase->assignedUser->name }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ ucfirst($purchase->status) }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.purchases.edit', $purchase) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.purchases.destroy', $purchase) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $purchases->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 