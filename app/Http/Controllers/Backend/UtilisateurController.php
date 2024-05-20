<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Immeuble;

use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    public function AllUtilisateur(){

        $utilisateurs = User::latest()->get();
        return view('backend.utilisateur.all_utilisateur', compact('utilisateurs'));

    }

    public function AddUtilisateur(){
        return view('backend.utilisateur.add_utilisateur');
    }

    public function StoreUtilisateur(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
        'name' => 'required|max:255',
        'username' => 'required|max:255|unique:users,username',
        'email' => 'required|email|max:50|unique:users,email',
        'password' => 'required|min:8',
        'role' => 'required|in:admin,syndic,coproprietaire',
        'status' => 'required|in:actif,inactif,En attente,Bloqué,Supprimé',
    ]);

    // Création d'un nouvel utilisateur
    $user = new User();
    $user->role = $request->role;
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = bcrypt($request->password); // Hash du mot de passe
    $user->status = $request->status;

    // Enregistrez l'utilisateur dans la base de données
    $user->save();

    // Redirigez l'utilisateur vers une autre page après l'ajout
    return redirect()->route('all.utilisateur')->with('success', 'Utilisateur ajouté avec succès');
}

public function EditUtilisateur($id)
{
    // Recherche de l'utilisateur par ID
    $utilisateur = User::find($id);

    // Vérifie si l'utilisateur existe
    if (!$utilisateur) {
        // Redirige l'utilisateur avec un message d'erreur si l'utilisateur n'est pas trouvé
        return redirect()->route('all.utilisateur')->with('error', 'Utilisateur non trouvé.');
    }

    // Rend la vue d'édition avec les données de l'utilisateur
    return view('backend.utilisateur.edit_utilisateur', compact('utilisateur'));
}


    public function UpdateUtilisateur(Request $request){



        User::findOrFail($request->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,

        ]);

        $notification = array(
            'message'=> 'Utilisateur modifiée avec succés',
            'alert-type' => 'success'
        );
        return redirect()->route('all.utilisateur')->with($notification);

    }

    public function DeleteUtilisateur($id){

        User::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Utilisateur supprimée avec succés',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }
}
