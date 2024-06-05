<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Immeuble;
use App\Models\Residence;
<<<<<<< HEAD
use App\Models\MemberSyndic;
use App\Models\SyndicHistory;
=======
use App\Models\User;
use Spatie\Permission\Models\Role;
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364

class ImmeubleController extends Controller
{
    public function AllImmeuble()
<<<<<<< HEAD

    {
        $residences = Residence::all();
        $immeubles = Immeuble::with('currentSyndic.syndic.user')->get();
        return view('backend.immeuble.all_immeuble', compact('immeubles','residences'));

    }
=======
{
    $immeubles = Immeuble::with('memberSyndic', 'residence')->get();
    // dd($immeubles); // Ajoutez cette ligne pour déboguer

    return view('backend.immeuble.all_immeuble', compact('immeubles'));
}
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364

    public function AddImmeuble()
    {
        $residences = Residence::all();
<<<<<<< HEAD
        return view('backend.immeuble.add_immeuble', compact('residences'));
    }

    public function StoreImmeuble(Request $request)
    {
        $request->validate([
            'nom_immeuble' => 'required|unique:immeubles|max:255',
            'nombre_etages' => 'required|numeric',
            'residence_id' => 'required|exists:residences,id'
        ]);

        Immeuble::create($request->all());

        return redirect()->route('all.immeuble')->with('success', 'Immeuble ajouté avec succès');
    }
=======
        $syndics = Role::where('name', 'Syndic')->first()->users()->get();
        return view('backend.immeuble.add_immeuble', compact('residences', 'syndics'));
    }

    public function StoreImmeuble(Request $request)
{
    $request->validate([
        'nom_immeuble' => 'required|unique:immeubles|max:255',
        'nombre_etages' => 'required|numeric',
        'residence_id' => 'required|exists:residences,id',
        'member_syndic_id' => 'nullable|exists:users,id'
    ]);

    Immeuble::create([
        'nom_immeuble' => $request->nom_immeuble,
        'nombre_etages' => $request->nombre_etages,
        'residence_id' => $request->residence_id,
        'member_syndic_id' => $request->member_syndic_id ?: null // Provide default null if not set
    ]);

    $notification = array(
        'message' => 'Immeuble ajouté avec succès',
        'alert-type' => 'success'
    );

    return redirect()->route('all.immeuble')->with($notification);
}


>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364

    public function EditImmeuble($id)
    {
        $immeuble = Immeuble::findOrFail($id);
        $residences = Residence::all();
<<<<<<< HEAD
        return view('backend.immeuble.edit_immeuble', compact('immeuble', 'residences'));
=======
        $syndics = Role::where('name', 'Syndic')->first()->users()->get();
        return view('backend.immeuble.edit_immeuble', compact('immeuble', 'residences', 'syndics'));
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
    }

    public function UpdateImmeuble(Request $request, $id)
    {
        $request->validate([
            'nom_immeuble' => 'required|max:255',
            'nombre_etages' => 'required|numeric',
            'residence_id' => 'required|exists:residences,id'
        ]);

        Immeuble::findOrFail($id)->update($request->all());

        return redirect()->route('all.immeuble')->with('success', 'Immeuble modifié avec succès');
    }

    public function DeleteImmeuble($id)
    {
        Immeuble::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Immeuble supprimé avec succès');
    }



    public function AddSyndicToImmeuble($immeubleId)
    {
        $immeuble = Immeuble::findOrFail($immeubleId);
        $syndics = MemberSyndic::with('user')->get();
        return view('backend.immeuble.add_syndic_to_immeuble', compact('immeuble', 'syndics'));
    }

    public function StoreSyndicToImmeuble(Request $request, $immeubleId)
{
    $immeuble = Immeuble::findOrFail($immeubleId);

    // Terminer l'association précédente si elle existe
    $currentHistory = $immeuble->syndicHistories()->whereNull('end_date')->first();
    if ($currentHistory) {
        $currentHistory->end_date = $request->start_date;
        $currentHistory->save();
    }

    // Créer une nouvelle association
    SyndicHistory::create([
        'immeuble_id' => $immeuble->id,
        'syndic_id' => $request->member_syndic_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    return redirect()->route('all.immeuble')->with('success', 'Syndic ajouté avec succès');
}

    public function index()
    {
        $immeubles = Immeuble::with('syndicHistory.syndic.user')->get();
        return view('backend.immeuble.all_immeuble', compact('immeubles'));
    }


public function syndicHistory($immeubleId)
{
$immeuble = Immeuble::findOrFail($immeubleId);
$syndicHistory = $immeuble->syndicHistories()->with('memberSyndic.user')->get();

return view('backend.immeuble.history_syndic', compact('immeuble', 'syndicHistory'));
}



}
