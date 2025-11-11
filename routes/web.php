<?php

use App\Http\Controllers\HomeStandardController;
use App\Http\Controllers\HomeAdvanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login.index');
})->name('home');

// Auth Routes
Route::get('/signup', [SignupController::class, 'index'])->name('signup.index');
Route::post('/signup/auth', [SignupController::class, 'signup'])->name('signup.auth');

Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/testimonial', function () {
    $testimonials = [
        [
            'name' => 'Ahmad Rizki',
            'position' => 'Freelancer',
            'content' => 'Fintrack membantu saya mengelola keuangan dengan sangat baik. Interface yang sederhana namun powerful.',
            'rating' => 5
        ],
        [
            'name' => 'Sari Dewi',
            'position' => 'Business Owner',
            'content' => 'Sebagai pemilik bisnis, Fintrack memberikan insight yang valuable untuk pengambilan keputusan.',
            'rating' => 5
        ],
        [
            'name' => 'Budi Santoso',
            'position' => 'Karyawan',
            'content' => 'Aplikasi yang sangat membantu untuk perencanaan keuangan pribadi dan keluarga.',
            'rating' => 4
        ]
    ];
    return view('pages.testimonial', compact('testimonials'));
})->name('testimonial');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/features', function () {
    $features = [
        [
            'icon' => '📊',
            'title' => 'Analisis Keuangan',
            'description' => 'Analisis mendalam tentang pengeluaran dan pemasukan Anda dengan grafik interaktif.'
        ],
        [
            'icon' => '🎯',
            'title' => 'Prioritas Eisenhower',
            'description' => 'Kelompokkan pengeluaran berdasarkan tingkat urgensi dan kepentingannya.'
        ],
        [
            'icon' => '💾',
            'title' => 'Backup Data',
            'description' => 'Simpan dan amankan data keuangan Anda dengan sistem backup otomatis.'
        ],
        [
            'icon' => '📈',
            'title' => 'Laporan Bulanan',
            'description' => 'Dapatkan laporan keuangan bulanan yang detail dan mudah dipahami.'
        ]
    ];
    return view('pages.features', compact('features'));
})->name('features');

Route::get('/home-standard', [HomeStandardController::class, 'index'])->name('home.standard');
Route::get('/home-advance', [HomeAdvanceController::class, 'index'])->name('home.advance');

// CRUD Sales Routes
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create');
Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
Route::get('/sales/{id}/edit', [SalesController::class, 'edit'])->name('sales.edit');
Route::put('/sales/{id}', [SalesController::class, 'update'])->name('sales.update');
Route::delete('/sales/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');

// Logout
Route::post('/logout', function () {
    session()->flush();
    return redirect()->route('login.index')->with('success', 'Logout berhasil!');
})->name('logout');

Route::get('/users', [UserController::class, 'index'])->name('pages.users.index');
