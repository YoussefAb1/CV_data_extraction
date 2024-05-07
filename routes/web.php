<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SyndicController;
use App\Http\Controllers\Backend\ResidenceController;
use App\Http\Controllers\Backend\ImmeubleController;
use App\Http\Controllers\Backend\AppartementController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin Routes

    Route::middleware(['auth','role:admin'])->group(function(){
Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'AdminLogin']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/residence', [ResidenceController::class, 'AllResidence'])->name('all.residence');
    Route::get('add/residence', [ResidenceController::class, 'AddResidence'])->name('add.residence');
    Route::post('store/residence', [ResidenceController::class, 'StoreResidence'])->name('store.residence');
    Route::get('edit/residence/{id}', [ResidenceController::class, 'EditResidence'])->name('edit.residence');
    Route::post('update/residence', [ResidenceController::class, 'UpdateResidence'])->name('update.residence');
    Route::get('delete/residence/{id}', [ResidenceController::class, 'DeleteResidence'])->name('delete.residence');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/immeuble', [ImmeubleController::class, 'AllImmeuble'])->name('all.immeuble');
    Route::get('add/immeuble', [ImmeubleController::class, 'AddImmeuble'])->name('add.immeuble');
    Route::post('store/immeuble', [ImmeubleController::class, 'StoreImmeuble'])->name('store.immeuble');
    Route::get('edit/immeuble/{id}', [ImmeubleController::class, 'EditImmeuble'])->name('edit.immeuble');
    Route::post('update/immeuble', [ImmeubleController::class, 'UpdateImmeuble'])->name('update.immeuble');
    Route::get('delete/immeuble/{id}', [ImmeubleController::class, 'DeleteImmeuble'])->name('delete.immeuble');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/appartement', [AppartementController::class, 'AllAppartement'])->name('all.appartement');
    Route::get('add/appartement', [AppartementController::class, 'AddAppartement'])->name('add.appartement');
    Route::post('store/appartement', [AppartementController::class, 'StoreAppartement'])->name('store.appartement');
    Route::get('edit/appartement/{id}', [AppartementController::class, 'EditAppartement'])->name('edit.appartement');
    Route::post('update/appartement', [AppartementController::class, 'UpdateAppartement'])->name('update.appartement');
    Route::get('delete/appartement/{id}', [AppartementController::class, 'DeleteAppartement'])->name('delete.appartement');

});














Route::get('/syndic/dashboard', [SyndicController::class, 'SyndicDashboard'])->name('syndic.dashboard');
