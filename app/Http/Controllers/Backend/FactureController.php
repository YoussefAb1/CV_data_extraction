<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Appartement;
use App\Models\Charge;
use App\Models\Paiement;
use PDF;


class FactureController extends Controller
{

    public function AllFacture()
    {
        // Récupérer toutes les factures avec les données d'appartement, de charge et de paiement associées
        $factures = Facture::with('appartement', 'charge', 'paiement')->latest()->get();

        // Retourner la vue avec les données des factures
        return view('backend.facture.all_facture', compact('factures'));
    }

    public function AddFacture()
    {
        // Récupérer toutes les appartements, charges et paiements
        $appartements = Appartement::all();
        $charges = Charge::all();
        $paiements = Paiement::all();

        // Retourner la vue pour ajouter une nouvelle facture
        return view('backend.facture.add_facture', compact('appartements', 'charges', 'paiements'));
    }

    public function StoreFacture(Request $request)
    {
        // validation
        $validatedData = $request->validate([
            'numero_facture' => 'required|unique:factures|max:20',
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date',
            'montant_total' => 'required|numeric',
            'description' => 'required|string',
            'appartement_id' => 'required|exists:appartements,id',
            'charge_id' => 'required|exists:charges,id',
            'paiement_id' => 'required|exists:paiements,id',
            'etat' => 'required|string'
        ]);

        // Créer une nouvelle facture
        Facture::create($validatedData);

        // Notification de succès
        $notification = array(
            'message' => 'Facture ajoutée avec succès',
            'alert-type' => 'success'
        );

        // Redirection après ajout
        return redirect()->route('all.facture')->with($notification);
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


    // public function downloadPDF($id)
    // {
    //     $facture = Facture::findOrFail($id);
    //     $pdf = PDF::loadView('factures.pdf', compact('facture'));
    //     return $pdf->download('facture.pdf');
    // }
}
