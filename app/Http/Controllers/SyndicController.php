<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Residence;
use App\Models\Appartement;
use App\Models\SyndicHistory;
use App\Models\MemberCoproprietaire;
use App\Models\Charge;
use App\Models\Cotisation;
use App\Models\MemberSyndic;
use App\Models\CoproprietaireHistory;
use App\Models\Paiement;
use App\Models\Immeuble;
use App\Models\Facture;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;


class SyndicController extends Controller
{
    public function SyndicDashboard()
{
    // Récupérer l'utilisateur authentifié
    $user = auth()->user();

    // Initialiser les variables par défaut
    $nombreAppartements = 0;
    $nombreCoproprietaires = 0;
    $appartements = collect();

    // Vérifier si l'utilisateur a un syndic associé
    if ($user->syndic) {
        // Récupérer l'historique le plus récent du syndic
        $syndicHistory = $user->syndic->histories->last();

        if ($syndicHistory && $syndicHistory->immeuble) {
            // Récupérer l'ID de l'immeuble
            $immeubleId = $syndicHistory->immeuble->id;

            // Compter le nombre d'appartements dans l'immeuble
            $nombreAppartements = Appartement::where('immeuble_id', $immeubleId)->count();

            // Récupérer les appartements dans l'immeuble
            $appartements = Appartement::where('immeuble_id', $immeubleId)->get();

            // Compter le nombre de copropriétaires possédant ces appartements
            $appartementIds = $appartements->pluck('id');
            $nombreCoproprietaires = CoproprietaireHistory::whereIn('appartement_id', $appartementIds)
                                        ->distinct('coproprietaire_id')
                                        ->count('coproprietaire_id');
        }
    }

    return view('backend.syndic.index', compact('nombreAppartements', 'nombreCoproprietaires', 'appartements'));
}




