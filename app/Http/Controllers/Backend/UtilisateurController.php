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
    public function AllUtilisateur(){

        $utilisateurs = User::latest()->get();
        return view('backend.utilisateur.all_utilisateur', compact('utilisateurs'));

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
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'], // Assurez-vous d'ajouter ce champ
            'status' => $validatedData['status'],
        ]);

        $user->assignRole($validatedData['role']);

        return redirect()->route('all.utilisateur')->with('success', 'Utilisateur ajouté avec succès');
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
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|string|exists:roles,name',
        'status' => 'required|string|max:255',
    ]);

    $user = User::findOrFail($request->id);
    $user->update([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'role' => $request->role,
        'status' => $request->status,
    ]);

    // Assigner le rôle mis à jour
    $user->syncRoles([$request->role]);

    return redirect()->route('all.utilisateur')->with('success', 'Utilisateur modifié avec succès');
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
