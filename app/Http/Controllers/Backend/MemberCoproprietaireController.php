<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberCoproprietaire;
use App\Models\User;

class MemberCoproprietaireController extends Controller
{
    public function AllMemberCoproprietaire()
    {
        $coproprietaires = MemberCoproprietaire::with('user')->latest()->get();
        return view('backend.coproprietaire.all_coproprietaire', compact('coproprietaires'));
    }

    public function AddMemberCoproprietaire()
    {
        $users = User::all();
        return view('backend.coproprietaire.add_coproprietaire', compact('users'));
    }

    public function StoreMemberCoproprietaire(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cin' => 'required|unique:member_coproprietaires|max:255',
            'name' => 'required',
            'type' => 'required|in:promoteur,proprietaire,locataire'
        ]);

        MemberCoproprietaire::create($request->all());

        return redirect()->route('all.memberCoproprietaire')->with('success', 'Copropriétaire ajouté avec succès');
    }

    public function EditMemberCoproprietaire($id)
    {
        $coproprietaire = MemberCoproprietaire::with('coproprietaireHistories')->findOrFail($id);
        $users = User::all();
        return view('backend.coproprietaire.edit_coproprietaire', compact('coproprietaire', 'users'));
    }

    public function UpdateMemberCoproprietaire(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cin' => 'required|max:255|unique:member_coproprietaires,cin,' . $id,
            'name' => 'required',
            'type' => 'required|in:promoteur,proprietaire,locataire'
        ]);

        MemberCoproprietaire::findOrFail($id)->update($request->all());

        return redirect()->route('all.memberCoproprietaire')->with('success', 'Copropriétaire modifié avec succès');
    }

    public function DeleteMemberCoproprietaire($id)
    {
        MemberCoproprietaire::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Copropriétaire supprimé avec succès');
    }
}