    public function SyndicLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/syndic/login');
    }


    public function SyndicLogin(){
        return view('backend.syndic.syndic_login');
    }


    public function SyndicProfile(){
        $id = Auth::user()-> id;
        $dataProfile = User::find($id);
        return view('backend.syndic.syndic_profile_view', compact('dataProfile'));
    }

    public function SyndicProfileStore(Request $request){
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
            'message'=> 'Syndic Profile Updated succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function SyndicChangePassword(){

        return view('backend.syndic.syndic_change_password');
    }

    public function SyndicUpdatePassword(Request $request){
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

    public function AllAppartement()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Vérifier si l'utilisateur a un syndic associé
        if ($user->syndic) {
            // Récupérer l'immeuble associé au syndic à partir de la table syndic_histories
            $syndicHistory = $user->syndic->histories->last();

            if ($syndicHistory && $syndicHistory->immeuble) {
                // Récupérer les appartements de l'immeuble du syndic
                $appartements = $syndicHistory->immeuble->appartements;

                // Retourner la vue avec les appartements
                return view('backend.syndic.appartement.all_appartement', compact('appartements'));
            } else {
                // Si le syndic n'est pas associé à un immeuble, retourner une vue vide ou un message d'erreur
                return view('backend.syndic.appartement.all_appartement', ['appartements' => collect()])
                    ->withErrors(['message' => 'Le syndic n\'est associé à aucun immeuble.']);
            }
        } else {
            // Si l'utilisateur n'a pas de syndic associé, retourner une vue vide ou un message d'erreur
            return view('backend.syndic.appartement.all_appartement', ['appartements' => collect()])
                ->withErrors(['message' => 'L\'utilisateur n\'est pas associé à un syndic.']);
        }
    }

    public function AddAppartement()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Récupérer l'immeuble et la résidence associés au syndic authentifié
        $immeuble = $user->syndic->histories->last()->immeuble;
        $residence = $immeuble->residence;

        return view('backend.syndic.appartement.add_appartement', compact('immeuble', 'residence'));
    }

    public function StoreAppartement(Request $request)
    {
        $request->validate([
            'nom_appartement' => 'required|string|max:255',
            'etage' => 'required|string|max:255',
            'surface' => 'required|string|max:255',
        ]);

        $appartement = new Appartement($request->all());

        // Récupérer l'utilisateur authentifié
        $user = auth()->user();
        // Ajouter l'immeuble et la résidence associés au syndic authentifié à l'appartement
        $appartement->immeuble_id = $user->syndic->histories->last()->immeuble->id;
        $appartement->residence_id = $user->syndic->histories->last()->immeuble->residence->id;

        $appartement->save();

        return redirect()->route('syndic.all.appartement')->with('success', 'Appartement ajouté avec succès');
    }



    public function EditAppartement($id)
    {
        $appartement = Appartement::findOrFail($id);
        // Récupérer l'immeuble associé à l'appartement
        $immeuble = $appartement->immeuble;
        // Récupérer la résidence associée à l'immeuble
        $residence = $immeuble->residence;

        return view('backend.syndic.appartement.edit_appartement', compact('appartement', 'immeuble', 'residence'));
    }



    public function UpdateAppartement(Request $request, $id)
    {
        $request->validate([
            'nom_appartement' => 'required|string|max:255',
            'etage' => 'required|string|max:255',
            'surface' => 'required|string|max:255',
        ]);

        $appartement = Appartement::findOrFail($id);
        $appartement->update($request->all());

        return redirect()->route('syndic.all.appartement')->with('success', 'Appartement mis à jour avec succès');
    }


    public function DeleteAppartement($id)
    {
        Appartement::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Appartement supprimé avec succès');
    }


    public function AllCharge()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Vérifier si l'utilisateur a un syndic associé
        if ($user->syndic) {
            // Récupérer l'immeuble associé au syndic à partir de la table syndic_histories
            $syndicHistory = $user->syndic->histories->last();

            if ($syndicHistory && $syndicHistory->immeuble) {
                // Récupérer les charges des appartements de l'immeuble du syndic
                $charges = Charge::whereHas('appartement', function($query) use ($syndicHistory) {
                    $query->where('immeuble_id', $syndicHistory->immeuble->id);
                })->get();

                // Retourner la vue avec les charges
                return view('backend.syndic.charge.all_charge', compact('charges'));
            } else {
                // Si le syndic n'est pas associé à un immeuble, retourner une vue vide ou un message d'erreur
                return view('backend.syndic.charge.all_charge', ['charges' => collect()])
                    ->withErrors(['message' => 'Le syndic n\'est associé à aucun immeuble.']);
            }
        } else {
            // Si l'utilisateur n'a pas de syndic associé, retourner une vue vide ou un message d'erreur
            return view('backend.syndic.charge.all_charge', ['charges' => collect()])
                ->withErrors(['message' => 'L\'utilisateur n\'est pas associé à un syndic.']);
        }
    }



    public function AddCharge()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Récupérer l'immeuble et la résidence associés au syndic authentifié
        $immeuble = $user->syndic->histories->last()->immeuble;
        $residence = $immeuble->residence;

        // Récupérer les appartements associés à l'immeuble
        $appartements = $immeuble->appartements;

        return view('backend.syndic.charge.add_charge', compact('immeuble', 'residence', 'appartements'));
    }



    public function StoreCharge(Request $request)
    {
        $request->validate([
            'designation' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'montant' => 'required|numeric',
            'appartement_id' => 'required|exists:appartements,id',
            'statut' => 'required|string|max:255',
        ]);

        $charge = new Charge($request->all());
        $charge->save();

        return redirect()->route('syndic.all.charge')->with('success', 'Charge ajoutée avec succès');
    }



    public function EditCharge($id)
    {
        $charge = Charge::findOrFail($id);

        // Récupérer l'immeuble et la résidence associés au syndic authentifié
        $immeuble = $charge->appartement->immeuble;
        $residence = $immeuble->residence;

        // Récupérer les appartements associés à l'immeuble
        $appartements = $immeuble->appartements;

        return view('backend.syndic.charge.edit_charge', compact('charge', 'immeuble', 'residence', 'appartements'));
    }




    public function UpdateCharge(Request $request, $id)
    {
        $request->validate([
            'designation' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'montant' => 'required|numeric',
            'appartement_id' => 'required|exists:appartements,id',
            'statut' => 'required|string|max:255',
        ]);

        $charge = Charge::findOrFail($id);
        $charge->update($request->all());

        return redirect()->route('syndic.all.charge')->with('success', 'Charge mise à jour avec succès');
    }



    public function DeleteCharge($id)
    {
        Charge::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Charge supprimée avec succès');
    }



    public function AllCotisation()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Vérifier si l'utilisateur a un syndic associé
        if ($user->syndic) {
            // Récupérer l'immeuble associé au syndic à partir de la table syndic_histories
            $syndicHistory = $user->syndic->histories->last();

            if ($syndicHistory && $syndicHistory->immeuble) {
                // Récupérer les cotisations des appartements de l'immeuble du syndic
                $cotisations = Cotisation::whereHas('appartement', function($query) use ($syndicHistory) {
                    $query->where('immeuble_id', $syndicHistory->immeuble->id);
                })->get();

                // Retourner la vue avec les cotisations
                return view('backend.syndic.cotisation.all_cotisation', compact('cotisations'));
            } else {
                // Si le syndic n'est pas associé à un immeuble, retourner une vue vide ou un message d'erreur
                return view('backend.syndic.cotisation.all_cotisation', ['cotisations' => collect()])
                    ->withErrors(['message' => 'Le syndic n\'est associé à aucun immeuble.']);
            }
        } else {
            // Si l'utilisateur n'a pas de syndic associé, retourner une vue vide ou un message d'erreur
            return view('backend.syndic.cotisation.all_cotisation', ['cotisations' => collect()])
                ->withErrors(['message' => 'L\'utilisateur n\'est pas associé à un syndic.']);
        }
    }




    public function AddCotisation()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Récupérer l'immeuble et la résidence associés au syndic authentifié
        $immeuble = $user->syndic->histories->last()->immeuble;
        $residence = $immeuble->residence;

        // Récupérer les appartements associés à l'immeuble
        $appartements = $immeuble->appartements;

        return view('backend.syndic.cotisation.add_cotisation', compact('immeuble', 'residence', 'appartements'));
    }


    public function StoreCotisation(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_cotisation' => 'required|date',
            'description' => 'required|string|max:255',
            'appartement_id' => 'required|exists:appartements,id',
        ]);

        // Récupérer l'enregistrement correspondant dans la table 'coproprietaire_histories'
        $coproprietaire_history = CoproprietaireHistory::where('appartement_id', $request->appartement_id)->latest()->first();

        if ($coproprietaire_history) {
            // Si un enregistrement est trouvé, récupérer l'ID du copropriétaire
            $member_coproprietaire_id = $coproprietaire_history->coproprietaire_id;

            // Récupérer l'ID du syndic authentifié
            $user = auth()->user();
            $member_syndic_id = $user->syndic->id;

            // Créer une nouvelle cotisation avec le membre copropriétaire et le syndic associés
            $cotisation = new Cotisation($request->all());
            $cotisation->member_coproprietaire_id = $member_coproprietaire_id;
            $cotisation->member_syndic_id = $member_syndic_id;
            $cotisation->save();

            return redirect()->route('syndic.all.cotisation')->with('success', 'Cotisation ajoutée avec succès');
        } else {
            // Si aucun enregistrement n'est trouvé dans 'coproprietaire_histories', renvoyer une erreur
            return redirect()->back()->withErrors(['message' => 'Aucun copropriétaire associé à cet appartement']);
        }
    }



    public function EditCotisation($id)
    {
        $cotisation = Cotisation::findOrFail($id);

        // Récupérer l'immeuble et la résidence associés au syndic authentifié
        $immeuble = $cotisation->appartement->immeuble;
        $residence = $immeuble->residence;

        // Récupérer les appartements associés à l'immeuble
        $appartements = $immeuble->appartements;

        return view('backend.syndic.cotisation.edit_cotisation', compact('cotisation', 'immeuble', 'residence', 'appartements'));
    }



    public function UpdateCotisation(Request $request, $id)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_cotisation' => 'required|date',
            'description' => 'required|string|max:255',
            'appartement_id' => 'required|exists:appartements,id',
        ]);

        $cotisation = Cotisation::findOrFail($id);
        $cotisation->update($request->all());

        return redirect()->route('syndic.all.cotisation')->with('success', 'Cotisation mise à jour avec succès');
    }



    public function DeleteCotisation($id)
    {
        Cotisation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Cotisation supprimée avec succès');
    }


    public function AllPaiement()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Vérifier si l'utilisateur a un syndic associé
        if ($user->syndic) {
            // Récupérer l'immeuble associé au syndic à partir de la table syndic_histories
            $syndicHistory = $user->syndic->histories->last();

            if ($syndicHistory && $syndicHistory->immeuble) {
                // Récupérer les paiements associés aux appartements de l'immeuble du syndic
                $paiements = Paiement::whereHas('syndicHistory', function ($query) use ($syndicHistory) {
                    $query->where('immeuble_id', $syndicHistory->immeuble->id);
                })->get();

                // Retourner la vue avec les paiements
                return view('backend.syndic.paiement.all_paiement', compact('paiements'));
            } else {
                // Si le syndic n'est pas associé à un immeuble, retourner une vue vide ou un message d'erreur
                return view('backend.syndic.paiement.all_paiement', ['paiements' => collect()])
                    ->withErrors(['message' => 'Le syndic n\'est associé à aucun immeuble.']);
            }
        } else {
            // Si l'utilisateur n'a pas de syndic associé, retourner une vue vide ou un message d'erreur
            return view('backend.syndic.paiement.all_paiement', ['paiements' => collect()])
                ->withErrors(['message' => 'L\'utilisateur n\'est pas associé à un syndic.']);
        }
    }


    public function AddPaiement()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Récupérer l'immeuble et la résidence associés au syndic authentifié
        $immeuble = $user->syndic->histories->last()->immeuble;
        $residence = $immeuble->residence;

        // Récupérer les appartements associés à l'immeuble
        $appartements = $immeuble->appartements;

        // Récupérer les cotisations associées aux appartements de l'immeuble
        $cotisations = Cotisation::whereHas('appartement', function ($query) use ($immeuble) {
            $query->where('immeuble_id', $immeuble->id);
        })->get();

        return view('backend.syndic.paiement.add_paiement', compact('immeuble', 'residence', 'appartements', 'cotisations'));
    }


    public function StorePaiement(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
            'methode_paiement' => 'required|string|max:255',
            'cotisation_id' => 'required|exists:cotisations,id',
            'coproprietaire_history_id' => 'required|exists:coproprietaire_histories,id',
        ]);

        $paiement = new Paiement($request->all());
        $paiement->save();

        return redirect()->route('syndic.all.paiement')->with('success', 'Paiement ajouté avec succès');
    }



    public function EditPaiement($id)
    {
        $paiement = Paiement::findOrFail($id);

        // Récupérer l'immeuble et la résidence associés au syndic authentifié
        $immeuble = $paiement->syndicHistory->immeuble;
        $residence = $immeuble->residence;

        // Récupérer les appartements associés à l'immeuble
        $appartements = $immeuble->appartements;

        // Récupérer les cotisations associées aux appartements de l'immeuble
        $cotisations = Cotisation::whereHas('appartement', function ($query) use ($immeuble) {
            $query->where('immeuble_id', $immeuble->id);
        })->get();

        return view('backend.syndic.paiement.edit_paiement', compact('paiement', 'immeuble', 'residence', 'appartements', 'cotisations'));
    }


    public function UpdatePaiement(Request $request, $id)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
            'methode_paiement' => 'required|string|max:255',
            'cotisation_id' => 'required|exists:cotisations,id',
            'coproprietaire_history_id' => 'required|exists:coproprietaire_histories,id',
        ]);

        $paiement = Paiement::findOrFail($id);
        $paiement->update($request->all());

        return redirect()->route('syndic.all.paiement')->with('success', 'Paiement mis à jour avec succès');
    }



    public function DeletePaiement($id)
    {
        Paiement::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Paiement supprimé avec succès');
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


    public function AllMemberCoproprietaire()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Vérifier si l'utilisateur a un syndic associé
        if ($user->syndic) {
            // Récupérer l'immeuble associé au syndic à partir de la table syndic_histories
            $syndicHistory = $user->syndic->histories->last();

            if ($syndicHistory && $syndicHistory->immeuble) {
                // Récupérer les copropriétaires associés aux appartements de l'immeuble du syndic
                $coproprietaires = MemberCoproprietaire::whereHas('coproprietaireHistories', function ($query) use ($syndicHistory) {
                    $query->whereHas('appartement', function ($query) use ($syndicHistory) {
                        $query->where('immeuble_id', $syndicHistory->immeuble->id);
                    });
                })->get();

                // Retourner la vue avec les copropriétaires
                return view('backend.syndic.coproprietaire.all_coproprietaire', compact('coproprietaires'));
            } else {
                // Si le syndic n'est pas associé à un immeuble, retourner une vue vide ou un message d'erreur
                return view('backend.syndic.coproprietaire.all_coproprietaire', ['coproprietaires' => collect()])
                    ->withErrors(['message' => 'Le syndic n\'est associé à aucun immeuble.']);
            }
        } else {
            // Si l'utilisateur n'a pas de syndic associé, retourner une vue vide ou un message d'erreur
            return view('backend.syndic.coproprietaire.all_coproprietaire', ['coproprietaires' => collect()])
                ->withErrors(['message' => 'L\'utilisateur n\'est pas associé à un syndic.']);
        }
    }


    public function AddMemberCoproprietaire()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Récupérer l'immeuble et la résidence associés au syndic authentifié
        $immeuble = $user->syndic->histories->last()->immeuble;
        $residence = $immeuble->residence;

        // Récupérer les appartements associés à l'immeuble
        $appartements = $immeuble->appartements;

        return view('backend.syndic.coproprietaire.add_coproprietaire', compact('immeuble', 'residence', 'appartements'));
    }


    public function StoreMemberCoproprietaire(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cin' => 'required|string|max:255|unique:coproprietaires',
            'type' => 'required|string|max:255',
            'appartement_id' => 'required|exists:appartements,id',
        ]);

        $coproprietaire = new MemberCoproprietaire($request->all());
        $coproprietaire->save();

        return redirect()->route('syndic.all.memberCoproprietaire')->with('success', 'Copropriétaire ajouté avec succès');
    }


    public function EditMemberCoproprietaire($id)
    {
        $coproprietaire = MemberCoproprietaire::findOrFail($id);

        // Récupérer l'immeuble et la résidence associés au syndic authentifié
        $immeuble = $coproprietaire->histories->last()->appartement->immeuble;
        $residence = $immeuble->residence;

        // Récupérer les appartements associés à l'immeuble
        $appartements = $immeuble->appartements;

        return view('backend.syndic.coproprietaire.edit_coproprietaire', compact('coproprietaire', 'immeuble', 'residence', 'appartements'));
    }


    public function UpdateMemberCoproprietaire(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cin' => 'required|string|max:255|unique:coproprietaires,cin,' . $id,
            'type' => 'required|string|max:255',
            'appartement_id' => 'required|exists:appartements,id',
        ]);

        $coproprietaire = MemberCoproprietaire::findOrFail($id);
        $coproprietaire->update($request->all());

        return redirect()->route('syndic.all.memberCoproprietaire')->with('success', 'Copropriétaire mis à jour avec succès');
    }


    public function DeleteMemberCoproprietaire($id)
    {
        MemberCoproprietaire::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Copropriétaire supprimé avec succès');
    }



    public function AllFacture(Request $request)
{
    // Récupérer l'utilisateur authentifié
    $user = auth()->user();

    // Vérifier si l'utilisateur a un syndic associé
    if ($user->syndic) {
        // Récupérer l'immeuble associé au syndic à partir de la table syndic_histories
        $syndicHistory = $user->syndic->histories->last();

        if ($syndicHistory && $syndicHistory->immeuble) {
            // Récupérer les factures associées à l'immeuble du syndic avec des fonctionnalités de recherche et de filtrage
            $query = Facture::query();

            if ($request->filled('numero_facture')) {
                $query->where('numero_facture', 'like', '%' . $request->numero_facture . '%');
            }

            if ($request->filled('date_emission')) {
                $query->where('date_emission', $request->date_emission);
            }

            if ($request->filled('date_echeance')) {
                $query->where('date_echeance', $request->date_echeance);
            }

            if ($request->filled('paiement_id')) {
                $query->where('paiement_id', $request->paiement_id);
            }

            $factures = $query->whereHas('paiement', function ($query) use ($syndicHistory) {
                $query->whereHas('syndicHistory', function ($query) use ($syndicHistory) {
                    $query->where('immeuble_id', $syndicHistory->immeuble->id);
                });
            })->get();

            return view('backend.syndic.facture.all_facture', compact('factures'));
        } else {
            return view('backend.syndic.facture.all_facture', ['factures' => collect()])
                ->withErrors(['message' => 'Le syndic n\'est associé à aucun immeuble.']);
        }
    } else {
        return view('backend.syndic.facture.all_facture', ['factures' => collect()])
            ->withErrors(['message' => 'L\'utilisateur n\'est pas associé à un syndic.']);
    }
}


