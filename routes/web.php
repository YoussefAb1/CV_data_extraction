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
    use App\Http\Controllers\Backend\MemberSyndicController;
    use App\Http\Controllers\Backend\MemberCoproprietaireController;
    use App\Http\Controllers\SyndicController;
    use App\Http\Controllers\CoproprietaireController;
    use App\Http\Controllers\Auth\AuthenticatedSessionController;

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/index2', function () {
        return view('index2');
    })->name('index2');


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
    Route::get('/immeuble/{id}', [ImmeubleController::class, 'ShowImmeuble'])->name('show.immeuble');
    Route::get('/immeubles/{immeuble}/history', [ImmeubleController::class, 'syndicHistory'])->name('history.syndic_immeuble');
    Route::get('immeuble/{id}/add-syndic', [ImmeubleController::class, 'AddSyndicToImmeuble'])->name('add.syndic_to_immeuble');
    Route::post('immeuble/{id}/store-syndic', [ImmeubleController::class, 'StoreSyndicToImmeuble'])->name('store.syndic_to_immeuble');
    });


// Appartement Routes Admin
    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/appartement', [AppartementController::class, 'AllAppartement'])->name('all.appartement');
    Route::get('add/appartement', [AppartementController::class, 'AddAppartement'])->name('add.appartement');
    Route::post('store/appartement', [AppartementController::class, 'StoreAppartement'])->name('store.appartement');
    Route::get('edit/appartement/{id}', [AppartementController::class, 'EditAppartement'])->name('edit.appartement');
    Route::post('update/appartement', [AppartementController::class, 'UpdateAppartement'])->name('update.appartement');
    Route::get('delete/appartement/{id}', [AppartementController::class, 'DeleteAppartement'])->name('delete.appartement');
    Route::get('/add-coproprietaire-to-appartement/{id}', [AppartementController::class, 'AddCoproprietaireToAppartement'])->name('add.coproprietaire_to_appartement');
    Route::post('/store-coproprietaire-to-appartement/{id}', [AppartementController::class, 'StoreCoproprietaireToAppartement'])->name('store.coproprietaire_to_appartement');
    Route::get('/history-coproprietaire-appartement/{id}', [AppartementController::class, 'CoproprietaireHistory'])->name('history.coproprietaire_appartement');
    });



// MemberSyndic Routes

    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/memberSyndic', [MemberSyndicController::class, 'AllMemberSyndic'])->name('all.memberSyndic');
    Route::get('add/memberSyndic', [MemberSyndicController::class, 'AddMemberSyndic'])->name('add.memberSyndic');
    Route::post('store/memberSyndic', [MemberSyndicController::class, 'StoreMemberSyndic'])->name('store.memberSyndic');
    Route::get('edit/memberSyndic/{id}', [MemberSyndicController::class, 'EditMemberSyndic'])->name('edit.memberSyndic');
    Route::post('update/memberSyndic', [MemberSyndicController::class, 'UpdateMemberSyndic'])->name('update.memberSyndic');
    Route::get('delete/memberSyndic/{id}', [MemberSyndicController::class, 'DeleteMemberSyndic'])->name('delete.memberSyndic');
    });




 // Member Coproprietaire Routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/memberCoproprietaire', [MemberCoproprietaireController::class, 'AllMemberCoproprietaire'])->name('all.memberCoproprietaire');
    Route::get('add/memberCoproprietaire', [MemberCoproprietaireController::class, 'AddMemberCoproprietaire'])->name('add.memberCoproprietaire');
    Route::post('store/memberCoproprietaire', [MemberCoproprietaireController::class, 'StoreMemberCoproprietaire'])->name('store.memberCoproprietaire');
    Route::get('edit/memberCoproprietaire/{id}', [MemberCoproprietaireController::class, 'EditMemberCoproprietaire'])->name('edit.memberCoproprietaire');
    Route::post('update/memberCoproprietaire', [MemberCoproprietaireController::class, 'UpdateMemberCoproprietaire'])->name('update.memberCoproprietaire');
    Route::get('delete/memberCoproprietaire/{id}', [MemberCoproprietaireController::class, 'DeleteMemberCoproprietaire'])->name('delete.memberCoproprietaire');
    });

