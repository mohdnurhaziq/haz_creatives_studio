@extends('layouts.admin')

@section('title', 'Create New Purchase')

@section('content')
    <div class="container-fluid" data-aos="fade-up">
        <h1 class="mt-4 text-white">Create New Purchase</h1>

        @if ($errors->any())
            <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark">
                <i class="fas fa-plus me-1 text-secondary"></i>
                <span class="text-white">Purchase Details</span>
            </div>
            <div class="card-body bg-dark">
                <form action="{{ route('admin.purchases.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_id" class="form-label text-white">Product</label>
                                <select class="form-select bg-dark text-white border-secondary" id="product_id"
                                    name="product_id" required>
                                    <option value="">Select a product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} - ${{ number_format($product->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="supplier_id" class="form-label text-white">Supplier</label>
                                <select class="form-select bg-dark text-white border-secondary" id="supplier_id"
                                    name="supplier_id" required>
                                    <option value="">Select a supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="quantity" class="form-label text-white">Quantity</label>
                                <input type="number" class="form-control bg-dark text-white border-secondary"
                                    id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="unit_price" class="form-label text-white">Unit Price</label>
                                <input type="number" class="form-control bg-dark text-white border-secondary"
                                    id="unit_price" name="unit_price" value="{{ old('unit_price') }}" step="0.01"
                                    min="0" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="total_price" class="form-label text-white">Total Price</label>
                                <input type="number" class="form-control bg-dark text-white border-secondary"
                                    id="total_price" name="total_price" value="{{ old('total_price') }}" step="0.01"
                                    min="0" required readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="purchase_date" class="form-label text-white">Purchase Date</label>
                                <input type="date" class="form-control bg-dark text-white border-secondary"
                                    id="purchase_date" name="purchase_date"
                                    value="{{ old('purchase_date', date('Y-m-d')) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="status" class="form-label text-white">Status</label>
                                <select class="form-select bg-dark text-white border-secondary" id="status"
                                    name="status" required>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Purchase
                        </button>
                        <a href="{{ route('admin.purchases.index') }}" class="btn btn-secondary">
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