public function AddFacture()
{
    $paiements = Paiement::all(); // ou filtrer par les paiements pertinents
    return view('backend.syndic.facture.add_facture', compact('paiements'));
}


public function StoreFacture(Request $request)
{
    $request->validate([
        'numero_facture' => 'required|string|max:255|unique:factures',
        'date_emission' => 'required|date',
        'date_echeance' => 'required|date|after_or_equal:date_emission',
        'montant_total' => 'required|numeric',
        'description' => 'nullable|string',
        'paiement_id' => 'required|exists:paiements,id',
    ]);

    $facture = new Facture($request->all());
    $facture->save();

    return redirect()->route('syndic.all.facture')->with('success', 'Facture ajoutée avec succès');
}


public function EditFacture($id)
{
    $facture = Facture::findOrFail($id);
    $paiements = Paiement::all(); // ou filtrer par les paiements pertinents

    return view('backend.syndic.facture.edit_facture', compact('facture', 'paiements'));
}


public function UpdateFacture(Request $request, $id)
{
    $request->validate([
        'numero_facture' => 'required|string|max:255|unique:factures,numero_facture,' . $id,
        'date_emission' => 'required|date',
        'date_echeance' => 'required|date|after_or_equal:date_emission',
        'montant_total' => 'required|numeric',
        'description' => 'nullable|string',
        'paiement_id' => 'required|exists:paiements,id',
    ]);

    $facture = Facture::findOrFail($id);
    $facture->update($request->all());

    return redirect()->route('syndic.all.facture')->with('success', 'Facture mise à jour avec succès');
}


public function DeleteFacture($id)
{
    Facture::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Facture supprimée avec succès');
}



    // public function generatePDF()
    // {
    //     $factures = Facture::get();

    //     $data = [
    //         'title' => 'DigiSyndic',
    //         'date' => date('m/d/Y'),
    //         'factures' => $factures
    //     ];

    //     $pdf = PDF::loadView('factures.facturePDF', $data);

    //     return $pdf->download('Facture.pdf');
    // }




 }

