<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Immeuble;
use App\Models\Residence;
use App\Models\MemberSyndic;

class ImmeubleController extends Controller
{
    public function AllImmeuble()
    {
        // Récupérer tous les immeubles avec les données de résidence associées
        $immeubles = Immeuble::with('residence', 'memberSyndic.user')->latest()->get();

        // Retourner la vue avec les données des immeubles
        return view('backend.immeuble.all_immeuble', compact('immeubles'));
    }

    public function AddImmeuble()
    {

        $residences = Residence::all(); // Récupérer toutes les résidences
        $syndics = MemberSyndic::with('user')->get(); // Récupérer tous les syndics avec les données des utilisateurs
        return view('backend.immeuble.add_immeuble', compact('residences', 'syndics'));
    }

    public function StoreImmeuble(Request $request)
{



    $request->validate([
        'nom_immeuble' => 'required|unique:immeubles|max:255',
        'nombre_etages' => 'required|numeric',
        'residence_id' => 'required|exists:residences,id',
        'member_syndic_id' => 'nullable|exists:member_syndics,id' // Rendre ce champ nullable
    ]);

    Immeuble::create([
        'nom_immeuble' => $request->nom_immeuble,
        'nombre_etages' => $request->nombre_etages,
        'residence_id' => $request->residence_id,
        'member_syndic_id' => $request->member_syndic_id
    ]);

    $notification = array(
        'message' => 'Immeuble ajouté avec succès',
        'alert-type' => 'success'
    );
    return redirect()->route('all.immeuble')->with($notification);
}

    public function EditImmeuble($id)
    {
        // Récupérer l'immeuble à éditer
        $immeuble = Immeuble::findOrFail($id);

        // Récupérer la liste des résidences disponibles
        $residences = Residence::all();

        // Récupérer la liste des syndics disponibles
        $syndics = MemberSyndic::with('user')->get();

        // Retourner la vue avec les données de l'immeuble, des résidences et des syndics
        return view('backend.immeuble.edit_immeuble', compact('immeuble', 'residences', 'syndics'));
    }

    public function UpdateImmeuble(Request $request, $id)
    {
        // Validation
        $request->validate([
            'nom_immeuble' => 'required|max:255',
            'nombre_etages' => 'required|numeric',
            'residence_id' => 'required|exists:residences,id',
            'member_syndic_id' => 'exists:member_syndics,id'
        ]);

        Immeuble::findOrFail($id)->update([
            'nom_immeuble' => $request->nom_immeuble,
            'nombre_etages' => $request->nombre_etages,
            'residence_id' => $request->residence_id,
            'member_syndic_id' => $request->member_syndic_id,
        ]);

        $notification = array(
            'message' => 'Immeuble modifié avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.immeuble')->with($notification);
    }

    public function DeleteImmeuble($id)
    {
        Immeuble::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Immeuble supprimé avec succès',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
