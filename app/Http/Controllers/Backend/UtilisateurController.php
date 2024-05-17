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
        'name' => 'required|max:50',
        'username' => 'required|unique:users|max:50',
        'email' => 'required|unique:users|max:50',
        'role' => 'required|in:admin,syndic,coproprietaire',
        'status' => 'required',
        'nom_immeuble' => 'required_if:role,syndic', // Champ obligatoire si le rôle est syndic
        // Ajoutez ici les autres règles de validation selon les besoins
    ]);

    // Création d'un nouvel utilisateur
    $user = new User();
    $user->role = $request->role;
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->status = $request->status;

    // Enregistrez l'utilisateur dans la base de données
    $user->save();

    // Si c'est un syndic, associez-le à un immeuble
    if ($request->role === 'syndic') {
        $nom_immeuble = $request->input('nom_immeuble');
        // Recherchez l'immeuble par son nom
        $immeuble = Immeuble::where('nom_immeuble', $nom_immeuble)->first();
        // Vérifiez si l'immeuble existe
        if ($immeuble) {
            // Mettre à jour le syndic avec l'ID de l'immeuble
            $user->immeuble_id = $immeuble->id;
            $user->save();
        } else {
            // Gérer le cas où l'immeuble n'est pas trouvé
            return redirect()->back()->with('error', 'L\'immeuble spécifié n\'existe pas.');
        }
    }

    // Redirigez l'utilisateur vers une autre page après l'ajout
    return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès');
}


    public function EditUtilisateur($id){
        $utilisateurs = User::findOrFail($id);
        return view('backend.utilisateur.edit_utilisateur', compact('utilisateurs'));

    }

    public function UpdateUtilisateur(Request $request){

        $rid=$request->id;

        User::findOrFail($rid)->update([
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
