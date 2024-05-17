<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Appartement;
use App\Models\Charge;

class FactureController extends Controller
{

    public function AllFacture()
    {
        $factures = Facture::with('appartement', 'charge')->latest()->get();
        return view('backend.facture.all_facture', compact('factures'));
    }

    public function AddFacture()
    {
        $appartements = Appartement::all();
        $charges = Charge::all();
        return view('backend.facture.add_facture', compact('appartements', 'charges'));
    }

    public function StoreFacture(Request $request)
    {
        // validation
        $validatedData = $request->validate([
            'numero_facture' => 'required|unique:factures|max:20',
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date',
            'montant_total' => 'required|numeric',
            'description' => 'required',
            'id_appartement' => 'required|exists:appartements,id',
            'id_charge' => 'required|exists:charges,id',
            'etat' => 'required'
        ]);

        // Créer une nouvelle facture
        Facture::create($validatedData);

        $notification = array(
            'message' => 'Facture ajoutée avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.facture')->with($notification);
    }

    public function EditFacture($id)
    {
        $facture = Facture::findOrFail($id);
        $appartements = Appartement::all();
        $charges = Charge::all();
        return view('backend.facture.edit_facture', compact('facture', 'appartements', 'charges'));
    }

    public function UpdateFacture(Request $request, $id)
    {
        $validatedData = $request->validate([
            'numero_facture' => 'required|max:20',
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date',
            'montant_total' => 'required|numeric',
            'description' => 'required',
            'id_appartement' => 'required|exists:appartements,id',
            'id_charge' => 'required|exists:charges,id',
            'etat' => 'required'
        ]);

        Facture::findOrFail($id)->update($validatedData);

        $notification = array(
            'message' => 'Facture modifiée avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.facture')->with($notification);
    }

    public function DeleteFacture($id)
    {
        Facture::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Facture supprimée avec succès',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    }


