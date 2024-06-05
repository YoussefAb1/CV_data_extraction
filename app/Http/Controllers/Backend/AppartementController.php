<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appartement;
use App\Models\CoproprietaireHistory;
use App\Models\MemberCoproprietaire;
use App\Models\Immeuble;
use App\Models\Residence;
<<<<<<< HEAD

=======
use App\Models\MemberCoproprietaire;
use App\Models\User;
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364

class AppartementController extends Controller
{
    public function AllAppartement(Request $request)
    {
<<<<<<< HEAD
        $appartements = Appartement::with('coproprietaireHistories.coproprietaire.user')->get();
        return view('backend.appartement.all_appartement', compact('appartements'));
=======
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
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
    }

    public function AddAppartement()
    {
        $immeubles = Immeuble::all();
        $residences = Residence::all();
<<<<<<< HEAD
        return view('backend.appartement.add_appartement', compact('immeubles', 'residences'));
=======
        // Récupérer les utilisateurs ayant le rôle de copropriétaire
        $coproprietaires = User::role('coproprietaire')->get();

        return view('backend.appartement.add_appartement', compact('immeubles', 'residences', 'coproprietaires'));
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
    }


    public function StoreAppartement(Request $request)
<<<<<<< HEAD
    {
        $request->validate([
            'nom_appartement' => 'required|unique:appartements|max:255',
            'etage' => 'required',
            'surface' => 'required',
            'immeuble_id' => 'required|exists:immeubles,id',
            'residence_id' => 'required|exists:residences,id'
        ]);

        Appartement::create($request->all());

        return redirect()->route('all.appartement')->with('success', 'Appartement ajouté avec succès');
    }

=======
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


>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
    public function EditAppartement($id)
    {
        $appartement = Appartement::findOrFail($id);
        return view('backend.appartement.edit_appartement', compact('appartement'));
    }

    public function UpdateAppartement(Request $request, $id)
    {
        $request->validate([
            'nom_appartement' => 'required|max:255',
            'etage' => 'required',
            'surface' => 'required',
            'immeuble_id' => 'required|exists:immeubles,id',
            'residence_id' => 'required|exists:residences,id'
        ]);

        Appartement::findOrFail($id)->update($request->all());

        return redirect()->route('all.appartement')->with('success', 'Appartement modifié avec succès');
    }

    public function DeleteAppartement($id)
    {
        Appartement::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Appartement supprimé avec succès');
    }

    public function AddCoproprietaireToAppartement($appartementId)
    {
        $appartement = Appartement::findOrFail($appartementId);
        $coproprietaires = MemberCoproprietaire::with('user')->get();

        return view('backend.appartement.add_coproprietaire_to_appartement', compact('appartement', 'coproprietaires'));
    }

    public function StoreCoproprietaireToAppartement(Request $request, $appartementId)
    {
        $appartement = Appartement::findOrFail($appartementId);

        // Terminer l'association précédente si elle existe
        $currentHistory = $appartement->coproprietaireHistories()->whereNull('end_date')->first();
        if ($currentHistory) {
            $currentHistory->end_date = $request->start_date;
            $currentHistory->save();
        }

        // Créer une nouvelle association
        CoproprietaireHistory::create([
            'appartement_id' => $appartement->id,
            'coproprietaire_id' => $request->coproprietaire_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('all.appartement')->with('success', 'Copropriétaire ajouté avec succès');
    }

    public function CoproprietaireHistory($appartementId)
{
    $appartement = Appartement::findOrFail($appartementId);
    $coproprietaireHistories = $appartement->coproprietaireHistories()->with('coproprietaire.user')->get();

    return view('backend.appartement.history_coproprietaire_appartement', compact('appartement', 'coproprietaireHistories'));
}

}
