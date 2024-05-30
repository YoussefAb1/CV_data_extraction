<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Immeuble;
use App\Models\Residence;
use App\Models\MemberSyndic;
use App\Models\SyndicHistory;

class ImmeubleController extends Controller
{
    public function AllImmeuble()

    {
        $residences = Residence::all();
        $immeubles = Immeuble::with('currentSyndic.syndic.user')->get();
        return view('backend.immeuble.all_immeuble', compact('immeubles','residences'));

    }

    public function AddImmeuble()
    {
        $residences = Residence::all();
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

    public function EditImmeuble($id)
    {
        $immeuble = Immeuble::findOrFail($id);
        $residences = Residence::all();
        return view('backend.immeuble.edit_immeuble', compact('immeuble', 'residences'));
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
    $currentHistory = $immeuble->syndicHistory()->whereNull('end_date')->first();
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
$syndicHistory = $immeuble->syndicHistory()->with('memberSyndic.user')->get();

return view('backend.immeuble.history_syndic', compact('immeuble', 'syndicHistory'));
}



}
