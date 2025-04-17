@extends('layouts.admin')

@section('title', 'Add New Record - Haz Creatives Studio')

@section('header', 'Add New Record')

@section('content')
<style>
    /* Form styling for dark theme */
    .form-control, .form-select {
        background-color: var(--card-bg);
        border-color: var(--border-color);
        color: var(--text-primary);
    }
    
    .form-control:focus, .form-select:focus {
        background-color: var(--card-bg);
        border-color: var(--text-secondary);
        color: var(--text-primary);
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.1);
    }

    .form-control::placeholder {
        color: var(--text-muted);
    }

    .form-label {
        color: var(--text-primary);
        font-weight: 500;
    }

    .form-select option {
        background-color: var(--card-bg);
        color: var(--text-primary);
    }

    .invalid-feedback {
        color: #ff6b6b;
    }

    .btn-secondary {
        background-color: var(--card-bg);
        border-color: var(--border-color);
        color: var(--text-primary);
    }

    .btn-secondary:hover {
        background-color: var(--hover-bg);
        border-color: var(--text-secondary);
        color: var(--text-primary);
    }

    .btn-primary {
        background-color: #27a776;
        border-color: #27a776;
        color: white;
    }

    .btn-primary:hover {
        background-color: #228f64;
        border-color: #228f64;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.purchases.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="item_name" class="form-label">Item Name</label>
                                    <input type="text" 
                                           class="form-control @error('item_name') is-invalid @enderror" 
                                           id="item_name" 
                                           name="item_name" 
                                           value="{{ old('item_name') }}" 
                                           required>
                                    @error('item_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="form-label">Amount (RM)</label>
                                    <input type="number" 
                                           class="form-control @error('amount') is-invalid @enderror" 
                                           id="amount" 
                                           name="amount" 
                                           value="{{ old('amount') }}" 
                                           step="0.01" 
                                           required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" 
                                            name="type" 
                                            required>
                                        <option value="">Select Type</option>
                                        <option value="income" {{ old('type') === 'income' ? 'selected' : '' }}>Income</option>
                                        <option value="expense" {{ old('type') === 'expense' ? 'selected' : '' }}>Expense</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purchase_date" class="form-label">Purchase Date</label>
                                    <input type="date" 
                                           class="form-control @error('purchase_date') is-invalid @enderror" 
                                           id="purchase_date" 
                                           name="purchase_date" 
                                           value="{{ old('purchase_date', date('Y-m-d')) }}" 
                                           required>
                                    @error('purchase_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice_number" class="form-label">Invoice Number</label>
                                    <input type="text" 
                                           class="form-control @error('invoice_number') is-invalid @enderror" 
                                           id="invoice_number" 
                                           name="invoice_number" 
                                           value="{{ old('invoice_number') }}">
                                    @error('invoice_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplier" class="form-label">Supplier</label>
                                    <input type="text" 
                                           class="form-control @error('supplier') is-invalid @enderror" 
                                           id="supplier" 
                                           name="supplier" 
                                           value="{{ old('supplier') }}">
                                    @error('supplier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="assigned_to" class="form-label">Assign To</label>
                                    <select class="form-select @error('assigned_to') is-invalid @enderror" 
                                            id="assigned_to" 
                                            name="assigned_to">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('assigned_to')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status">
                                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" 
                                      name="notes" 
                                      rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.purchases.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 