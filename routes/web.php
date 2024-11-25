<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', [ProfileController::class, 'homepage'])->name('homepage');

Route::get('/fetch-municipalities', [RegisteredUserController::class, 'fetchMunicipalities'])->name('fetch.municipalities');
Route::get('/fetch-barangays', [RegisteredUserController::class, 'fetchBarangays'])->name('fetch.barangays');

//User Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/image', [ImageController::class, 'updateImage'])->name('profile.update.image');
    Route::post('/ai/image', [ImageController::class, 'generateImage'])->name('profile.ai.image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [ProfileController::class, 'dashboardHomeowner'])->name('dashboard');

    //Bookings
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.page');
    Route::get('/submit/booking', [BookingController::class, 'showBookingLists'])->name('submit.booking');
    Route::put('/update/booking/{id}', [BookingController::class, 'updateBooking'])->name('booking.update');
    Route::get('/available/personnel', [BookingController::class, 'AvailablePersonnel'])->name('available.personnel');
    Route::patch('/booking/gcash/{booking}', [BookingController::class, 'gcashPicture'])->name('booking.gcash');
    Route::post('/booking/rating', [RatingController::class, 'saveRating'])->name('booking.rating');
    Route::patch('/cancel/booking/{id}', [BookingController::class, 'cancelBooking'])->name('cancel.booking.status');
    Route::get('/submit/booking/searchForm', [FilterController::class, 'searchBooking'])->name('booking.search');
    Route::get('/submit/booking/searchFormPrint', [FilterController::class, 'searchBookingUserReport'])->name('booking.searchPrint');
    Route::get('/submit/booking/searchFormPrintCount', [FilterController::class, 'searchBookingCountReport'])->name('booking.searchPrintCount');
    Route::get('/available/personnel/search', [FilterController::class, 'searchPersonnel'])->name('available.search');
    Route::post('/filter/personnel', [FilterController::class, 'filterPersonnel'])->name('filter.personnel');
    Route::post('/filter/booking', [FilterController::class, 'filterBooking'])->name('filter.booking');

    Route::get('/booking/print/{id}', [ReportController::class, 'generateUserReport'])->name('booking.print');

    Route::get('/homeowner/fetch-municipalities', [ProfileController::class, 'fetchMunicipalities'])->name('home.fetch.municipalities');
    Route::get('/homeowner/fetch-barangays', [ProfileController::class, 'fetchBarangays'])->name('home.fetch.barangays');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/profile', [ProfileController::class, 'editAdmin'])->name('admin.profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroyAdmin'])->name('admin.profile.destroy');

    Route::get('admin/dashboard', [ProfileController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/chart-data', [AdminController::class, 'getChartDataAdmin'])->name('admin.chart.data');
    Route::get('admin/chart-booking', [AdminController::class, 'getChartDataBooking'])->name('admin.chart.booking');
    Route::get('admin/User', [AdminController::class, 'showUser'])->name('admin.user');
    Route::get('admin/UserPrint', [AdminController::class, 'showUserPrint'])->name('admin.userPrint');
    Route::get('admin/personnelPrint', [AdminController::class, 'showPersonnelPrint'])->name('admin.personnelPrint');
    Route::get('admin/personnel', [AdminController::class, 'showPersonnel'])->name('admin.personnel');
    Route::get('admin/booking', [AdminController::class, 'showBooking'])->name('admin.booking');
    Route::get('admin/bookingPrint', [AdminController::class, 'showBookingPrint'])->name('admin.bookingPrint');

    Route::patch('admin/verify-personnel/{personnel}', [AdminController::class, 'verifyPersonnel'])->name('verifyPersonnel');
    Route::post('admin/users/store', [AdminController::class, 'storeUser'])->name('store.user');
    Route::post('admin/personnel/store', [AdminController::class, 'storePersonnel'])->name('store.personnel');
    Route::put('admin/users/{id}', [AdminController::class, 'updateUser'])->name('update.user');
    Route::put('admin/personnel/{id}', [AdminController::class, 'updatePersonnel'])->name('update.personnel');

    Route::post('admin/generate-pdf', [ReportController::class, 'generatePDFUser'])->name('generate.pdfUsers');
    Route::post('admin/generate-pdfpersonnel', [ReportController::class, 'generatePDFPersonnel'])->name('generate.pdfPersonnel');
    Route::post('admin/generate-pdf-all-personnel', [ReportController::class, 'generatePDFAllPersonnel'])->name('generate.pdf.personnelAll');
    Route::post('admin/generate-pdf-booking', [ReportController::class, 'generatePDFBooking'])->name('generate.pdfBooking');
    Route::post('admin/generate-pdf-all-booking', [ReportController::class, 'generatePDFAllBooking'])->name('generate.pdf.bookingAll');

    Route::get('admin/submit/user/searchForm', [FilterController::class, 'searchUserAdmin'])->name('searchUserAdmin');
    Route::get('admin/submit/user/searchFormPrint', [FilterController::class, 'searchUserAdminPrint'])->name('searchUserAdminPrint');
    Route::get('admin/submit/personnel/searchForm', [FilterController::class, 'searchPersonnelAdmin'])->name('searchPersonnelAdmin');
    Route::get('admin/submit/personnel/searchFormPrint', [FilterController::class, 'searchPersonnelAdmin'])->name('searchPersonnelAdminPrint');
    Route::get('admin/submit/booking/searchForm', [FilterController::class, 'searchBookingAdmin'])->name('searchBookingAdmin');

    Route::post('admin/filter/booking', [FilterController::class, 'filterBookingAdmin'])->name('filterBookingAdmin');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';



Route::get('/personnel/dashboard', function () {
    return view('personnel.dashboard');
})->middleware(['auth:personnel', 'verified'])->name('personnel.dashboard');


Route::middleware('auth:personnel')->group(function () {
    Route::get('personnel/profile', [ProfileController::class, 'editPersonnel'])->name('personnel.profile.edit');
    Route::patch('personnel/profile', [ProfileController::class, 'updatePersonnel'])->name('personnel.profile.update');
    Route::delete('personnel/profile', [ProfileController::class, 'destroyPersonnel'])->name('personnel.profile.destroy');

    Route::get('personnel/dashboard', [ProfileController::class, 'dashboardPersonnel'])->name('personnel.dashboard');
    Route::get('personnel/bookingPersonnel', [PersonnelController::class, 'showBooking'])->name('show.bookingPersonnel');
    Route::post('personnel/bookings/{id}/update-status', [PersonnelController::class, 'updateBookingStatus'])->name('bookings.update-status');
    Route::post('/personnel/bookings/{id}/reject', [PersonnelController::class, 'rejectBooking'])->name('bookings.reject');
    Route::post('personnel/bookings/{bookingId}/addextrafee', [BookingController::class, 'addExtraFee'])->name('bookings.extra-fee');
    Route::post('personnel/uploadId', [PersonnelController::class, 'uploadIdPicture'])->name('upload.id.picture');
    Route::post('/upload-nbi-clearance', [PersonnelController::class, 'uploadNbiClearance'])->name('upload.nbi.clearance');

    Route::get('personnel/UserPrintPersonnelUser', [PersonnelController::class, 'showBookingPrintPersonnelUser'])->name('personnel.bookingPrintPersonnelUser');
    Route::get('personnel/bookingPrintPersonnelEarning', [PersonnelController::class, 'showPersonnelEarningPrint'])->name('personnel.bookingPrintPersonnelEarning');
    Route::get('personnel/bookingPrintPersonnel', [PersonnelController::class, 'showPersonnelBookingPrint'])->name('personnel.bookingPrintPersonnel');
    Route::post('personnel/generate-pdf', [ReportController::class, 'generatePDFBookingPersonnel'])->name('generate.pdfPersonnelBooking');
    Route::post('personnel/generate-pdf-booking-earningPersonnel', [ReportController::class, 'generatePDFBookingPersonnelEarning'])->name('generate.pdfBookingPersonnelEarning');
    Route::get('personnel/submit/booking/searchForm', [FilterController::class, 'searchBookingPersonnel'])->name('booking.searchPersonnel');
    Route::get('personnel/submit/booking/searchForms', [FilterController::class, 'searchBookingPersonnels'])->name('booking.searchPersonnels');
    Route::post('personnel/filter/booking', [FilterController::class, 'filterBookingPersonnel'])->name('filter.bookingPersonnel');
    Route::post('personnel/filter/bookings', [FilterController::class, 'filterBookingPersonnels'])->name('filter.bookingPersonnels');
    Route::get('personnel/submit/booking/searchFormPrint', [FilterController::class, 'searchBookingPersonnelPrint'])->name('booking.searchPersonnelPrint');
    Route::post('personnel/filter/bookingPrint', [FilterController::class, 'filterBookingPersonnelPrint'])->name('filter.bookingPersonnelPrint');
});

require __DIR__ . '/personnelAuth.php';


//End User

//End Admin
