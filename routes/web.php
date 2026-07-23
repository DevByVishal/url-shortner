<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function () {

    Route::get('/', [LoginController::class, 'index'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])
        ->name('login.authenticate');
});

Route::middleware('auth')->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['auth','role:SuperAdmin'])->prefix('companies')->name('companies.')->group(function () {
         Route::get('/', [CompanyController::class, 'index'])
            ->name('index');

        Route::get('/create', [CompanyController::class, 'create'])
            ->name('create');

        Route::post('/', [CompanyController::class, 'store'])
            ->name('store');

        Route::get('/{company}/edit', [CompanyController::class, 'edit'])
            ->name('edit');

        Route::put('/{company}', [CompanyController::class, 'update'])
            ->name('update');

        Route::delete('/{company}', [CompanyController::class, 'destroy'])
            ->name('destroy');
    });

    Route::prefix('invitations')->name('invitations.')->group(function () {

        Route::get('/', [InvitationController::class,'index'])->name('index');

        Route::get('/create', [InvitationController::class,'create'])->name('create');

        Route::post('/', [InvitationController::class,'store'])->name('store');

        Route::delete('/{invitation}', [InvitationController::class,'destroy'])->name('destroy');

    });

    Route::middleware(['auth','permission:invite.create'])->group(function () {
        Route::post('/invitations',[InvitationController::class, 'store'])->name('invitations.store');
    });
    

    Route::middleware(['auth','permission:short-url.create'])->group(function () {
        Route::post('/short-urls',[ShortUrlController::class, 'store'])->name('short-urls.store');
    });

    // Short URL list
    Route::get('/short-urls', [ShortUrlController::class, 'index'])
        ->name('short-urls.index');

    // Create Short URL
    Route::get('/short-urls/create', [ShortUrlController::class, 'create'])
        ->name('short-urls.create');

    // Store Short URL
    Route::post('/short-urls', [ShortUrlController::class, 'store'])
        ->name('short-urls.store');

    Route::get('/short-urls/{shortUrl}', [ShortUrlController::class, 'show'])
    ->name('short-urls.show');

    Route::middleware(['role:SuperAdmin|Admin'])->group(function () {
        // User List
        Route::get('/team-members', [UserController::class, 'index'])->name('users.index');
    });
    
    // Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('invitations')->name('invitations.')->group(function () {
        Route::get('/accept/{token}',[InvitationController::class,'accept'])->name('accept');

        Route::post('/accept/{token}',[InvitationController::class, 'acceptStore'])->name('accept.store');

        Route::middleware('auth')->group(function () {

            Route::get('/',[InvitationController::class,'index'])->name('index');

            Route::get('/create',[InvitationController::class,'create'])->name('create');

            Route::post('/',[InvitationController::class,'store'])->name('store');

        });

    });

Route::get('/s/{short_code}', [ShortUrlController::class, 'redirect'])->name('short-urls.redirect');
