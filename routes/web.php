<?php

use App\Http\Controllers\backend\AdvertisementController;
use App\Http\Controllers\backend\ContactUsController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\ProfileController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\LikeController;
use App\Http\Controllers\customauth\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/{lang?}', function () {
//     return view('frontend.home');
// });

// test routes starts
// Route::get('certificate', [HomeController::class, 'Certificate']);  
//  Route::get('ads', [HomeController::class, 'adsTest']);
  // Route::get('reminder', [AdvertisementController::class, 'reminderTest']);
  // Route::get('blocktest', [HomeController::class, 'blockUserMail']);
  //  Route::get('adsreminder', [HomeController::class, 'adsReminder']);
    // Route::get('adsstart', [HomeController::class, 'startAds']);
    // Route::get('reject-post', [HomeController::class, 'rejectPost']);
 
  
// test routes end

Route::get('/', [HomeController::class, 'index'])->name('frontend.home.index');
Route::get('set-lang', [HomeController::class, 'setLang'])->name('frontend.home.set_lang'); 

  // like and heart start
  Route::post('like', [LikeController::class, 'Like'])->name('action.like');
  Route::post('heart', [LikeController::class, 'Heart'])->name('action.heart');
  // like and heart end

  //certificate for frontend start
  Route::get('/certificates', [UserController::class, 'Certificates'])->name('frontend.certificates');
  Route::post('/search-certificates', [UserController::class, 'SearchCertificates'])->name('frontend.search-certificates');
  //certificate for frontend end

// send advertisement form enquiry start
  Route::post('/advertisement-enquiry', [AdvertisementController::class, 'advertisementEnquiry'])->name('advertisement.enquiry');
// send advertisement form enquiry end

// send contact us enquiry start
Route::post('/contact-us-enquiry', [ContactUsController::class, 'contactusEnquiry'])->name('contact_us.enquiry');
Route::get('/reload-captcha', [ContactUsController::class, 'reloadCaptcha'])->name('reload_captcha');
// send contact us enquiry end


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/froentend.php';
require __DIR__.'/frontend.php';
require __DIR__.'/auth.php';
require __DIR__.'/backend.php';




