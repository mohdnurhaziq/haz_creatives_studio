@extends('layouts.admin')

@section('title', 'Manage Purchases')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-white">Manage Purchases</h1>
    
    @if(session('success'))
        <div class="alert alert-success bg-green-900 border border-green-700 text-green-100 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-gray-800 border-gray-700 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-gray-400 mb-0">Total Purchases</h6>
                            <h3 class="text-white mb-0">${{ number_format($totalPurchases, 2) }}</h3>
                        </div>
                        <i class="fas fa-shopping-cart fa-2x text-blue-500"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-gray-800 border-gray-700 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-gray-400 mb-0">Pending Purchases</h6>
                            <h3 class="text-white mb-0">${{ number_format($pendingPurchases, 2) }}</h3>
                        </div>
                        <i class="fas fa-clock fa-2x text-yellow-500"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-gray-800 border-gray-700 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-gray-400 mb-0">Completed Purchases</h6>
                            <h3 class="text-white mb-0">${{ number_format($completedPurchases, 2) }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-2x text-green-500"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-gray-800 border-gray-700 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-gray-400 mb-0">Cancelled Purchases</h6>
                            <h3 class="text-white mb-0">${{ number_format($cancelledPurchases, 2) }}</h3>
                        </div>
                        <i class="fas fa-times-circle fa-2x text-red-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-gray-800 border-gray-700 mb-4 shadow-sm">
        <div class="card-header bg-gray-800 border-gray-700">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-shopping-cart me-1 text-gray-400"></i>
                    <span class="text-white font-medium">All Purchases</span>
                </div>
                <a href="{{ route('admin.purchases.create') }}" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                    <i class="fas fa-plus me-1"></i> New Purchase
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-white">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="text-gray-300">ID</th>
                            <th class="text-gray-300">Product</th>
                            <th class="text-gray-300">Supplier</th>
                            <th class="text-gray-300">Quantity</th>
                            <th class="text-gray-300">Unit Price</th>
                            <th class="text-gray-300">Total Price</th>
                            <th class="text-gray-300">Date</th>
                            <th class="text-gray-300">Status</th>
                            <th class="text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchases as $purchase)
                            <tr class="hover:bg-gray-700">
                                <td class="text-gray-300">{{ $purchase->id }}</td>
                                <td class="text-gray-300">{{ $purchase->product->name }}</td>
                                <td class="text-gray-300">{{ $purchase->supplier->name }}</td>
                                <td class="text-gray-300">{{ $purchase->quantity }}</td>
                                <td class="text-gray-300">${{ number_format($purchase->unit_price, 2) }}</td>
                                <td class="text-gray-300">${{ number_format($purchase->total_price, 2) }}</td>
                                <td class="text-gray-300">{{ $purchase->purchase_date->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $purchase->status === 'completed' ? 'success' : ($purchase->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($purchase->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.purchases.edit', $purchase) }}" class="btn btn-sm btn-info text-white hover:bg-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.purchases.destroy', $purchase) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this purchase?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-gray-400 py-4">No purchases found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $purchases->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 