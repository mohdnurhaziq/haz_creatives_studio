@extends('layouts.admin')

@section('title', 'Create New Purchase')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-gray-800">Create New Purchase</h1>
    
    @if($errors->any())
        <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-white">
            <i class="fas fa-plus me-1 text-gray-600"></i>
            <span class="text-gray-700 font-medium">Purchase Details</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.purchases.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="product_id" class="form-label text-gray-700">Product</label>
                            <select class="form-select border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                id="product_id" name="product_id" required>
                                <option value="">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} - ${{ number_format($product->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="supplier_id" class="form-label text-gray-700">Supplier</label>
                            <select class="form-select border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                id="supplier_id" name="supplier_id" required>
                                <option value="">Select a supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="quantity" class="form-label text-gray-700">Quantity</label>
                            <input type="number" class="form-control border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="unit_price" class="form-label text-gray-700">Unit Price</label>
                            <input type="number" class="form-control border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                id="unit_price" name="unit_price" value="{{ old('unit_price') }}" step="0.01" min="0" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="total_price" class="form-label text-gray-700">Total Price</label>
                            <input type="number" class="form-control border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                id="total_price" name="total_price" value="{{ old('total_price') }}" step="0.01" min="0" required readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="purchase_date" class="form-label text-gray-700">Purchase Date</label>
                            <input type="date" class="form-control border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                id="purchase_date" name="purchase_date" value="{{ old('purchase_date', date('Y-m-d')) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status" class="form-label text-gray-700">Status</label>
                            <select class="form-select border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                id="status" name="status" required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        <i class="fas fa-save me-1"></i> Create Purchase
                    </button>
                    <a href="{{ route('admin.purchases.index') }}" class="btn btn-secondary text-gray-700 font-medium py-2 px-4 rounded">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        const unitPriceInput = document.getElementById('unit_price');
        const totalPriceInput = document.getElementById('total_price');

        function calculateTotal() {
            const quantity = parseFloat(quantityInput.value) || 0;
            const unitPrice = parseFloat(unitPriceInput.value) || 0;
            totalPriceInput.value = (quantity * unitPrice).toFixed(2);
        }

        quantityInput.addEventListener('input', calculateTotal);
        unitPriceInput.addEventListener('input', calculateTotal);
    });
</script>
@endpush
@endsection 