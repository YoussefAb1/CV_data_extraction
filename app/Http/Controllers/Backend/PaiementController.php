<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Appartement;
use App\Models\Facture;

class PaiementController extends Controller
{

    public function AllPaiement(){

        // Récupérer tous les immeubles avec les données de résidence associées
     $paiements = Paiement::with('facture')->latest()->get();

     // Retourner la vue avec les données des immeubles
     return view('backend.paiement.all_paiement', compact('paiements'));
     }

     public function AddPaiement()
     {
        $paiements = Paiement::all();
         $factures = Facture::all(); // Récupérer toutes les résidences
         return view('backend.paiement.add_paiement', compact('paiements','factures'));
     }

     public function StorePaiement(Request $request){

         // validation
         $request->validate([
             'montant' => 'required',
             'date_paiement' => 'required',
             'mode_paiement' => 'required',
             'id_facture' => 'required|exists:factures,id'
         ]);

         Facture::insert([
             'montant' => $request->montant,
             'date_paiement' => $request->date_paiement,
             'mode_paiement' => $request->mode_paiement,
             'id_facture' => $request->id_facture
         ]);

         $notification = array(
             'message'=> 'Paiement ajoutée avec succés',
             'alert-type' => 'success'
         );
         return redirect()->route('all.paiement')->with($notification);

     }

     public function EditPaiement($id){
        // Récupérer l'immeuble à éditer
     $paiements = Paiement::findOrFail($id);

     // Récupérer la liste des résidences disponibles
     $factures = Facture::all();

     // Retourner la vue avec les données de l'immeuble et des résidences
     return view('backend.facture.edit_facture', compact('paiements', 'factures'));

     }

     public function UpdatePaiement(Request $request){

         Paiement::findOrFail($request->id)->update([
            'montant' => $request->montant,
            'date_paiement' => $request->date_paiement,
            'mode_paiement' => $request->mode_paiement,
            'id_facture' => $request->id_facture
         ]);


         $notification = array(
             'message'=> 'Paiement modifié avec succés',
             'alert-type' => 'success'
         );
         return redirect()->route('all.paiements')->with($notification);

     }

     public function DeletePaiement($id){

         Paiement::findOrFail($id)->delete();
         $notification = array(
             'message'=> 'Paiement supprimée avec succés',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);


     }
}
