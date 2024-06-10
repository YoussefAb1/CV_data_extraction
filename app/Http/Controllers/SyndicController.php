<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Residence;
use App\Models\Appartement;
use App\Models\SyndicHistory;
use App\Models\MemberCoproprietaire;
use App\Models\Charge;
use App\Models\Cotisation;
use App\Models\MemberSyndic;
use App\Models\CoproprietaireHistory;
use App\Models\Paiement;
use App\Models\Immeuble;
use App\Models\Facture;


class SyndicController extends Controller
{
    public function SyndicDashboard(){

        return view('backend.syndic.index');
    }

    public function SyndicLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/syndic/login');
    }


    public function SyndicLogin(){
        return view('backend.syndic.syndic_login');
    }


    public function SyndicProfile(){
        $id = Auth::user()-> id;
        $dataProfile = User::find($id);
        return view('backend.syndic.syndic_profile_view', compact('dataProfile'));
    }

    public function SyndicProfileStore(Request $request){
        $id = Auth::user()-> id;
        $data = User::find($id);
        $data->username=$request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->username = $request->username;

        if ($request->file('photo')){
            $file = $request->file('photo');
            $filename = date('YmDHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(
            'message'=> 'Syndic Profile Updated succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function SyndicChangePassword(){

        return view('backend.syndic.syndic_change_password');
    }

    public function SyndicUpdatePassword(Request $request){
        // validation
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed'
        ]);

        //match the old password

        if(!Hash::check($request->oldpassword, auth::user()->password)){
            $notification = array(
                'message'=> 'Old password does not match',
                'alert-type' => 'danger'
            );

            return back()->with($notification);

        }

        //update the new password

        User::whereId(auth()->user()->id)->update([

            'password'=> Hash::make($request->newpassword)
        ]);


        $notification = array(
            'message'=> 'Password change succefully ',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    public function AllAppartement()
{
    $user = auth()->user();
    $residences = Residence::all();
    $coproprietaires = MemberCoproprietaire::all();

    if ($user->role === 'syndic') {
        $immeubles_ids = SyndicHistory::where('syndic_id', $user->id)->pluck('immeuble_id');
        $appartements = Appartement::whereIn('immeuble_id', $immeubles_ids)->get();
    } else {
        abort(403, 'Unauthorized action.');
    }

    return view('backend.syndic.appartement.all_appartement', compact('appartements', 'residences', 'coproprietaires'));
}

public function AddAppartement()
{
    // Récupérer l'utilisateur authentifié
    $user = auth()->user();

    // Récupérer les informations de la résidence et de l'immeuble associés au syndic à partir de SyndicHistory
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->first();
    $residence = $syndicHistory->immeuble->residence;
    $immeuble = $syndicHistory->immeuble;

    return view('backend.syndic.appartement.add_appartement', compact('residence', 'immeuble'));
}

public function StoreAppartement(Request $request)
{
    $request->validate([
        'nom_appartement' => 'required|unique:appartements|max:255',
        'etage' => 'required',
        'surface' => 'required',
        'immeuble_id' => 'required|exists:immeubles,id',
    ]);

    Appartement::create([
        'nom_appartement' => $request->nom_appartement,
        'etage' => $request->etage,
        'surface' => $request->surface,
        'immeuble_id' => $request->immeuble_id,
    ]);

    return redirect()->route('syndic.all.appartement')->with('success', 'Appartement ajouté avec succès');
}


public function EditAppartement($id)
{
    $appartement = Appartement::findOrFail($id);

    // Récupérer les informations de la résidence et de l'immeuble associés à l'appartement
    $immeuble = $appartement->immeuble;
    $residence = $immeuble->residence;

    return view('backend.syndic.appartement.edit_appartement', compact('appartement', 'immeuble', 'residence'));
}


public function UpdateAppartement(Request $request, $id)
{
    $request->validate([
        'nom_appartement' => 'required|unique:appartements,nom_appartement,' . $id . '|max:255',
        'etage' => 'required',
        'surface' => 'required',
        'immeuble_id' => 'required|exists:immeubles,id',
    ]);

    $appartement = Appartement::findOrFail($id);
    $appartement->update([
        'nom_appartement' => $request->nom_appartement,
        'etage' => $request->etage,
        'surface' => $request->surface,
        'immeuble_id' => $request->immeuble_id,
    ]);

    return redirect()->route('syndic.all.appartement')->with('success', 'Appartement mis à jour avec succès');
}


public function DeleteAppartement($id)
{
    $appartement = Appartement::findOrFail($id);
    $appartement->delete();

    return redirect()->route('syndic.all.appartement')->with('success', 'Appartement supprimé avec succès');
}

public function AllCharge()
{
    $user = auth()->user();

    if ($user->role === 'syndic') {
        // Récupérer les immeubles associés au syndic
        $immeubles_ids = SyndicHistory::where('syndic_id', $user->id)->pluck('immeuble_id');
        // Récupérer les charges associées à ces immeubles
        $charges = Charge::whereIn('immeuble_id', $immeubles_ids)
                         ->with(['appartement.immeuble.residence'])
                         ->latest()
                         ->get();
        return view('backend.syndic.charge.all_charge', compact('charges'));
    } else {
        abort(403, 'Unauthorized action.');
    }
}


public function AddCharge()
{
    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;
    $appartements = Appartement::where('immeuble_id', $immeuble->id)->get();

    return view('backend.syndic.charge.add_charge', compact('appartements', 'immeuble', 'residence'));
}


public function StoreCharge(Request $request)
{
    $request->validate([
        'designation' => 'required',
        'type' => 'required',
        'date' => 'required|date',
        'montant' => 'required|numeric',
        'description' => 'nullable',
        'statut' => 'required',
        'appartement_id' => 'required|exists:appartements,id',
    ]);

    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;

    Charge::create([
        'designation' => $request->designation,
        'type' => $request->type,
        'date' => $request->date,
        'montant' => $request->montant,
        'description' => $request->description,
        'statut' => $request->statut,
        'appartement_id' => $request->appartement_id,
        'immeuble_id' => $immeuble->id,
        'residence_id' => $residence->id,
    ]);

    return redirect()->route('syndic.all.charge')->with('success', 'Charge ajoutée avec succès');
}


public function EditCharge($id)
{
    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;

    $charge = Charge::where('immeuble_id', $immeuble->id)->findOrFail($id);
    $appartements = Appartement::where('immeuble_id', $immeuble->id)->get();

    return view('backend.syndic.charge.edit_charge', compact('charge', 'appartements', 'immeuble', 'residence'));
}



public function UpdateCharge(Request $request, $id)
{
    $request->validate([
        'designation' => 'required',
        'type' => 'required',
        'date' => 'required|date',
        'montant' => 'required|numeric',
        'description' => 'nullable',
        'statut' => 'required',
        'appartement_id' => 'required|exists:appartements,id',
    ]);

    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;

    $charge = Charge::where('immeuble_id', $immeuble->id)->findOrFail($id);
    $charge->update([
        'designation' => $request->designation,
        'type' => $request->type,
        'date' => $request->date,
        'montant' => $request->montant,
        'description' => $request->description,
        'statut' => $request->statut,
        'appartement_id' => $request->appartement_id,
        'immeuble_id' => $immeuble->id,
        'residence_id' => $residence->id,
    ]);

    return redirect()->route('syndic.all.charge')->with('success', 'Charge modifiée avec succès');
}


public function DeleteCharge($id)
{
    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;

    $charge = Charge::where('immeuble_id', $immeuble->id)->findOrFail($id);
    $charge->delete();

    return redirect()->back()->with('success', 'Charge supprimée avec succès');
}


public function AllCotisation()
{
    $user = auth()->user();

    if ($user->role === 'syndic') {
        // Récupérer les immeubles associés au syndic
        $immeubles_ids = SyndicHistory::where('syndic_id', $user->id)->pluck('immeuble_id');
        // Récupérer les cotisations associées à ces immeubles
        $cotisations = Cotisation::with(['appartement.immeuble', 'appartement.residence'])
            ->whereHas('appartement', function ($query) use ($immeubles_ids) {
                $query->whereIn('immeuble_id', $immeubles_ids);
            })
            ->latest()
            ->get();
        return view('backend.syndic.cotisation.all_cotisation', compact('cotisations'));
    } else {
        abort(403, 'Unauthorized action.');
    }
}



public function AddCotisation()
{
    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;
    $appartements = Appartement::where('immeuble_id', $immeuble->id)->get();
    $coproprietaires = MemberCoproprietaire::all();
    $syndics = MemberSyndic::with('user')->get();

    return view('backend.syndic.cotisation.add_cotisation', compact('appartements', 'coproprietaires', 'syndics', 'immeuble', 'residence'));
}

public function StoreCotisation(Request $request)
{
    $request->validate([
        'montant' => 'required|numeric',
        'date_cotisation' => 'required|date',
        'description' => 'nullable|string',
        'appartement_id' => 'required|exists:appartements,id',
        'member_coproprietaire_id' => 'required|exists:member_coproprietaires,id',
        'member_syndic_id' => 'required|exists:member_syndics,id'
    ]);

    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;

    Cotisation::create([
        'montant' => $request->montant,
        'date_cotisation' => $request->date_cotisation,
        'description' => $request->description,
        'appartement_id' => $request->appartement_id,
        'member_coproprietaire_id' => $request->member_coproprietaire_id,
        'member_syndic_id' => $request->member_syndic_id,
        'immeuble_id' => $immeuble->id,
        'residence_id' => $residence->id,
    ]);

    return redirect()->route('syndic.all.cotisation')->with('success', 'Cotisation ajoutée avec succès');
}


public function EditCotisation($id)
{
    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;

    $cotisation = Cotisation::whereHas('appartement', function ($query) use ($immeuble) {
        $query->where('immeuble_id', $immeuble->id);
    })->findOrFail($id);

    $appartements = Appartement::where('immeuble_id', $immeuble->id)->get();
    $coproprietaires = MemberCoproprietaire::all();
    $syndics = MemberSyndic::with('user')->get();

    return view('backend.syndic.cotisation.edit_cotisation', compact('cotisation', 'appartements', 'coproprietaires', 'syndics', 'immeuble', 'residence'));
}


public function UpdateCotisation(Request $request, $id)
{
    $request->validate([
        'montant' => 'required|numeric',
        'date_cotisation' => 'required|date',
        'description' => 'nullable|string',
        'appartement_id' => 'required|exists:appartements,id',
        'member_coproprietaire_id' => 'required|exists:member_coproprietaires,id',
        'member_syndic_id' => 'required|exists:member_syndics,id'
    ]);

    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;

    $cotisation = Cotisation::whereHas('appartement', function ($query) use ($immeuble) {
        $query->where('immeuble_id', $immeuble->id);
    })->findOrFail($id);

    $cotisation->update([
        'montant' => $request->montant,
        'date_cotisation' => $request->date_cotisation,
        'description' => $request->description,
        'appartement_id' => $request->appartement_id,
        'member_coproprietaire_id' => $request->member_coproprietaire_id,
        'member_syndic_id' => $request->member_syndic_id,
        'immeuble_id' => $immeuble->id,
        'residence_id' => $residence->id,
    ]);

    return redirect()->route('syndic.all.cotisation')->with('success', 'Cotisation modifiée avec succès');
}


public function DeleteCotisation($id)
{
    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;

    $cotisation = Cotisation::whereHas('appartement', function ($query) use ($immeuble) {
        $query->where('immeuble_id', $immeuble->id);
    })->findOrFail($id);

    $cotisation->delete();

    return redirect()->back()->with('success', 'Cotisation supprimée avec succès');
}

public function AllPaiement()
{
    $user = auth()->user();

    if ($user->role === 'syndic') {
        // Récupérer les immeubles associés au syndic
        $immeubles_ids = SyndicHistory::where('syndic_id', $user->id)->pluck('immeuble_id');
        // Récupérer les paiements associés à ces immeubles
        $paiements = Paiement::with([
            'coproprietaireHistory.appartement.immeuble.residence',
            'coproprietaireHistory.coproprietaire',
            'syndicHistory.syndic',
            'cotisation'
        ])->whereHas('coproprietaireHistory.appartement', function ($query) use ($immeubles_ids) {
            $query->whereIn('immeuble_id', $immeubles_ids);
        })->latest()->get();
        // Retourner la vue avec les données des paiements pour le syndic
        return view('backend.syndic.paiement.all_paiement', compact('paiements'));
    } else {
        abort(403, 'Unauthorized action.');
    }
}

public function AddPaiement()
{
    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;
    $appartements = Appartement::where('immeuble_id', $immeuble->id)->get();
    $coproprietaireHistories = CoproprietaireHistory::all();
    $syndicHistories = SyndicHistory::all();
    $cotisations = Cotisation::all();

    return view('backend.syndic.paiement.add_paiement', compact('residence', 'immeuble', 'appartements', 'coproprietaireHistories', 'syndicHistories', 'cotisations'));
}

public function StorePaiement(Request $request)
{
    $request->validate([
        'montant' => 'required|numeric',
        'date_paiement' => 'required|date',
        'methode_paiement' => 'required|string',
        'coproprietaire_history_id' => 'required|exists:coproprietaire_histories,id',
        'syndic_history_id' => 'required|exists:syndic_histories,id',
        'cotisation_id' => 'required|exists:cotisations,id',
    ]);

    Paiement::create([
        'montant' => $request->montant,
        'date_paiement' => $request->date_paiement,
        'methode_paiement' => $request->methode_paiement,
        'coproprietaire_history_id' => $request->coproprietaire_history_id,
        'syndic_history_id' => $request->syndic_history_id,
        'cotisation_id' => $request->cotisation_id,
    ]);

    return redirect()->route('syndic.all.paiement')->with('success', 'Paiement ajouté avec succès');
}


public function EditPaiement($id)
{
    $user = auth()->user();
    $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->firstOrFail();
    $immeuble = $syndicHistory->immeuble;
    $residence = $immeuble->residence;

    $paiement = Paiement::whereHas('coproprietaireHistory.appartement', function ($query) use ($immeuble) {
        $query->where('immeuble_id', $immeuble->id);
    })->findOrFail($id);

    $residences = Residence::all();
    $immeubles = Immeuble::all();
    $appartements = Appartement::where('immeuble_id', $immeuble->id)->get();
    $coproprietaires = MemberCoproprietaire::all(); // Assurez-vous de récupérer les copropriétaires si nécessaire
    $syndics = MemberSyndic::all(); // Assurez-vous de récupérer les syndics si nécessaire
    $cotisations = Cotisation::all();

    return view('backend.syndic.paiement.edit_paiement', compact('paiement', 'residences', 'immeubles', 'appartements', 'coproprietaires', 'syndics', 'cotisations', 'residence', 'immeuble'));
}

public function UpdatePaiement(Request $request, $id)
{
    $request->validate([
        'montant' => 'required|numeric',
        'date_paiement' => 'required|date',
        'methode_paiement' => 'required|string',
        'coproprietaire_history_id' => 'required|exists:coproprietaire_histories,id',
        'syndic_history_id' => 'required|exists:syndic_histories,id',
        'cotisation_id' => 'required|exists:cotisations,id',
    ]);

    $paiement = Paiement::findOrFail($id);
    $paiement->update([
        'montant' => $request->montant,
        'date_paiement' => $request->date_paiement,
        'methode_paiement' => $request->methode_paiement,
        'coproprietaire_history_id' => $request->coproprietaire_history_id,
        'syndic_history_id' => $request->syndic_history_id,
        'cotisation_id' => $request->cotisation_id,
    ]);

    return redirect()->route('syndic.all.paiement')->with('success', 'Paiement modifié avec succès');
}


public function DeletePaiement($id)
{
    Paiement::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Paiement supprimé avec succès');
}


public function AllMemberCoproprietaire()
{
    $user = auth()->user();

    if ($user->role === 'syndic') {
        // Récupérer les immeubles associés au syndic
        $immeubles_ids = SyndicHistory::where('syndic_id', $user->id)->pluck('immeuble_id');
        // Récupérer les appartements dans ces immeubles
        $appartement_ids = Appartement::whereIn('immeuble_id', $immeubles_ids)->pluck('id');
        // Récupérer les copropriétaires associés à ces appartements via CoproprietaireHistory
        $coproprietaire_ids = CoproprietaireHistory::whereIn('appartement_id', $appartement_ids)->pluck('coproprietaire_id');
        $coproprietaires = MemberCoproprietaire::whereIn('id', $coproprietaire_ids)->with('user')->latest()->get();

        // Retourner la vue avec les données des copropriétaires pour le syndic
        return view('backend.syndic.coproprietaire.all_coproprietaire', compact('coproprietaires'));
    } else {
        abort(403, 'Unauthorized action.');
    }
}

public function AddMemberCoproprietaire()
{
    $user = auth()->user();

    if ($user->role === 'syndic') {
        // Désactiver les champs d'immeuble et de résidence
        $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->first();
        $immeuble_id = $syndicHistory->immeuble_id;
        $residence_id = $syndicHistory->immeuble->residence_id;

        $users = User::all();
        return view('backend.syndic.coproprietaire.add_coproprietaire', compact('users', 'residence_id', 'immeuble_id'));
    } else {
        abort(403, 'Unauthorized action.');
    }
}

public function StoreMemberCoproprietaire(Request $request)
{
    $user = auth()->user();

    if ($user->role === 'syndic') {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cin' => 'required|unique:member_coproprietaires|max:255',
            'name' => 'required',
            'type' => 'required|in:promoteur,proprietaire,locataire'
        ]);

        MemberCoproprietaire::create($request->all());

        return redirect()->route('syndic.all.memberCoproprietaire')->with('success', 'Copropriétaire ajouté avec succès');
    } else {
        abort(403, 'Unauthorized action.');
    }
}

