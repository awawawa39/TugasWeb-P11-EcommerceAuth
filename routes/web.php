<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================================
// Route yang butuh login (auth)
// ============================================
Route::middleware('auth')->group(function () {

    // Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ============================================
    // CRUD Post — semua user login boleh akses
    // (tapi policy yang tentukan bisa edit/hapus atau tidak)
    // ============================================
    Route::resource('posts', PostController::class);

    // ============================================
    // Route khusus admin & editor
    // ============================================
    Route::middleware('role:admin,editor')->group(function () {
        Route::get('/manage', function () {
            return 'Halaman manage untuk admin & editor';
        })->name('manage');
    });

    // ============================================
    // Route khusus admin
    // ============================================
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/users', function () {
            return 'Halaman ini hanya untuk admin.';
        })->name('admin.users');
    });
});

require __DIR__.'/auth.php';