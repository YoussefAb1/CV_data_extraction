<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Appartement;
use App\Models\MemberCoproprietaire;
use App\Models\MemberSyndic;
use App\Models\Cotisation;

class PaiementController extends Controller
{
    public function AllPaiement()
    {
        $paiements = Paiement::with(['appartement', 'appartement.immeuble', 'appartement.residence', 'member_coproprietaire', 'member_syndic', 'cotisation'])->latest()->get();
        return view('backend.paiement.all_paiement', compact('paiements'));
    }

    public function AddPaiement()
    {
        $appartements = Appartement::all();
        $coproprietaires = MemberCoproprietaire::all();
        $syndics = MemberSyndic::all();
        $cotisations = Cotisation::all();
        return view('backend.paiement.add_paiement', compact('appartements', 'coproprietaires', 'syndics', 'cotisations'));
    }

    public function StorePaiement(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
            'methode_paiement' => 'required|string',
            'appartement_id' => 'required|exists:appartements,id',
            'member_coproprietaire_id' => 'required|exists:member_coproprietaires,id',
            'member_syndic_id' => 'required|exists:member_syndics,id',
            'cotisation_id' => 'required|exists:cotisations,id'
        ]);

        Paiement::create($request->all());

        return redirect()->route('all.paiement')->with('success', 'Paiement ajouté avec succès');
    }

    public function EditPaiement($id)
    {
        $paiement = Paiement::findOrFail($id);
        $appartements = Appartement::all();
        $coproprietaires = MemberCoproprietaire::all();
        $syndics = MemberSyndic::all();
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
            'member_coproprietaire_id' => 'required|exists:member_coproprietaires,id',
            'member_syndic_id' => 'required|exists:member_syndics,id',
            'cotisation_id' => 'required|exists:cotisations,id'
        ]);

        $paiement = Paiement::findOrFail($id);
        $paiement->update($request->all());

        return redirect()->route('all.paiement')->with('success', 'Paiement modifié avec succès');
    }

    public function DeletePaiement($id)
    {
        Paiement::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Paiement supprimé avec succès');
    }
}
