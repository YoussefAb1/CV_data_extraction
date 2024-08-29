<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\CoproprietaireHistory;
use App\Models\Charge;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Cotisation;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;



class CoproprietaireController extends Controller
{
    public function CoproprietaireDashboard(){

        $user = Auth::user();

        // Trouver le membre copropriétaire
        $memberCoproprietaire = $user->memberCoproprietaire;

        // Obtenir les IDs des appartements associés à ce copropriétaire via l'historique
        $appartementIds = CoproprietaireHistory::where('coproprietaire_id', $memberCoproprietaire->id)
                                               ->pluck('appartement_id');

        // Obtenir les charges associées à ces appartements
        $charges = Charge::whereIn('appartement_id', $appartementIds)
                         ->with(['appartement.immeuble.residence'])
                         ->get();

        return view('backend.coproprietaire.index', compact('charges'));

       }

    public function CoproprietaireLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function CoproprietaireLogin(){
        return view('backend.coproprietaire.coproprietaire_login');
    }


    public function CoproprietaireProfile(){
        $id = Auth::user()-> id;
        $dataProfile = User::find($id);
        return view('backend.coproprietaire.coproprietaire_profile_view', compact('dataProfile'));
    }

    public function CoproprietaireProfileStore(Request $request){
        $id = Auth::user()-> id;
        $data = User::find($id);
        $data->username=$request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->username = $request->username;

        if ($request->file('photo')){
            $file = $request->file('photo');
            $filename = date('YmDHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(
            'message'=> 'Copropriétaire Profile Updated succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function CoproprietaireChangePassword(){

        return view('backend.coproprietaire.coproprietaire_change_password');
    }

    public function CoproprietaireUpdatePassword(Request $request){
        // validation
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed'
        ]);

        //match the old password

        if(!Hash::check($request->oldpassword, auth::user()->password)){
            $notification = array(
                'message'=> 'Old password does not match',
                'alert-type' => 'danger'
            );

            return back()->with($notification);

        }

        //update the new password

        User::whereId(auth()->user()->id)->update([

            'password'=> Hash::make($request->newpassword)
        ]);


        $notification = array(
            'message'=> 'Password change succefully ',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    public function AllCharge()
{
    // Récupérer l'utilisateur authentifié
    $user = Auth::user();
    $charges = Charge::whereHas('appartement', function($query) use ($user) {
        $query->whereHas('coproprietaireHistories', function($subQuery) use ($user) {
            $subQuery->where('coproprietaire_id', $user->memberCoproprietaire->id);
        });
    })->with(['appartement.immeuble.residence'])->get();

    return view('backend.coproprietaire.charge.all_charge', compact('charges'));
}


public function AllCotisation()
{
    $user = Auth::user();

    // Check if the user has a related Coproprietaire
    if (!$user->memberCoproprietaire) {
        // If not, you can redirect back with an error message or handle it appropriately
        return redirect()->back()->withErrors(['message' => 'Aucun copropriétaire associé trouvé.']);
    }

    $cotisations = Cotisation::whereHas('appartement', function($query) use ($user) {
        $query->whereHas('coproprietaireHistories', function($subQuery) use ($user) {
            $subQuery->where('coproprietaire_id', $user->memberCoproprietaire->id);
        });
    })->with(['appartement.immeuble.residence'])->get();

    return view('backend.coproprietaire.cotisation.all_cotisation', compact('cotisations'));
}

    public function AllPaiement()
    {
        $user = Auth::user();

    $paiements = Paiement::whereHas('coproprietaireHistory', function($query) use ($user) {
        $query->where('coproprietaire_id', $user->memberCoproprietaire->id);
    })->with(['coproprietaireHistory.appartement.immeuble.residence'])->get();

    return view('backend.coproprietaire.paiement.all_paiement', compact('paiements'));
    }


    public function downloadPDF($id)
{
    $paiement = Paiement::findOrFail($id);

    $pdf = new Dompdf();
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $pdf->setOptions($options);

    $pdf->loadHtml(View::make('backend.paiement.paiement_pdf', compact('paiement')));
    $pdf->render();

    $pdf->stream('paiement.pdf', ['Attachment' => 0]);
}
    public function AllFacture()
    {
        $user = Auth::user();
        $coproprietaireId = $user->id;

        // Récupérer les IDs des appartements associés au copropriétaire
        $appartementIds = CoproprietaireHistory::where('coproprietaire_id', $coproprietaireId)->pluck('appartement_id');

        // Récupérer les factures associées à ces appartements
        $factures = Facture::whereIn('appartement_id', $appartementIds)->get();

        return view('backend.coproprietaire.facture.all_facture', compact('factures'));
    }
}




