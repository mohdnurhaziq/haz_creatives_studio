<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/gallery', function () {
    return view('pages.gallery');
})->name('gallery');

Route::get('/services', function () {
    return view('pages.services');
})->name('services');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Auth Routes
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Test route for middleware
Route::get('/test-admin', function () {
    return 'Middleware working!';
})->middleware(['auth', 'admin']);

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', function () {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }
        return view('admin.dashboard');
    })->name('dashboard');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::patch('/messages/{message}/mark-read', [MessageController::class, 'markAsRead'])->name('messages.mark-read');
    Route::patch('/messages/{message}/mark-unread', [MessageController::class, 'markAsUnread'])->name('messages.mark-unread');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Purchases
    Route::get('/purchases/report', [PurchaseController::class, 'report'])->name('purchases.report');
    Route::resource('purchases', PurchaseController::class)->names([
        'index' => 'purchases.index',
        'show' => 'purchases.show',
        'create' => 'purchases.create',
        'store' => 'purchases.store',
        'edit' => 'purchases.edit',
        'update' => 'purchases.update',
        'destroy' => 'purchases.destroy',
    ]);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
