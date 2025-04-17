<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Messages Routes
    Route::get('/messages', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [App\Http\Controllers\Admin\MessageController::class, 'show'])->name('messages.show');
    Route::patch('/messages/{message}/mark-read', [App\Http\Controllers\Admin\MessageController::class, 'markAsRead'])->name('messages.mark-read');
    Route::patch('/messages/{message}/mark-unread', [App\Http\Controllers\Admin\MessageController::class, 'markAsUnread'])->name('messages.mark-unread');
    Route::delete('/messages/{message}', [App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('messages.destroy');
});

require __DIR__.'/auth.php';