public function EditMemberCoproprietaire($id)
{
    $user = auth()->user();

    if ($user->role === 'syndic') {
        $coproprietaire = MemberCoproprietaire::with('coproprietaireHistories')->findOrFail($id);
        $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->first();
        $immeuble_id = $syndicHistory->immeuble_id;
        $residence_id = $syndicHistory->immeuble->residence_id;

        $users = User::all();
        return view('backend.syndic.coproprietaire.edit_coproprietaire', compact('coproprietaire', 'users', 'residence_id', 'immeuble_id'));
    } else {
        abort(403, 'Unauthorized action.');
    }
}

public function UpdateMemberCoproprietaire(Request $request, $id)
{
    $user = auth()->user();

    if ($user->role === 'syndic') {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cin' => 'required|max:255|unique:member_coproprietaires,cin,' . $id,
            'name' => 'required',
            'type' => 'required|in:promoteur,proprietaire,locataire'
        ]);

        MemberCoproprietaire::findOrFail($id)->update($request->all());

        return redirect()->route('syndic.all.memberCoproprietaire')->with('success', 'Copropriétaire modifié avec succès');
    } else {
        abort(403, 'Unauthorized action.');
    }
}

public function DeleteMemberCoproprietaire($id)
{
    $user = auth()->user();

    if ($user->role === 'syndic') {
        MemberCoproprietaire::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Copropriétaire supprimé avec succès');
    } else {
        abort(403, 'Unauthorized action.');
    }
}


    public function AllFacture()
    {
        $user = auth()->user();

        if ($user->role === 'syndic') {
            // Récupérer les immeubles associés au syndic
            $immeubles_ids = SyndicHistory::where('syndic_id', $user->id)->pluck('immeuble_id');

            // Récupérer les appartements associés à ces immeubles
            $appartements_ids = Appartement::whereIn('immeuble_id', $immeubles_ids)->pluck('id');

            // Récupérer les factures associées à ces appartements
            $factures = Facture::whereIn('appartement_id', $appartements_ids)->latest()->get();

            // Retourner la vue avec les données des factures pour le syndic
            return view('backend.syndic.facture.all_facture', compact('factures'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function AddFacture()
    {
        // Récupérer l'utilisateur authentifié (le syndic)
        $user = auth()->user();

        // Vérifier l'historique du syndic
        $syndicHistory = SyndicHistory::where('syndic_id', $user->id)->first();

        if ($syndicHistory) {
            $immeuble = $syndicHistory->immeuble;

            if ($immeuble) {
                $residence_id = $immeuble->residence_id;
                $immeuble_id = $immeuble->id;
            } else {
                $residence_id = null;
                $immeuble_id = null;
            }
        } else {
            $residence_id = null;
            $immeuble_id = null;
        }

        // Récupérer les copropriétaires, syndics, charges et paiements
        $coproprietaires = MemberCoproprietaire::all();
        $syndics = MemberSyndic::all();
        $charges = Charge::all();
        $paiements = Paiement::all();

        // Retourner la vue pour ajouter une facture
        return view('backend.syndic.facture.add_facture', compact('coproprietaires', 'syndics', 'charges', 'paiements', 'residence_id', 'immeuble_id'));
    }

    public function StoreFacture(Request $request)
    {
        $request->validate([
            'numero_facture' => 'required|unique:factures',
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date',
            'montant_total' => 'required|numeric',
            'description' => 'nullable|string',
            'paiement_id' => 'nullable|exists:paiements,id',
        ]);

        Facture::create([
            'numero_facture' => $request->numero_facture,
            'date_emission' => $request->date_emission,
            'date_echeance' => $request->date_echeance,
            'montant_total' => $request->montant_total,
            'description' => $request->description,
            'paiement_id' => $request->paiement_id,
        ]);

        return redirect()->route('syndic.all.facture')->with('success', 'Facture ajoutée avec succès');
    }


    public function EditFacture($id)
    {
        // Récupérer la facture à éditer
        $facture = Facture::findOrFail($id);

        // Récupérer tous les appartements, charges et paiements
        $appartements = Appartement::all();
        $charges = Charge::all();
        $paiements = Paiement::all();

        // Retourner la vue pour éditer une facture
        return view('backend.syndic.facture.edit_facture', compact('facture', 'appartements', 'charges', 'paiements'));
    }

    public function UpdateFacture(Request $request, $id)
    {
        // validation
        $validatedData = $request->validate([
            'numero_facture' => 'required|max:20',
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date',
            'montant_total' => 'required|numeric',
            'description' => 'required|string',
            'appartement_id' => 'required|exists:appartements,id',
            'charge_id' => 'required|exists:charges,id',
            'paiement_id' => 'required|exists:paiements,id',
            'etat' => 'required|string'
        ]);

        // Mise à jour de la facture
        Facture::findOrFail($id)->update($validatedData);

        // Notification de succès
        $notification = array(
            'message' => 'Facture modifiée avec succès',
            'alert-type' => 'success'
        );

        // Redirection après modification
        return redirect()->route('syndic.all.facture')->with($notification);
    }

    public function DeleteFacture($id)
    {
        // Suppression de la facture
        Facture::findOrFail($id)->delete();

        // Notification de succès
        $notification = array(
            'message' => 'Facture supprimée avec succès',
            'alert-type' => 'success'
        );

        // Redirection après suppression
        return redirect()->back()->with($notification);
    }


    // public function generatePDF()
    // {
    //     $factures = Facture::get();

    //     $data = [
    //         'title' => 'DigiSyndic',
    //         'date' => date('m/d/Y'),
    //         'factures' => $factures
    //     ];

    //     $pdf = PDF::loadView('factures.facturePDF', $data);

    //     return $pdf->download('Facture.pdf');
    // }




 }

