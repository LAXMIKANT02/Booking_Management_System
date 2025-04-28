<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController; // Ensure this class exists in the specified namespace or create it if missing
use App\Http\Controllers\WebpageController;
use Illuminate\Support\Facades\Route;

Route::post('/book-now', [BookingController::class, 'store'])->name('book.now');
// Webpage Routes
Route::get('/', [WebpageController::class, 'landing'])->name('webpage.landing');
Route::get('page/{name}', [WebpageController::class, 'viewPage'])->name('webpage.dynamic');

// Authentication Routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('signup', [AuthController::class, 'signup'])->name('signup');
Route::post('signup', [AuthController::class, 'createUser'])->name('signup.create');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Routes requiring authentication
Route::middleware(['auth'])->group(function () {
  Route::middleware(['auth', 'admin'])->get('dashboard/admin', [UserController::class, 'adminDashboard'])->name('dashboard.admin');

    // Removed {id} from dashboard/user route
    Route::get('dashboard/user', [UserController::class, 'userDashboard'])->name('dashboard.user'); 

    Route::get('bookings/my', [BookingController::class, 'userBookings'])->name('bookings.my');
Route::get('bookings/add', [BookingController::class, 'add'])->name('bookings.add');
Route::post('bookings/save', [BookingController::class, 'save'])->name('bookings.save');
Route::get('bookings/all', [BookingController::class, 'index'])->name('bookings.all');
Route::get('bookings/{id}', [BookingController::class, 'getBookingById'])->name('bookings.edit');
Route::post('bookings/update/{id}', [BookingController::class, 'updateBookingById'])->name('bookings.update');
Route::get('bookings/view/{id}', [BookingController::class, 'viewBooking'])->name('bookings.view');
Route::delete('bookings/delete/{id}', [BookingController::class, 'delete'])->name('bookings.delete');

    // Webpage Routes
    Route::get('webpage', [WebpageController::class, 'index'])->name('webpage.index');
    Route::get('webpage/add', [WebpageController::class, 'add'])->name('webpage.add');
    Route::post('webpage/save', [WebpageController::class, 'save'])->name('webpage.save');
    Route::get('webpage/{id}', [WebpageController::class, 'getWebPageById'])->name('webpage.edit');
    Route::post('webpage/update/{id}', [WebpageController::class, 'updateWebPageById'])->name('webpage.update');
    Route::get('webpage/view/{id}', [WebpageController::class, 'viewWebPage'])->name('webpage.view');
    Route::post('webpage/delete/{id}', [WebpageController::class, 'delete'])->name('webpage.delete');

    // User Management Routes
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/add', [UserController::class, 'add'])->name('user.add');
    Route::post('user/save', [UserController::class, 'save'])->name('user.save');
    Route::get('user/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('user/view/{id}', [UserController::class, 'viewDelete'])->name('user.view');
    Route::post('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    // User Profile Routes
    Route::get('user/profile', [UserController::class, 'getProfile'])->name('user.profile.get');
    Route::post('user/profile', [UserController::class, 'saveProfile'])->name('user.profile.save');
});
