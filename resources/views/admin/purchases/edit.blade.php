@extends('layouts.admin')

@section('title', 'Edit Purchase')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-white">Edit Purchase</h1>

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
                <i class="fas fa-edit me-1 text-white"></i>
                <span class="text-white">Purchase Details</span>
            </div>
            <div class="card-body bg-dark">
                <form action="{{ route('admin.purchases.update', $purchase->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Hidden fields for required IDs --}}
                    <input type="hidden" name="product_id" value="{{ $purchase->product_id }}">
                    <input type="hidden" name="supplier_id" value="{{ $purchase->supplier_id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="category" class="form-label text-white">Category</label>
                                <select class="form-select bg-dark text-white border-secondary" id="category"
                                    name="category" required>
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}"
                                            {{ old('category', $purchase->product->category) == $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                    <option value="new">+ Add New Category</option>
                                </select>
                                <div id="newCategoryInput" class="mt-2" style="display: none;">
                                    <input type="text" class="form-control bg-dark text-white border-secondary"
                                        id="new_category" name="new_category" placeholder="Enter new category name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="product_name" class="form-label text-white">Product</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary"
                                    id="product_name" name="product_name"
                                    value="{{ old('product_name', $purchase->product->name) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="brand_model" class="form-label text-white">Brand/Model</label>
                                <select class="form-select bg-dark text-white border-secondary" id="brand_model"
                                    name="brand_model" required>
                                    <option value="">Select a brand/model</option>
                                    @foreach ($brandModels as $brandModel)
                                        <option value="{{ $brandModel }}"
                                            {{ old('brand_model', $purchase->product->brand_model) == $brandModel ? 'selected' : '' }}>
                                            {{ $brandModel }}
                                        </option>
                                    @endforeach
                                    <option value="new">+ Add New Brand/Model</option>
                                </select>
                                <div id="newBrandModelInput" class="mt-2" style="display: none;">
                                    <input type="text" class="form-control bg-dark text-white border-secondary"
                                        id="new_brand_model" name="new_brand_model"
                                        placeholder="Enter new brand/model name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="serial_number" class="form-label text-white">Serial Number</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary"
                                    id="serial_number" name="serial_number"
                                    value="{{ old('serial_number', $purchase->product->serial_number) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="supplier_name" class="form-label text-white">Supplier</label>
                                <select class="form-select bg-dark text-white border-secondary" id="supplier_name"
                                    name="supplier_name" required>
                                    <option value="">Select a supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier }}"
                                            {{ old('supplier_name', $purchase->supplier->name) == $supplier ? 'selected' : '' }}>
                                            {{ $supplier }}
                                        </option>
                                    @endforeach
                                    <option value="new">+ Add New Supplier</option>
                                </select>
                                <div id="newSupplierInput" class="mt-2" style="display: none;">
                                    <input type="text" class="form-control bg-dark text-white border-secondary"
                                        id="new_supplier" name="new_supplier" placeholder="Enter new supplier name">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="quantity" class="form-label text-white">Quantity</label>
                                <input type="number" class="form-control bg-dark text-white border-secondary"
                                    id="quantity" name="quantity" value="{{ old('quantity', $purchase->quantity) }}"
                                    min="1" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="unit_price" class="form-label text-white">Unit Price</label>
                                <input type="number" class="form-control bg-dark text-white border-secondary"
                                    id="unit_price" name="unit_price"
                                    value="{{ old('unit_price', $purchase->unit_price) }}" step="0.01" min="0"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="total_price" class="form-label text-white">Total Price</label>
                                <input type="number" class="form-control bg-dark text-white border-secondary"
                                    id="total_price" name="total_price"
                                    value="{{ old('total_price', $purchase->total_price) }}" step="0.01"
                                    min="0" required readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="purchase_date" class="form-label text-white">Purchase Date</label>
                                <input type="date" class="form-control bg-dark text-white border-secondary"
                                    id="purchase_date" name="purchase_date"
                                    value="{{ old('purchase_date', $purchase->purchase_date->format('Y-m-d')) }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="status" class="form-label text-white">Status</label>
                                <select class="form-select bg-dark text-white border-secondary" id="status"
                                    name="status" required>
                                    <option value="pending"
                                        {{ old('status', $purchase->status) == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="completed"
                                        {{ old('status', $purchase->status) == 'completed' ? 'selected' : '' }}>Completed
                                    </option>
                                    <option value="cancelled"
                                        {{ old('status', $purchase->status) == 'cancelled' ? 'selected' : '' }}>Cancelled
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Purchase
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
                const categorySelect = document.getElementById('category');
                const newCategoryInput = document.getElementById('newCategoryInput');
                const brandModelSelect = document.getElementById('brand_model');
                const newBrandModelInput = document.getElementById('newBrandModelInput');
                const supplierSelect = document.getElementById('supplier_name');
                const newSupplierInput = document.getElementById('newSupplierInput');

                function calculateTotal() {
                    const quantity = parseFloat(quantityInput.value) || 0;
                    const unitPrice = parseFloat(unitPriceInput.value) || 0;
                    totalPriceInput.value = (quantity * unitPrice).toFixed(2);
                }

                function handleCategoryChange() {
                    if (categorySelect.value === 'new') {
                        newCategoryInput.style.display = 'block';
                        categorySelect.required = false;
                        document.getElementById('new_category').required = true;
                    } else {
                        newCategoryInput.style.display = 'none';
                        categorySelect.required = true;
                        document.getElementById('new_category').required = false;
                    }
                }

                function handleBrandModelChange() {
                    if (brandModelSelect.value === 'new') {
                        newBrandModelInput.style.display = 'block';
                        brandModelSelect.required = false;
                        document.getElementById('new_brand_model').required = true;
                    } else {
                        newBrandModelInput.style.display = 'none';
                        brandModelSelect.required = true;
                        document.getElementById('new_brand_model').required = false;
                    }
                }

                function handleSupplierChange() {
                    if (supplierSelect.value === 'new') {
                        newSupplierInput.style.display = 'block';
                        supplierSelect.required = false;
                        document.getElementById('new_supplier').required = true;
                    } else {
                        newSupplierInput.style.display = 'none';
                        supplierSelect.required = true;
                        document.getElementById('new_supplier').required = false;
                    }
                }

                quantityInput.addEventListener('input', calculateTotal);
                unitPriceInput.addEventListener('input', calculateTotal);
                categorySelect.addEventListener('change', handleCategoryChange);
                brandModelSelect.addEventListener('change', handleBrandModelChange);
                supplierSelect.addEventListener('change', handleSupplierChange);

                // Initialize input visibility
                handleCategoryChange();
                handleBrandModelChange();
                handleSupplierChange();

                // Calculate initial total
                calculateTotal();
            });
        </script>
    @endpush
@endsection
