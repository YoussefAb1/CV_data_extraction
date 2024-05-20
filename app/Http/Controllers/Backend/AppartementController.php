<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appartement;
use App\Models\Immeuble;
use App\Models\Residence;
use App\Models\MemberCoproprietaire;

class AppartementController extends Controller
{
    public function AllAppartement()
    {
        // Récupérer tous les appartements avec les données d'immeuble, de résidence et de copropriétaire associées
        $appartements = Appartement::with(['immeuble.residence', 'memberCoproprietaire.user'])->latest()->get();

        // Retourner la vue avec les données des appartements
        return view('backend.appartement.all_appartement', compact('appartements'));
    }

    public function AddAppartement()
    {
        $immeubles = Immeuble::all();
        $residences = Residence::all();
        $coproprietaires = MemberCoproprietaire::all(); // Récupérer tous les copropriétaires

        return view('backend.appartement.add_appartement', compact('immeubles', 'residences', 'coproprietaires'));
    }

    public function StoreAppartement(Request $request)
{
    // Validation
    $request->validate([
        'nom_appartement' => 'required|unique:appartements|max:255',
        'etage' => 'required|numeric',
        'surface' => 'required|numeric',
        'immeuble_id' => 'required|exists:immeubles,id',
        'residence_id' => 'required|exists:residences,id',
        'member_coproprietaire_id' => 'nullable|exists:member_coproprietaires,id'
    ]);

    // Vérifiez si le champ member_coproprietaire_id est null avant de créer l'appartement
    $data = [
        'nom_appartement' => $request->nom_appartement,
        'etage' => $request->etage,
        'surface' => $request->surface,
        'immeuble_id' => $request->immeuble_id,
        'residence_id' => $request->residence_id,
    ];

    // Si member_coproprietaire_id n'est pas null, l'ajouter aux données
    if ($request->has('member_coproprietaire_id')) {
        $data['member_coproprietaire_id'] = $request->member_coproprietaire_id;
    }

    Appartement::create($data);

    $notification = [
        'message' => 'Appartement ajouté avec succès',
        'alert-type' => 'success'
    ];
    return redirect()->route('all.appartement')->with($notification);
}


    public function EditAppartement($id)
    {
        // Récupérer l'appartement à éditer
        $appartement = Appartement::findOrFail($id);

        // Récupérer la liste des immeubles, des résidences et des copropriétaires disponibles
        $immeubles = Immeuble::all();
        $residences = Residence::all();
        $coproprietaires = MemberCoproprietaire::all();

        // Retourner la vue avec les données de l'appartement, des immeubles, des résidences et des copropriétaires
        return view('backend.appartement.edit_appartement', compact('appartement', 'immeubles', 'residences', 'coproprietaires'));
    }

    public function UpdateAppartement(Request $request, $id)
    {
        // Validation
        $request->validate([
            'nom_appartement' => 'required|unique:appartements|max:255',
            'etage' => 'required|numeric',
            'surface' => 'required|numeric',
            'immeuble_id' => 'required|exists:immeubles,id',
            'residence_id' => 'required|exists:residences,id',
            'member_coproprietaire_id' => 'nullable|exists:member_coproprietaires,id' // Assurez-vous que ce champ est nullable s'il est possible de ne pas avoir de copropriétaire assigné
        ]);

        Appartement::findOrFail($id)->update([
            'nom_appartement' => $request->nom_appartement,
            'etage' => $request->etage,
            'surface' => $request->surface,
            'immeuble_id' => $request->immeuble_id,
            'residence_id' => $request->residence_id,
            'member_coproprietaire_id' => $request->member_coproprietaire_id
        ]);

        $notification = array(
            'message' => 'Appartement modifié avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.appartement')->with($notification);
    }

    public function DeleteAppartement($id)
    {
        Appartement::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Appartement supprimé avec succès',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
