<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Appartement;
use App\Models\User; // Utiliser User pour les copropriétaires et syndics
use App\Models\Cotisation;
use App\Models\Immeuble;
use App\Models\Residence;
use App\Models\SyndicHistory;
use App\Models\CoproprietaireHistory;

class PaiementController extends Controller
{
    public function AllPaiement()
    {
<<<<<<< HEAD
        $paiements = Paiement::with(['coproprietaireHistory', 'syndicHistory', 'cotisation'])->latest()->get();
=======
        $paiements = Paiement::with(['appartement', 'coproprietaire', 'syndic', 'cotisation'])->latest()->get();
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
        return view('backend.paiement.all_paiement', compact('paiements'));
    }

    public function AddPaiement()
    {
        $residences = Residence::all();
        $immeubles = Immeuble::all();
        $appartements = Appartement::all();
<<<<<<< HEAD
        $coproprietaireHistories = CoproprietaireHistory::all();
        $syndicHistories = SyndicHistory::all();
=======
        $coproprietaires = User::role('coproprietaire')->get(); // Filtrer par rôle de copropriétaire
        $syndics = User::role('syndic')->get(); // Filtrer par rôle de syndic
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
        $cotisations = Cotisation::all();
        return view('backend.paiement.add_paiement', compact('residences', 'immeubles', 'appartements', 'coproprietaireHistories', 'syndicHistories', 'cotisations'));
    }

    public function StorePaiement(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
            'methode_paiement' => 'required|string',
<<<<<<< HEAD
            'coproprietaire_history_id' => 'required|exists:coproprietaire_histories,id',
            'syndic_history_id' => 'required|exists:syndic_histories,id',
            'cotisation_id' => 'required|exists:cotisations,id',
=======
            'appartement_id' => 'required|exists:appartements,id',
            'coproprietaire_id' => 'required|exists:users,id', // Utiliser l'ID utilisateur
            'syndic_id' => 'required|exists:users,id', // Utiliser l'ID utilisateur
            'cotisation_id' => 'required|exists:cotisations,id'
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
        ]);

        Paiement::create([
            'montant' => $request->montant,
            'date_paiement' => $request->date_paiement,
            'methode_paiement' => $request->methode_paiement,
<<<<<<< HEAD
            'coproprietaire_history_id' => $request->coproprietaire_history_id,
            'syndic_history_id' => $request->syndic_history_id,
=======
            'appartement_id' => $request->appartement_id,
            'coproprietaire_id' => $request->coproprietaire_id,
            'syndic_id' => $request->syndic_id,
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
            'cotisation_id' => $request->cotisation_id,
        ]);

        return redirect()->route('all.paiement')->with('success', 'Paiement ajouté avec succès');
    }
<<<<<<< HEAD
=======

    public function EditPaiement($id)
    {
        $paiement = Paiement::findOrFail($id);
        $appartements = Appartement::all();
        $coproprietaires = User::role('coproprietaire')->get();
        $syndics = User::role('syndic')->get();
        $cotisations = Cotisation::all();
        return view('backend.paiement.edit_paiement', compact('paiement', 'appartements', 'coproprietaires', 'syndics', 'cotisations'));
    }

    public function UpdatePaiement(Request $request, $id)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
            'methode_paiement' => 'required|string',
            'appartement_id' => 'required|exists:appartements,id',
            'coproprietaire_id' => 'required|exists:users,id',
            'syndic_id' => 'required|exists:users,id',
            'cotisation_id' => 'required|exists:cotisations,id'
        ]);

        $paiement = Paiement::findOrFail($id);
        $paiement->update([
            'montant' => $request->montant,
            'date_paiement' => $request->date_paiement,
            'methode_paiement' => $request->methode_paiement,
            'appartement_id' => $request->appartement_id,
            'coproprietaire_id' => $request->coproprietaire_id,
            'syndic_id' => $request->syndic_id,
            'cotisation_id' => $request->cotisation_id,
        ]);

        return redirect()->route('all.paiement')->with('success', 'Paiement modifié avec succès');
    }

    public function DeletePaiement($id)
    {
        Paiement::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Paiement supprimé avec succès');
    }
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
}
