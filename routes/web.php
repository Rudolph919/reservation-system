<?php

use Inertia\Inertia;
use App\Models\Booking;
use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AddOnController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ResourceTypeController;
use App\Http\Controllers\BookingStatusController;
use App\Http\Controllers\AvailabilityStatusController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [LandingPageController::class, 'home'])->name('home');
Route::get('/about', [LandingPageController::class, 'about'])->name('about');
Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact');





Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard',[
            'bookingCount' => Booking::count(),
            'resourceCount' => Resource::count(),
        ]);
    })->name('dashboard');

    Route::resource('/availability-status', AvailabilityStatusController::class);
    Route::resource('/resource-type', ResourceTypeController::class);
    Route::resource('/booking-status', BookingStatusController::class);
    Route::resource('/add-on', AddOnController::class);
    Route::resource('/resource', ResourceController::class);
    Route::resource('/booking', BookingController::class);
    Route::get('/booking/search', [BookingController::class, 'search'])->name('booking.search');
    Route::post('/booking/searchBookings', [BookingController::class, 'searchBookings'])->name('booking.searchBookings');



});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
