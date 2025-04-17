<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends BaseController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->is_admin) {
                abort(403, 'Unauthorized access. Admin privileges required.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the purchases.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $purchases = Purchase::with(['product', 'supplier'])->latest()->paginate(10);
        
        // Calculate totals
        $totalPurchases = Purchase::sum('total_price');
        $pendingPurchases = Purchase::where('status', 'pending')->sum('total_price');
        $completedPurchases = Purchase::where('status', 'completed')->sum('total_price');
        $cancelledPurchases = Purchase::where('status', 'cancelled')->sum('total_price');

        return view('admin.purchases.index', compact(
            'purchases',
            'totalPurchases',
            'pendingPurchases',
            'completedPurchases',
            'cancelledPurchases'
        ));
    }

    /**
     * Show the form for creating a new purchase.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.purchases.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created purchase in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        Purchase::create($validated);

        return redirect()->route('admin.purchases.index')
            ->with('success', 'Purchase created successfully.');
    }

    /**
     * Show the form for editing the specified purchase.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\View\View
     */
    public function edit(Purchase $purchase)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.purchases.edit', compact('purchase', 'products', 'suppliers'));
    }

    /**
     * Update the specified purchase in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $purchase->update($validated);

        return redirect()->route('admin.purchases.index')
            ->with('success', 'Purchase updated successfully.');
    }

    /**
     * Remove the specified purchase from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()->route('admin.purchases.index')
            ->with('success', 'Purchase deleted successfully.');
    }

    /**
     * Display the purchase report.
     *
     * @return \Illuminate\View\View
     */
    public function report()
    {
        $purchases = Purchase::with(['product', 'supplier'])
            ->where('status', 'completed')
            ->latest()
            ->paginate(10);

        return view('admin.purchases.report', compact('purchases'));
    }
} 