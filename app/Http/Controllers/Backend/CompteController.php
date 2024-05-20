<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Appartement;
use App\Models\Immeuble;
use App\Models\Residence;
use App\Models\Facture;

class CompteController extends Controller
{
    public function AllCompte()
    {
        // Récupérer tous les comptes avec les données associées (morphable)
        $comptes = Compte::with('compteable')->latest()->get();

        // Retourner la vue avec les données des comptes
        return view('backend.compte.all_compte', compact('comptes'));
    }

    public function AddCompte()
    {
        // Récupérer toutes les entités potentielles pour l'association polymorphique
        $appartements = Appartement::all();
        $immeubles = Immeuble::all();
        $residences = Residence::all();
        $factures = Facture::all();

        // Retourner la vue pour ajouter un nouveau compte
        return view('backend.compte.add_compte', compact('appartements', 'immeubles', 'residences', 'factures'));
    }

    public function StoreCompte(Request $request)
    {
        // validation
        $validatedData = $request->validate([
            'numero_compte' => 'required|unique:comptes|max:20',
            'solde' => 'required|numeric',
            'type_compte' => 'required|string',
            'compteable_type' => 'required|string',
            'compteable_id' => 'required|numeric|exists:' . $request->compteable_type . ',id'
        ]);

        // Créer un nouveau compte
        Compte::create($validatedData);

        // Notification de succès
        $notification = array(
            'message' => 'Compte ajouté avec succès',
            'alert-type' => 'success'
        );

        // Redirection après ajout
        return redirect()->route('all.compte')->with($notification);
    }

    public function EditCompte($id)
    {
        // Récupérer le compte à éditer
        $compte = Compte::findOrFail($id);

        // Récupérer toutes les entités potentielles pour l'association polymorphique
        $appartements = Appartement::all();
        $immeubles = Immeuble::all();
        $residences = Residence::all();
        $factures = Facture::all();

        // Retourner la vue pour éditer un compte
        return view('backend.compte.edit_compte', compact('compte', 'appartements', 'immeubles', 'residences', 'factures'));
    }

    public function UpdateCompte(Request $request, $id)
    {
        // validation
        $validatedData = $request->validate([
            'numero_compte' => 'required|max:20',
            'solde' => 'required|numeric',
            'type_compte' => 'required|string',
            'compteable_type' => 'required|string',
            'compteable_id' => 'required|numeric|exists:' . $request->compteable_type . ',id'
        ]);

        // Mise à jour du compte
        Compte::findOrFail($id)->update($validatedData);

        // Notification de succès
        $notification = array(
            'message' => 'Compte modifié avec succès',
            'alert-type' => 'success'
        );

        // Redirection après modification
        return redirect()->route('all.compte')->with($notification);
    }

    public function DeleteCompte($id)
    {
        // Suppression du compte
        Compte::findOrFail($id)->delete();

        // Notification de succès
        $notification = array(
            'message' => 'Compte supprimé avec succès',
            'alert-type' => 'success'
        );

        // Redirection après suppression
        return redirect()->back()->with($notification);
    }
}
