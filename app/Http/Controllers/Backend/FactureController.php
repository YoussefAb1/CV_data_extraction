<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Appartement;
use App\Models\Charge;
use App\Models\MemberCoproprietaire;
use App\Models\MemberSyndic;

use App\Models\Paiement;
use PDF;


class FactureController extends Controller
{


    public function AllFacture()
    {
        $factures = Facture::latest()->get();
        return view('backend.facture.all_facture', compact('factures'));
    }

    public function AddFacture()
    {
        $coproprietaires = MemberCoproprietaire::all();
        $syndics = MemberSyndic::all();
        $charges = Charge::all();
        $paiements = Paiement::all();
        return view('backend.facture.add_facture', compact('coproprietaires', 'syndics', 'charges', 'paiements'));
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

        return redirect()->route('all.facture')->with('success', 'Facture ajoutée avec succès');
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
        return view('backend.facture.edit_facture', compact('facture', 'appartements', 'charges', 'paiements'));
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
        return redirect()->route('all.facture')->with($notification);
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
