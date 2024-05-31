<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cotisation;
use App\Models\Appartement;
use App\Models\MemberCoproprietaire;
use App\Models\MemberSyndic;

class CotisationController extends Controller
{

    public function AllCotisation()
    {
        $cotisations = Cotisation::with(['appartement.immeuble', 'appartement.residence'])->latest()->get();
        return view('backend.cotisation.all_cotisation', compact('cotisations'));
    }

    public function AddCotisation()
    {
        $appartements = Appartement::all();
        $coproprietaires = MemberCoproprietaire::all();
        $syndics = MemberSyndic::with('user')->get();

        return view('backend.cotisation.add_cotisation', compact('appartements', 'coproprietaires', 'syndics'));
    }

    public function StoreCotisation(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_cotisation' => 'required|date',
            'description' => 'nullable|string',
            'appartement_id' => 'required|exists:appartements,id',
            'member_coproprietaire_id' => 'required|exists:member_coproprietaires,id',
            'member_syndic_id' => 'required|exists:member_syndics,id'
        ]);

        Cotisation::create($request->all());

        return redirect()->route('all.cotisation')->with('success', 'Cotisation ajoutée avec succès');
    }

    public function EditCotisation($id)
    {
        $cotisation = Cotisation::findOrFail($id);
        $appartements = Appartement::all();
        $coproprietaires = MemberCoproprietaire::all();
        $syndics = MemberSyndic::with('user')->get();

        return view('backend.cotisation.edit_cotisation', compact('cotisation', 'appartements', 'coproprietaires', 'syndics'));
    }

    public function UpdateCotisation(Request $request, $id)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_cotisation' => 'required|date',
            'description' => 'nullable|string',
            'appartement_id' => 'required|exists:appartements,id',
            'member_coproprietaire_id' => 'required|exists:member_coproprietaires,id',
            'member_syndic_id' => 'required|exists:member_syndics,id'
        ]);

        $cotisation = Cotisation::findOrFail($id);
        $cotisation->update($request->all());

        return redirect()->route('all.cotisation')->with('success', 'Cotisation modifiée avec succès');
    }

    public function DeleteCotisation($id)
    {
        Cotisation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Cotisation supprimée avec succès');
    }
}
