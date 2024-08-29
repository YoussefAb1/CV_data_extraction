<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Appartement;
use App\Models\Charge;
use App\Models\MemberCoproprietaire;
use App\Models\MemberSyndic;
use App\Models\Paiement;
use Dompdf\Dompdf;
use Dompdf\Options;

class FactureController extends Controller
{
    public function AllFacture()
    {
        $factures = Facture::latest()->get();
        return view('backend.facture.all_facture', compact('factures'));
    }

    public function AddFacture()
    {
        $paiements = Paiement::all();
        $appartements = Appartement::all();
        $coproprietaires = MemberCoproprietaire::all();
        $syndics = MemberSyndic::all();
        $charges = Charge::all();
        return view('backend.facture.add_facture', compact('paiements', 'appartements', 'coproprietaires', 'syndics', 'charges'));
    }

    public function StoreFacture(Request $request)
    {
        $validated = $request->validate([
            'numero_facture' => 'required|string|max:255|unique:factures,numero_facture',
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date',
            'montant_total' => 'required|numeric',
            'description' => 'nullable|string',
            'paiement_id' => 'required|exists:paiements,id',
            'appartement_id' => 'required|exists:appartements,id',
            'member_coproprietaire_id' => 'required|exists:member_coproprietaires,id',
            'member_syndic_id' => 'required|exists:member_syndics,id',
            'charge_id' => 'required|exists:charges,id',
        ]);

        Facture::create($validated);

        return redirect()->route('all.facture')->with('success', 'Facture créée avec succès');
    }

    public function EditFacture($id)
    {
        $facture = Facture::findOrFail($id);
        $paiements = Paiement::all();
        $appartements = Appartement::all();
        $coproprietaires = MemberCoproprietaire::all();
        $syndics = MemberSyndic::all();
        $charges = Charge::all();
        return view('backend.facture.edit_facture', compact('facture', 'paiements', 'appartements', 'coproprietaires', 'syndics', 'charges'));
    }

    public function UpdateFacture(Request $request, $id)
    {
        $validated = $request->validate([
            'numero_facture' => 'required|string|max:255|unique:factures,numero_facture,'.$id,
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date',
            'montant_total' => 'required|numeric',
            'description' => 'nullable|string',
            'paiement_id' => 'required|exists:paiements,id',
            'appartement_id' => 'required|exists:appartements,id',
            'member_coproprietaire_id' => 'required|exists:member_coproprietaires,id',
            'member_syndic_id' => 'required|exists:member_syndics,id',
            'charge_id' => 'required|exists:charges,id',
        ]);

        $facture = Facture::findOrFail($id);
        $facture->update($validated);

        return redirect()->route('all.facture')->with('success', 'Facture mise à jour avec succès');
    }

    public function DeleteFacture($id)
    {
        $facture = Facture::findOrFail($id);
        $facture->delete();

        return redirect()->route('all.facture')->with('success', 'Facture supprimée avec succès');
    }

    public function generatePDF($id)
    {
        $facture = Facture::findOrFail($id);
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        $html = view('backend.facture.facture_pdf', compact('facture'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream("facture_{$facture->id}.pdf");
    }
}
