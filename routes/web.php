<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Public routes (geen auth vereist)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');
        
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    
    // Student specific routes
    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.my');
    
    // Student course routes
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::delete('/courses/{course}/unenroll', [CourseController::class, 'unenroll'])->name('courses.unenroll');
    Route::get('/courses/{course}/track', [CourseController::class, 'track'])->name('courses.track');
});

// Admin routes
Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::patch('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('users.toggle');
    
    // Course management
    Route::get('/courses', [CourseController::class, 'adminIndex'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    
    // News management
    Route::get('/news', [NewsController::class, 'adminIndex'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'adminCreate'])->name('news.create');
    Route::post('/news', [NewsController::class, 'adminStore'])->name('news.store');
    Route::get('/news/{news}/edit', [NewsController::class, 'adminEdit'])->name('news.edit');
    Route::patch('/news/{news}', [NewsController::class, 'adminUpdate'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'adminDestroy'])->name('news.destroy');
    
    // FAQ management
    Route::get('/faq', [FaqController::class, 'adminIndex'])->name('faq.index');
    Route::get('/faq/create', [FaqController::class, 'adminCreate'])->name('faq.create');
    Route::post('/faq', [FaqController::class, 'adminStore'])->name('faq.store');
    Route::get('/faq/{faq}/edit', [FaqController::class, 'adminEdit'])->name('faq.edit');
    Route::patch('/faq/{faq}', [FaqController::class, 'adminUpdate'])->name('faq.update');
    Route::delete('/faq/{faq}', [FaqController::class, 'adminDestroy'])->name('faq.destroy');
    
    // Contact messages management
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
});

require __DIR__.'/auth.php';