<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appartement;
use App\Models\Immeuble;
use App\Models\Residence;
use App\Models\MemberCoproprietaire;
use App\Models\User;

class AppartementController extends Controller
{
    public function AllAppartement(Request $request)
    {
        $residences = Residence::all();
        // Récupérer les utilisateurs ayant le rôle de copropriétaire
        $coproprietaires = User::role('coproprietaire')->get();

        $appartements = Appartement::query()
            ->with(['immeuble.residence', 'memberCoproprietaire'])
            ->when($request->residence_id, function ($query) use ($request) {
                return $query->whereHas('immeuble.residence', function ($q) use ($request) {
                    $q->where('id', $request->residence_id);
                });
            })
            ->when($request->coproprietaire_id, function ($query) use ($request) {
                return $query->where('member_coproprietaire_id', $request->coproprietaire_id);
            })
            ->latest()
            ->get();

        return view('backend.appartement.all_appartement', compact('appartements', 'residences', 'coproprietaires'));
    }

    public function AddAppartement()
    {
        $immeubles = Immeuble::all();
        $residences = Residence::all();
        // Récupérer les utilisateurs ayant le rôle de copropriétaire
        $coproprietaires = User::role('coproprietaire')->get();

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
        'member_coproprietaire_id' => 'nullable|exists:users,id' // Vérifier l'existence dans la table 'users'
    ]);

    // Créez un tableau des données à enregistrer
    $data = [
        'nom_appartement' => $request->nom_appartement,
        'etage' => $request->etage,
        'surface' => $request->surface,
        'immeuble_id' => $request->immeuble_id,
        'residence_id' => $request->residence_id,
    ];

    // Ajoutez `member_coproprietaire_id` seulement s'il est présent
    if ($request->filled('member_coproprietaire_id')) {
        $data['member_coproprietaire_id'] = $request->member_coproprietaire_id;
    }

    // Créez l'appartement
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
