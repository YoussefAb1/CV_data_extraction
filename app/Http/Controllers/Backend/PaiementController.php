<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Appartement;
use App\Models\MemberCoproprietaire;
use App\Models\MemberSyndic;
use App\Models\Cotisation;
use App\Models\Immeuble;
use App\Models\Residence;
use App\Models\SyndicHistory;
use App\Models\CoproprietaireHistory;

class PaiementController extends Controller
{
    public function AllPaiement()
    {
        $paiements = Paiement::with(['coproprietaireHistory', 'syndicHistory', 'cotisation'])->latest()->get();
        return view('backend.paiement.all_paiement', compact('paiements'));
    }

    public function AddPaiement()
    {
        $residences = Residence::all();
        $immeubles = Immeuble::all();
        $appartements = Appartement::all();
        $coproprietaireHistories = CoproprietaireHistory::all();
        $syndicHistories = SyndicHistory::all();
        $cotisations = Cotisation::all();
        return view('backend.paiement.add_paiement', compact('residences', 'immeubles', 'appartements', 'coproprietaireHistories', 'syndicHistories', 'cotisations'));
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

        return redirect()->route('all.paiement')->with('success', 'Paiement ajouté avec succès');
    }
}
