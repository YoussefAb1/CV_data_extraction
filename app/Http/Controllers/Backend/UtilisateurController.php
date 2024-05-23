<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Immeuble;
use Spatie\Permission\Models\Role;


use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    public function AllUtilisateur(Request $request)
    {
        $query = User::query();

        // Appliquer les filtres si présents
        if ($request->has('role') && $request->role != '') {
            $query->role($request->role);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $utilisateurs = $query->with('roles')->latest()->get();  // Charger les rôles avec les utilisateurs
        $roles = Role::all();
        $statuses = ['actif', 'inactif', 'En attente', 'Supprimé']; // Liste de tous les statuts possibles

        return view('backend.utilisateur.all_utilisateur', compact('utilisateurs', 'roles', 'statuses'));
    }



    public function AddUtilisateur(){
        $roles = Role::all(); // Récupérer tous les rôles depuis la base de données
        return view('backend.utilisateur.add_utilisateur', compact('roles'));
    }

    public function StoreUtilisateur(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|exists:roles,name',
            'status' => 'required|string',
            // Ajoutez d'autres validations nécessaires pour les champs supplémentaires
        ]);

        // Créez l'utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'status' => $validatedData['status'],
            'role' => $validatedData['role'], // Ajoutez cette ligne pour enregistrer le rôle
        ]);

        // Assignez le rôle à l'utilisateur
        $user->assignRole($validatedData['role']);

        // Enregistrez l'utilisateur dans la base de données
        $user->save();

        $notification = [
            'message' => 'Utilisateur ajouté avec succès',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.utilisateur')->with($notification);
    }

public function EditUtilisateur($id)
{
    // Recherche de l'utilisateur par ID


    $utilisateur = User::findOrFail($id);
    $roles = Role::all(); // Réc

    // Vérifie si l'utilisateur existe
    if (!$utilisateur) {
        // Redirige l'utilisateur avec un message d'erreur si l'utilisateur n'est pas trouvé
        return redirect()->route('all.utilisateur')->with('error', 'Utilisateur non trouvé.');
    }

    // Rend la vue d'édition avec les données de l'utilisateur
    return view('backend.utilisateur.edit_utilisateur', compact('utilisateur', 'roles'));
}


public function UpdateUtilisateur(Request $request)
{
    // Ajouter des règles de validation
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|string|max:50', // Assurez-vous que la longueur maximale correspond à la définition de votre colonne
        'status' => 'required|string|max:255',
    ]);

    User::findOrFail($request->id)->update([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'role' => $request->role,
        'status' => $request->status,
    ]);

    $notification = array(
        'message' => 'Utilisateur modifié avec succès',
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
