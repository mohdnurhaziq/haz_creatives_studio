<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('assignedUser')
            ->latest()
            ->paginate(10);

        $totalIncome = Purchase::income()->sum('amount');
        $totalExpense = Purchase::expense()->sum('amount');
        $netAmount = $totalIncome - $totalExpense;

        return view('admin.purchases.index', compact('purchases', 'totalIncome', 'totalExpense', 'netAmount'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.purchases.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'purchase_date' => 'required|date',
            'invoice_number' => 'nullable|string|max:255',
            'supplier' => 'nullable|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
            'notes' => 'nullable|string'
        ]);

        Purchase::create($validated);

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Purchase record created successfully.');
    }

    public function edit(Purchase $purchase)
    {
        $users = User::all();
        return view('admin.purchases.edit', compact('purchase', 'users'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'purchase_date' => 'required|date',
            'invoice_number' => 'nullable|string|max:255',
            'supplier' => 'nullable|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
            'notes' => 'nullable|string'
        ]);

        $purchase->update($validated);

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Purchase record updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Purchase record deleted successfully.');
    }

    public function report()
    {
        $monthlyStats = Purchase::selectRaw('
            YEAR(purchase_date) as year,
            MONTH(purchase_date) as month,
            SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as total_income,
            SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as total_expense,
            SUM(CASE WHEN type = "income" THEN amount ELSE -amount END) as net_amount
        ')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        return view('admin.purchases.report', compact('monthlyStats'));
    }
} 