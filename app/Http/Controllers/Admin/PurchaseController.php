<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $categories = Category::pluck('name')->toArray();
        $brandModels = Product::distinct()->pluck('brand_model')->filter()->toArray();
        $suppliers = Supplier::pluck('name')->toArray();

        return view('admin.purchases.create', compact('categories', 'brandModels', 'suppliers'));
    }

    /**
     * Store a newly created purchase in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            // Handle category
            $category = $request->input('category');
            if ($request->input('category') === 'new') {
                $category = $request->input('new_category');
            }

            // Handle brand/model
            $brandModel = $request->input('brand_model');
            if ($request->input('brand_model') === 'new') {
                $brandModel = $request->input('new_brand_model');
            }

            // Handle supplier
            $supplierName = $request->input('supplier_name');
            if ($request->input('supplier_name') === 'new') {
                $supplierName = $request->input('new_supplier');
            }

            // Create or find supplier
            $supplier = Supplier::firstOrCreate(
                ['name' => $supplierName]
            );

            // Create or find product
            $product = Product::firstOrCreate(
                ['serial_number' => $request->input('serial_number')],
                [
                    'name' => $request->input('product_name'),
                    'price' => $request->input('unit_price'),
                    'category' => $category,
                    'brand_model' => $brandModel,
                    'serial_number' => $request->input('serial_number')
                ]
            );

            // Create purchase
            $purchase = Purchase::create([
                'product_id' => $product->id,
                'supplier_id' => $supplier->id,
                'quantity' => $request->input('quantity'),
                'unit_price' => $request->input('unit_price'),
                'total_price' => $request->input('total_price'),
                'purchase_date' => $request->input('purchase_date'),
                'status' => $request->input('status'),
            ]);

            return redirect()->route('admin.purchases.index')
                ->with('success', 'Purchase created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating purchase: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to create purchase. Please try again.')
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified purchase.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\View\View
     */
    public function edit(Purchase $purchase)
    {
        $categories = Category::pluck('name')->toArray();
        $brandModels = Product::distinct()->pluck('brand_model')->filter()->toArray();
        $suppliers = Supplier::pluck('name')->toArray();

        return view('admin.purchases.edit', compact('purchase', 'categories', 'brandModels', 'suppliers'));
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
