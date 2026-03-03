<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;

use App\Http\Controllers\DeliveryDashboardController;
use App\Http\Controllers\DeliveryController;

use App\Models\Booking;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

// Static Footer Pages
Route::get('/pricing', [BikeController::class, 'pricing'])->name('pages.pricing');
Route::view('/about', 'pages.about')->name('pages.about');
Route::view('/careers', 'pages.careers')->name('pages.careers');
Route::view('/contact', 'pages.contact')->name('pages.contact');
Route::view('/privacy', 'pages.privacy')->name('pages.privacy');
Route::view('/terms', 'pages.terms')->name('pages.terms');

/*
|--------------------------------------------------------------------------
| Smart Dashboard Redirect (After Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {

    return match (auth()->user()->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'staff'    => redirect()->route('staff.dashboard'),
        'delivery' => redirect()->route('delivery.dashboard'),
        default    => redirect()->route('user.dashboard'),
    };

})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Payment (Authenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->post('/pay/{booking}', [PaymentController::class, 'store'])
    ->name('payment.store');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/reports', [ReportController::class, 'index'])
        ->name('admin.reports');
        
    Route::get('/admin/reports/export', [ReportController::class, 'export'])
        ->name('admin.reports.export');
        
    Route::get('/admin/reports/sentiments-export', [ReportController::class, 'exportSentiments'])
        ->name('admin.reports.sentiments_export');

    Route::get('/admin/bikes', [BikeController::class, 'index'])
        ->name('bikes.index');

    Route::get('/admin/bikes/create', [BikeController::class, 'create'])
        ->name('bikes.create');

    Route::post('/admin/bikes', [BikeController::class, 'store'])
        ->name('bikes.store');

    Route::get('/admin/bikes/{bike}/edit', [BikeController::class, 'edit'])
        ->name('bikes.edit');

    Route::put('/admin/bikes/{bike}', [BikeController::class, 'update'])
        ->name('bikes.update');

    Route::delete('/admin/bikes/{bike}', [BikeController::class, 'destroy'])
        ->name('bikes.destroy');

    Route::post('/admin/users', [AdminDashboard::class, 'storeUser'])
        ->name('admin.users.store');

    Route::get('/admin/users/{user}/edit', [AdminDashboard::class, 'editUser'])
        ->name('admin.users.edit');

    Route::put('/admin/users/{user}', [AdminDashboard::class, 'updateUser'])
        ->name('admin.users.update');

    Route::delete('/admin/users/{user}', [AdminDashboard::class, 'destroyUser'])
        ->name('admin.users.destroy');
});

/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::get('/staff/dashboard', [StaffDashboard::class, 'index'])
        ->name('staff.dashboard');

    Route::post('/staff/assign-delivery', [StaffDashboard::class, 'assignDelivery'])
        ->name('staff.assignDesc');

    Route::post('/staff/booking/{id}/update-price', [StaffDashboard::class, 'updatePrice'])
        ->name('staff.updatePrice');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER (USER) ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/user/dashboard', [UserDashboard::class, 'index'])
        ->name('user.dashboard');

    Route::get('/user/bookings', [BookingController::class, 'myBookings'])
        ->name('my.bookings');

    Route::get('/bikes', [BikeController::class, 'browse'])
        ->name('bikes.browse');

    Route::get('/bikes/{id}/book', [BikeController::class, 'bookingForm'])
        ->name('book.create');

    Route::post('/bikes/{id}/book', [BikeController::class, 'storeBooking'])
        ->name('book.store');

    Route::get('/booking/{id}/bill', [BookingController::class, 'generateBill'])
        ->name('booking.bill');

    Route::post('/booking/{id}/review', [BookingController::class, 'submitReview'])
        ->name('booking.review');
});

/*
|--------------------------------------------------------------------------
| DELIVERY BOY ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:delivery'])->group(function () {

    Route::get('/delivery/dashboard', [DeliveryDashboardController::class, 'index'])
        ->name('delivery.dashboard');

    Route::post('/delivery/booking/{id}/status', [DeliveryController::class, 'updateStatus'])
        ->name('delivery.updateStatus');
});

/*
|--------------------------------------------------------------------------
| Profile Routes (All Authenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
