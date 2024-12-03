<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestEstablishmentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\OwnerEstablishmentController;
use App\Http\Controllers\OwnerGalleryController;
use App\Http\Controllers\NewsEventController;
use App\Http\Controllers\RequestController;

// New Routes
Route::middleware('guest')->group(function () {
  // Route::get('/', fn() => view('welcome'))->name('root');
  Route::get('/history', fn() => view('history'))->name('history');
  Route::get('/officials', fn() => view('officials'))->name('officials');
  Route::get('/news-and-events', [NewsEventController::class, 'index'])->name('news-events');
  Route::get('/news-and-events/{type}/{id}', [NewsEventController::class, 'view'])->name('news-events-view');
  Route::get('/destinations/{type}', [GuestEstablishmentController::class, 'index'])->name('guests.destinations.index');
  Route::get('/destinations/{type}/{id}', [GuestEstablishmentController::class, 'view'])->name('guests.destinations.show');
  Route::get('/apply', [GuestEstablishmentController::class, 'apply'])->name('apply');
  Route::get('/', [GuestEstablishmentController::class, 'welcome'])->name('root');
  Route::post('/apply', [GuestEstablishmentController::class, 'store'])->name('apply.store');

  Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/forgot-password', 'forgotPassword')->name('password.request');
    Route::post('/forgot-password', 'forgotPasswordEvent')->name('password.email');
    Route::get('/reset-password/{token}', 'passwordResetForm')->name('password.reset');
    Route::post('/reset-password', 'passwordUpdate')->name('password.update');
  });
});


Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



  Route::middleware('role:admin')->group(function () {
    Route::resource('accounts', AccountController::class);
    Route::resource('establishments', EstablishmentController::class);
    Route::resource('requests', RequestController::class);
    Route::resource('business-types', BusinessTypeController::class);
    Route::resource('events', EventController::class);
    Route::resource('offerings', OfferingController::class);
    Route::resource('news', NewsController::class);

    // Route::get('requests', [EstablishmentController::class, 'requests'])->name('requests');
    Route::get('/requests/{request}', [RequestController::class, 'show'])->name('requests.show');
  });

  Route::middleware('role:owner')->group(function () {
    Route::get('/my-establishment', [OwnerEstablishmentController::class, 'index'])->name('owners.establishment-index');
    Route::post('/my-establishment', [OwnerEstablishmentController::class, 'update'])->name('owners.establishment-update');

    Route::get('/offers', [OfferController::class, 'index'])->name('owners.establishment-offers');
    Route::post('/offers', [OfferController::class, 'store'])->name('owners.establishment-offers-store');

    Route::get('/my-galleries', [OwnerGalleryController::class, 'index'])->name('owners.establishment-galleries');
    Route::post('/my-galleries', [OwnerGalleryController::class, 'store']);
  });
});