// Facture Routes

    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('all/facture', [FactureController::class, 'AllFacture'])->name('all.facture');
    Route::get('add/facture', [FactureController::class, 'AddFacture'])->name('add.facture');
    Route::post('store/facture', [FactureController::class, 'StoreFacture'])->name('store.facture');
    Route::get('edit/facture/{id}', [FactureController::class, 'EditFacture'])->name('edit.facture');
    Route::post('update/facture', [FactureController::class, 'UpdateFacture'])->name('update.facture');
    Route::get('delete/facture/{id}', [FactureController::class, 'DeleteFacture'])->name('delete.facture');
    Route::get('generate-pdf', [FactureController::class, 'generatePDF']);

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
    Route::get('paiement/{id}/pdf', [PaiementController::class, 'downloadPDF'])->name('download.pdf');
    Route::get('/api/immeubles/{residenceId}', [PaiementController::class, 'getImmeublesByResidence']);
    Route::get('/api/appartements/{immeubleId}', [PaiementController::class, 'getAppartementsByImmeuble']);
    Route::get('/api/coproprietaires/{appartementId}', [PaiementController::class, 'getCoproprietairesByAppartement']);
    Route::get('/api/syndics/{immeubleId}', [PaiementController::class, 'getSyndicsByImmeuble']);

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


    Route::middleware(['auth','role:syndic'])->group(function(){
    Route::get('/syndic/dashboard', [SyndicController::class, 'SyndicDashboard'])->name('syndic.dashboard');
    Route::get('/syndic/logout', [SyndicController::class, 'SyndicLogout'])->name('syndic.logout');
    Route::get('/syndic/profile', [SyndicController::class, 'SyndicProfile'])->name('syndic.profile');
    Route::post('/syndic/profile/store', [SyndicController::class, 'SyndicProfileStore'])->name('syndic.profile.store');
    Route::get('/syndic/change/password', [SyndicController::class, 'SyndicChangePassword'])->name('syndic.change.password');
    Route::post('/syndic/update/password', [SyndicController::class, 'SyndicUpdatePassword'])->name('syndic.update.password');
    Route::get('/syndic/appartements', [SyndicController::class, 'AllAppartement'])->name('syndic.all.appartement');
    Route::get('/syndic/add/appartement', [SyndicController::class, 'AddAppartement'])->name('syndic.add.appartement');
    Route::post('/syndic/store/appartement', [SyndicController::class, 'StoreAppartement'])->name('syndic.store.appartement');
    Route::get('/syndic/edit/appartement/{id}', [SyndicController::class, 'EditAppartement'])->name('syndic.edit.appartement');
    Route::post('/syndic/update/appartement', [SyndicController::class, 'UpdateAppartement'])->name('syndic.update.appartement');
    Route::get('/syndic/delete/appartement/{id}', [SyndicController::class, 'DeleteAppartement'])->name('syndic.delete.appartement');
    Route::get('/syndic/all/memberCoproprietaire', [SyndicController::class, 'AllMemberCoproprietaire'])->name('syndic.all.memberCoproprietaire');
    Route::get('/syndic/add/memberCoproprietaire', [SyndicController::class, 'AddMemberCoproprietaire'])->name('syndic.add.memberCoproprietaire');
    Route::post('/syndic/store/memberCoproprietaire', [SyndicController::class, 'StoreMemberCoproprietaire'])->name('syndic.store.memberCoproprietaire');
    Route::get('/syndic/edit/memberCoproprietaire/{id}', [SyndicController::class, 'EditMemberCoproprietaire'])->name('syndic.edit.memberCoproprietaire');
    Route::post('/syndic/update/memberCoproprietaire', [SyndicController::class, 'UpdateMemberCoproprietaire'])->name('syndic.update.memberCoproprietaire');
    Route::get('/syndic/delete/memberCoproprietaire/{id}', [SyndicController::class, 'DeleteMemberCoproprietaire'])->name('syndic.delete.memberCoproprietaire');
    Route::get('/syndic/all/facture', [SyndicController::class, 'AllFacture'])->name('syndic.all.facture');
    Route::get('/syndic/add/facture', [SyndicController::class, 'AddFacture'])->name('syndic.add.facture');
    Route::post('/syndic/store/facture', [SyndicController::class, 'StoreFacture'])->name('syndic.store.facture');
    Route::get('/syndic/edit/facture/{id}', [SyndicController::class, 'EditFacture'])->name('syndic.edit.facture');
    Route::post('/syndic/update/facture', [SyndicController::class, 'UpdateFacture'])->name('syndic.update.facture');
    Route::get('/syndic/delete/facture/{id}', [SyndicController::class, 'DeleteFacture'])->name('syndic.delete.facture');
    Route::get('/syndic/generate-pdf', [SyndicController::class, 'generatePDF']);
    Route::get('/syndic/all/charge', [SyndicController::class, 'AllCharge'])->name('syndic.all.charge');
    Route::get('/syndic/add/charge', [SyndicController::class, 'AddCharge'])->name('syndic.add.charge');
    Route::post('/syndic/store/charge', [SyndicController::class, 'StoreCharge'])->name('syndic.store.charge');
    Route::get('/syndic/edit/charge/{id}', [SyndicController::class, 'EditCharge'])->name('syndic.edit.charge');
    Route::post('/syndic/update/charge', [SyndicController::class, 'UpdateCharge'])->name('syndic.update.charge');
    Route::get('/syndic/delete/charge/{id}', [SyndicController::class, 'DeleteCharge'])->name('syndic.delete.charge');
    Route::get('/syndic/all/cotisation', [SyndicController::class, 'AllCotisation'])->name('syndic.all.cotisation');
    Route::get('/syndic/add/cotisation', [SyndicController::class, 'AddCotisation'])->name('syndic.add.cotisation');
    Route::post('/syndic/store/cotisation', [SyndicController::class, 'StoreCotisation'])->name('syndic.store.cotisation');
    Route::get('/syndic/edit/cotisation/{id}', [SyndicController::class, 'EditCotisation'])->name('syndic.edit.cotisation');
    Route::post('/syndic/update/cotisation', [SyndicController::class, 'UpdateCotisation'])->name('syndic.update.cotisation');
    Route::get('/syndic/delete/cotisation/{id}', [SyndicController::class, 'DeleteCotisation'])->name('syndic.delete.cotisation');
    Route::get('/syndic/all/paiement', [SyndicController::class, 'AllPaiement'])->name('syndic.all.paiement');
    Route::get('/syndic/add/paiement', [SyndicController::class, 'AddPaiement'])->name('syndic.add.paiement');
    Route::post('/syndic/store/paiement', [SyndicController::class, 'StorePaiement'])->name('syndic.store.paiement');
    Route::get('/syndic/edit/paiement/{id}', [SyndicController::class, 'EditPaiement'])->name('syndic.edit.paiement');
    Route::post('/syndic/update/paiement', [SyndicController::class, 'UpdatePaiement'])->name('syndic.update.paiement');
    Route::get('/syndic/delete/paiement/{id}', [SyndicController::class, 'DeletePaiement'])->name('syndic.delete.paiement');

});
    Route::get('/syndic/login', [SyndicController::class, 'SyndicLogin'])->name('syndic.login');
    Route::post('/syndic/login', [SyndicController::class, 'SyndicLogin']);



    Route::middleware(['auth','role:coproprietaire'])->group(function(){
    Route::get('/coproprietaire/dashboard', [CoproprietaireController::class, 'CoproprietaireDashboard'])->name('coproprietaire.dashboard');
    Route::get('/coproprietaire/logout', [CoproprietaireController::class, 'CoproprietaireLogout'])->name('coproprietaire.logout');
    Route::get('/coproprietaire/profile', [CoproprietaireController::class, 'CoproprietaireProfile'])->name('coproprietaire.profile');
    Route::post('/coproprietaire/profile/store', [CoproprietaireController::class, 'CoproprietaireProfileStore'])->name('coproprietaire.profile.store');
    Route::get('/coproprietaire/change/password', [CoproprietaireController::class, 'CoproprietaireChangePassword'])->name('coproprietaire.change.password');
    Route::post('/coproprietaire/update/password', [CoproprietaireController::class, 'CoproprietaireUpdatePassword'])->name('coproprietaire.update.password');
    Route::get('/coproprietaire/all/facture', [CoproprietaireController::class, 'AllFacture'])->name('coproprietaire.all.facture');
    Route::get('/coproprietaire/all/charge', [CoproprietaireController::class, 'AllCharge'])->name('coproprietaire.all.charge');
    Route::get('/coproprietaire/all/paiement', [CoproprietaireController::class, 'AllPaiement'])->name('coproprietaire.all.paiement');
    Route::get('/coproprietaire/all/cotisation', [CoproprietaireController::class, 'AllCotisation'])->name('coproprietaire.all.cotisation');


    });
    Route::get('/coproprietaire/login', [CoproprietaireController::class, 'CoproprietaireLogin'])->name('coproprietaire.login');
    Route::post('/coproprietaire/login', [CoproprietaireController::class, 'CoproprietaireLogin']);

