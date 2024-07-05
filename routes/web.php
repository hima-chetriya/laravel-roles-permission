<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMSController;
// use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-logout', [AuthenticatedSessionController::class, 'logout'])->name('userlogout');
    Route::get('change-password',[ChangePasswordController::class,'ChangePassword'])->name('password.change');
    Route::post('change-password', [ChangePasswordController::class, 'changePasswordSave'])->name('postChangePassword');
    Route::get('users-export', [UserController::class, 'UserExport'])->name('users-export');
    Route::post('users-import', [UserController::class, 'import'])->name('users.import');
    
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
    // Route::any('index', [UserController::class, 'index'])->name('index');
    // Route::any('users-filters', [UserController::class, 'index'])->name('users.filters');
});



// Users
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::post('changeStatus/{id}', [UserController::class, 'ChangeUserStatus'])->name('changeStatus');
  
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoriesController::class);
    Route::get('cms', [CMSController::class, 'index'])->name('cms.index');
    Route::get('cms_edit', [CMSController::class, 'edit'])->name('cms.edit');
    Route::get('qr-code', [QRCodeController::class, 'generateQrCode']);

});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handelGoogleCallback'])->name('auth.google.callback');


Route::get('auth/facebook', [GoogleController::class, 'facebookRedirect'])->name('login.facebook');
Route::get('auth/facebook/callback', [GoogleController::class, 'facebookCallback']);

Route::get('delete-user', function(){
    return view('delete-user');
});

Route::post('language-change/', [LangController::class, 'languageChange'])->name('language.change');
require __DIR__.'/auth.php';
// Route::resource('users',UserController::class);