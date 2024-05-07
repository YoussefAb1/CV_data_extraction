<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appartement;
use App\Models\Immeuble;
use App\Models\Residence;


class AppartementController extends Controller
{
    public function AllAppartement()
    {
        // Récupérer tous les appartements avec les données d'immeuble et de résidence associées
        $appartements = Appartement::with('immeuble.residence')->latest()->get();

        // Retourner la vue avec les données des appartements
        return view('backend.appartement.all_appartement', compact('appartements'));
    }

    public function AddAppartement()
{
        $immeubles = Immeuble::all();
        $residences = Residence::all();
        return view('backend.appartement.add_appartement', compact('immeubles', 'residences'));
}

     public function StoreAppartement(Request $request){

         // validation
         $request->validate([
             'nom_appartement' => 'required|unique:appartements|max:20',
             'etage' => 'required|numeric',
             'surface' => 'required|numeric',
             'id_immeuble' => 'required|exists:immeubles,id',
             'id_residence' => 'required|exists:residences,id'
         ]);

         Appartement::insert([
             'nom_appartement' => $request->nom_appartement,
             'etage' => $request->etage,
             'surface' => $request->surface,
             'id_immeuble' => $request->id_immeuble,
             'id_residence' => $request->id_residence
         ]);

         $notification = array(
             'message'=> 'Appartement ajoutée avec succés',
             'alert-type' => 'success'
         );
         return redirect()->route('all.appartement')->with($notification);

     }

     public function EditAppartement($id)
{
    // Récupérer l'appartement à éditer
    $appartements = Appartement::findOrFail($id);

    // Récupérer la liste des immeubles et des résidences disponibles
    $immeubles = Immeuble::all();
    $residences = Residence::all();

    // Retourner la vue avec les données de l'appartement, des immeubles et des résidences
    return view('backend.appartement.edit_appartement', compact('appartements', 'immeubles', 'residences'));
}

     public function UpdateAppartement(Request $request){

         Appartement::findOrFail($request->id)->update([
             'nom_appartement' => $request->nom_appartement,
             'etage' => $request->etage,
             'surface' => $request->surface,
             'id_immeuble' => $request->id_immeuble,
             'id_residence' => $request->id_residence,
         ]);


         $notification = array(
             'message'=> 'Appartement modifié avec succés',
             'alert-type' => 'success'
         );
         return redirect()->route('all.appartement')->with($notification);

     }

     public function DeleteAppartement($id){

         Appartement::findOrFail($id)->delete();
         $notification = array(
             'message'=> 'Appartement supprimée avec succés',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);


     }
}
