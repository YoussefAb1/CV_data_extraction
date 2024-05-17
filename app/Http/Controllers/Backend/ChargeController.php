<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Charge;
use App\Models\Appartement;


use Illuminate\Support\Facades\Hash;


class ChargeController extends Controller
{
    public function AllCharge(){

        $appartements = Appartement::all();
                // Récupérer tous les immeubles avec les données de résidence associées
     $charges = Charge::with('appartement')->latest()->get();

     // Retourner la vue avec les données des immeubles
     return view('backend.charge.all_charge', compact('charges','appartements'));
     }

     public function AddCharge()
     {
         $appartements = Appartement::all();
         return view('backend.charge.add_charge', compact('appartements'));
     }

     public function StoreCharge(Request $request)
     {
         $request->validate([
             'designation' => 'required',
             'type' => 'required',
             'date' => 'required|date',
             'montant' => 'required|numeric',
             'id_appartement' => 'required|exists:appartements,id',
             // autres validations
         ]);

         Charge::create($request->all());

         return redirect()->route('all.charge')->with('success', 'Charge ajoutée avec succès');
     }

     public function EditCharge($id)
     {
         $charge = Charge::findOrFail($id);
         $appartements = Appartement::all();
         return view('backend.charge.edit_charge', compact('charge', 'appartements'));
     }

     public function UpdateCharge(Request $request, $id)
     {
         $request->validate([
             'designation' => 'required',
             'type' => 'required',
             'date' => 'required|date',
             'montant' => 'required|numeric',
             'id_appartement' => 'required|exists:appartements,id',
             // autres validations
         ]);

         $charge = Charge::findOrFail($id);
         $charge->update($request->all());

         return redirect()->route('all.charge')->with('success', 'Charge modifiée avec succès');
     }
     public function DeleteCharge($id){

         Charge::findOrFail($id)->delete();
         $notification = array(
             'message'=> 'Charge supprimée avec succés',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);


     }
}
