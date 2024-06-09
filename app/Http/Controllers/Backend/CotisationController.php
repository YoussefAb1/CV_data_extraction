<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cotisation;
use App\Models\Appartement;
use App\Models\MemberCoproprietaire;
use App\Models\MemberSyndic;
use App\Models\SyndicHistory;

class CotisationController extends Controller
{

    public function AllCotisation()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        // Récupérer toutes les cotisations avec les données associées d'appartement, d'immeuble et de résidence
        $cotisations = Cotisation::with(['appartement.immeuble', 'appartement.residence'])->latest()->get();
        // Retourner la vue avec les données des cotisations pour l'admin
        return view('backend.cotisation.all_cotisation', compact('cotisations'));
    } elseif ($user->role === 'syndic') {
        // Récupérer les immeubles associés au syndic
        $immeubles_ids = SyndicHistory::where('syndic_id', $user->id)->pluck('immeuble_id');
        // Récupérer les cotisations associées à ces immeubles
        $cotisations = Cotisation::with(['appartement.immeuble', 'appartement.residence'])
            ->whereHas('appartement', function ($query) use ($immeubles_ids) {
                $query->whereIn('immeuble_id', $immeubles_ids);
            })
            ->latest()
            ->get();
        // Retourner la vue avec les données des cotisations pour le syndic
        return view('backend.cotisation.all_cotisation', compact('cotisations'));
    } else {
        abort(403, 'Unauthorized action.');
    }
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
