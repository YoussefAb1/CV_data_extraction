<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ResidenceController;
use App\Http\Controllers\Backend\ImmeubleController;
use App\Http\Controllers\Backend\AppartementController;
use App\Http\Controllers\Backend\FactureController;
use App\Http\Controllers\Backend\ChargeController;
use App\Http\Controllers\Backend\CotisationController;
use App\Http\Controllers\Backend\PaiementController;
use App\Http\Controllers\Backend\UtilisateurController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\MemberSyndicController;

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

// Residence Routes


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/residence', [ResidenceController::class, 'AllResidence'])->name('all.residence');
    Route::get('add/residence', [ResidenceController::class, 'AddResidence'])->name('add.residence');
    Route::post('store/residence', [ResidenceController::class, 'StoreResidence'])->name('store.residence');
    Route::get('edit/residence/{id}', [ResidenceController::class, 'EditResidence'])->name('edit.residence');
    Route::post('update/residence', [ResidenceController::class, 'UpdateResidence'])->name('update.residence');
    Route::get('delete/residence/{id}', [ResidenceController::class, 'DeleteResidence'])->name('delete.residence');

});

// Immeuble Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/immeuble', [ImmeubleController::class, 'AllImmeuble'])->name('all.immeuble');
    Route::get('add/immeuble', [ImmeubleController::class, 'AddImmeuble'])->name('add.immeuble');
    Route::post('store/immeuble', [ImmeubleController::class, 'StoreImmeuble'])->name('store.immeuble');
    Route::get('edit/immeuble/{id}', [ImmeubleController::class, 'EditImmeuble'])->name('edit.immeuble');
    Route::post('update/immeuble', [ImmeubleController::class, 'UpdateImmeuble'])->name('update.immeuble');
    Route::get('delete/immeuble/{id}', [ImmeubleController::class, 'DeleteImmeuble'])->name('delete.immeuble');

});

// Appartement Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/appartement', [AppartementController::class, 'AllAppartement'])->name('all.appartement');
    Route::get('add/appartement', [AppartementController::class, 'AddAppartement'])->name('add.appartement');
    Route::post('store/appartement', [AppartementController::class, 'StoreAppartement'])->name('store.appartement');
    Route::get('edit/appartement/{id}', [AppartementController::class, 'EditAppartement'])->name('edit.appartement');
    Route::post('update/appartement', [AppartementController::class, 'UpdateAppartement'])->name('update.appartement');
    Route::get('delete/appartement/{id}', [AppartementController::class, 'DeleteAppartement'])->name('delete.appartement');

});

// Facture Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/facture', [FactureController::class, 'AllFacture'])->name('all.facture');
    Route::get('add/facture', [FactureController::class, 'AddFacture'])->name('add.facture');
    Route::post('store/facture', [FactureController::class, 'StoreFacture'])->name('store.facture');
    Route::get('edit/facture/{id}', [FactureController::class, 'EditFacture'])->name('edit.facture');
    Route::post('update/facture', [FactureController::class, 'UpdateFacture'])->name('update.facture');
    Route::get('delete/facture/{id}', [FactureController::class, 'DeleteFacture'])->name('delete.facture');

});

// Charge Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/charge', [ChargeController::class, 'AllCharge'])->name('all.charge');
    Route::get('add/charge', [ChargeController::class, 'AddCharge'])->name('add.charge');
    Route::post('store/charge', [ChargeController::class, 'StoreCharge'])->name('store.charge');
    Route::get('edit/charge/{id}', [ChargeController::class, 'EditCharge'])->name('edit.charge');
    Route::post('update/charge', [ChargeController::class, 'UpdateCharge'])->name('update.charge');
    Route::get('delete/charge/{id}', [ChargeController::class, 'DeleteCharge'])->name('delete.charge');

});


// Cotisation Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/cotisation', [CotisationController::class, 'AllCotisation'])->name('all.cotisation');
    Route::get('add/cotisation', [CotisationController::class, 'AddCotisation'])->name('add.cotisation');
    Route::post('store/cotisation', [CotisationController::class, 'StoreCotisation'])->name('store.cotisation');
    Route::get('edit/cotisation/{id}', [CotisationController::class, 'EditCotisation'])->name('edit.cotisation');
    Route::post('update/cotisation', [CotisationController::class, 'UpdateCotisation'])->name('update.cotisation');
    Route::get('delete/cotisation/{id}', [CotisationController::class, 'DeleteCotisation'])->name('delete.cotisation');

});

// Paiement Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/paiement', [PaiementController::class, 'AllPaiement'])->name('all.paiement');
    Route::get('add/paiement', [PaiementController::class, 'AddPaiement'])->name('add.paiement');
    Route::post('store/paiement', [PaiementController::class, 'StorePaiement'])->name('store.paiement');
    Route::get('edit/paiement/{id}', [PaiementController::class, 'EditPaiement'])->name('edit.paiement');
    Route::post('update/paiement', [PaiementController::class, 'UpdatePaiement'])->name('update.paiement');
    Route::get('delete/paiement/{id}', [PaiementController::class, 'DeletePaiement'])->name('delete.paiement');

});

// Utlisateur Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/utilisateur', [UtilisateurController::class, 'AllUtilisateur'])->name('all.utilisateur');
    Route::get('add/utilisateur', [UtilisateurController::class, 'AddUtilisateur'])->name('add.utilisateur');
    Route::post('store/utilisateur', [UtilisateurController::class, 'StoreUtilisateur'])->name('store.utilisateur');
    Route::get('edit/utilisateur/{id}', [UtilisateurController::class, 'EditUtilisateur'])->name('edit.utilisateur');
    Route::post('update/utilisateur/{id}', [UtilisateurController::class, 'UpdateUtilisateur'])->name('update.utilisateur');
    Route::get('delete/utilisateur/{id}', [UtilisateurController::class, 'DeleteUtilisateur'])->name('delete.utilisateur');

});

// Permission Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/permission', [RoleController::class, 'AllPermission'])->name('all.permission');
    Route::get('add/permission', [RoleController::class, 'AddPermission'])->name('add.permission');
    Route::post('store/permission', [RoleController::class, 'StorePermission'])->name('store.permission');
    Route::get('edit/permission/{id}', [RoleController::class, 'EditPermission'])->name('edit.permission');
    Route::post('update/permission', [RoleController::class, 'UpdatePermission'])->name('update.permission');
    Route::get('delete/permission/{id}', [RoleController::class, 'DeletePermission'])->name('delete.permission');

});

// Role Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/role', [RoleController::class, 'AllRole'])->name('all.role');
    Route::get('add/role', [RoleController::class, 'AddRole'])->name('add.role');
    Route::post('store/role', [RoleController::class, 'StoreRole'])->name('store.role');
    Route::get('edit/role/{id}', [RoleController::class, 'EditRole'])->name('edit.role');
    Route::post('update/role', [RoleController::class, 'UpdateRole'])->name('update.role');
    Route::get('delete/role/{id}', [RoleController::class, 'DeleteRole'])->name('delete.role');

});









Route::get('/syndic/dashboard', [MemberSyndicController::class, 'SyndicDashboard'])->name('syndic.dashboard');
