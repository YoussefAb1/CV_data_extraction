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
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use App\Models\MemberCoproprietaire;
use App\Models\MemberSyndic;
use Illuminate\Support\Facades\Auth;



class PaiementController extends Controller
{
    public function AllPaiement()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Récupérer tous les paiements avec les données associées pour l'admin
            $paiements = Paiement::with([
                'coproprietaireHistory.appartement.immeuble.residence',
                'coproprietaireHistory.coproprietaire',
                'cotisation.memberSyndic.user'
            ])->latest()->get();
        } elseif ($user->role === 'syndic') {
            // Récupérer les immeubles associés au syndic
            $immeubles_ids = SyndicHistory::where('syndic_id', $user->id)->pluck('immeuble_id');

            // Récupérer les paiements associés à ces immeubles
            $paiements = Paiement::with([
                'coproprietaireHistory.appartement.immeuble.residence',
                'coproprietaireHistory.coproprietaire',
                'cotisation.memberSyndic.user'
            ])->whereHas('coproprietaireHistory.appartement', function ($query) use ($immeubles_ids) {
                $query->whereIn('immeuble_id', $immeubles_ids);
            })->latest()->get();
        } else {
            abort(403, 'Unauthorized action.');
        }

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


    public function EditPaiement($id)
    {
        $paiement = Paiement::findOrFail($id);
        $residences = Residence::all();
        $immeubles = Immeuble::all();
        $appartements = Appartement::all();
        $coproprietaires = MemberCoproprietaire::all(); // Ajoutez cette ligne pour récupérer les copropriétaires
        $syndics = MemberSyndic::all(); // Assurez-vous de récupérer également les syndics si vous en avez besoin
        $cotisations = Cotisation::all();

        return view('backend.paiement.edit_paiement', compact('paiement', 'residences', 'immeubles', 'appartements', 'coproprietaires', 'syndics', 'cotisations'));
    }

    public function DeletePaiement($id)
    {
        Paiement::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Paiement supprimée avec succès');
    }


    public function downloadPDF($id)
{
    $paiement = Paiement::findOrFail($id);

    $pdf = new Dompdf();
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $pdf->setOptions($options);

    $pdf->loadHtml(View::make('backend.paiement.paiement_pdf', compact('paiement')));
    $pdf->render();

    $pdf->stream('paiement.pdf', ['Attachment' => 0]);
}



public function getImmeublesByResidence($residenceId)
{
    $immeubles = Immeuble::where('residence_id', $residenceId)->get();
    return response()->json($immeubles);
}

public function getAppartementsByImmeuble($immeubleId)
{
    $appartements = Appartement::where('immeuble_id', $immeubleId)->get();
    return response()->json($appartements);
}

public function getCoproprietairesByAppartement($appartementId)
{
    $coproprietaireHistories = CoproprietaireHistory::where('appartement_id', $appartementId)->with('coproprietaire')->get();
    return response()->json($coproprietaireHistories);
}

public function getSyndicsByImmeuble($immeubleId)
{
    $syndicHistories = SyndicHistory::where('immeuble_id', $immeubleId)->with('syndic')->get();
    return response()->json($syndicHistories);
}

}
