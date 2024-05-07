<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Immeuble;
use App\Models\Residence;


class ImmeubleController extends Controller
{
    public function AllImmeuble(){

       // Récupérer tous les immeubles avec les données de résidence associées
    $immeubles = Immeuble::with('residence')->latest()->get();

    // Retourner la vue avec les données des immeubles
    return view('backend.immeuble.all_immeuble', compact('immeubles'));
    }

    public function AddImmeuble()
    {
        $residences = Residence::all(); // Récupérer toutes les résidences
        return view('backend.immeuble.add_immeuble', compact('residences'));
    }

    public function StoreImmeuble(Request $request){

        // validation
        $request->validate([
            'nom_immeuble' => 'required|unique:immeubles|max:20',
            'nombre_etages' => 'required|numeric',
            'id_residence' => 'required|exists:residences,id'
        ]);

        Immeuble::insert([
            'nom_immeuble' => $request->nom_immeuble,
            'nombre_etages' => $request->nombre_etages,
            'id_residence' => $request->id_residence
        ]);

        $notification = array(
            'message'=> 'Immeuble ajoutée avec succés',
            'alert-type' => 'success'
        );
        return redirect()->route('all.immeuble')->with($notification);

    }

    public function EditImmeuble($id){
       // Récupérer l'immeuble à éditer
    $immeubles = Immeuble::findOrFail($id);

    // Récupérer la liste des résidences disponibles
    $residences = Residence::all();

    // Retourner la vue avec les données de l'immeuble et des résidences
    return view('backend.immeuble.edit_immeuble', compact('immeubles', 'residences'));

    }

    public function UpdateImmeuble(Request $request){

        Immeuble::findOrFail($request->id)->update([
            'nom_immeuble' => $request->nom_immeuble,
            'nombre_etages' => $request->nombre_etages,
            'id_residence' => $request->id_residence,
        ]);


        $notification = array(
            'message'=> 'Immeuble modifié avec succés',
            'alert-type' => 'success'
        );
        return redirect()->route('all.immeuble')->with($notification);

    }

    public function DeleteImmeuble($id){

        Immeuble::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Immeuble supprimée avec succés',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }
}
