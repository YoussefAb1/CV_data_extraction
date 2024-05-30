<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberSyndic;
use App\Models\User;
use App\Models\Immeuble;
use App\Models\SyndicHistory;


class MemberSyndicController extends Controller
{
    public function AllMemberSyndic()
    {
        $syndics = MemberSyndic::with('user')->latest()->get();
        return view('backend.syndic.all_syndic', compact('syndics'));
    }

    public function AddMemberSyndic()
    {
        $users = User::all();
        return view('backend.syndic.add_syndic', compact('users'));
    }

    public function StoreMemberSyndic(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cin' => 'required|max:255|unique:member_syndics'
        ]);

        MemberSyndic::create($request->all());

        return redirect()->route('all.memberSyndic')->with('success', 'Syndic ajouté avec succès');
    }

    public function EditMemberSyndic($id)
    {
        $syndic = MemberSyndic::with('histories')->findOrFail($id);
        $immeubles = Immeuble::all(); // Obtenez tous les immeubles
        $users = User::all();
        return view('backend.syndic.edit_syndic', compact('syndic', 'users', 'immeubles'));
    }

    public function UpdateMemberSyndic(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cin' => 'required|max:255|unique:member_syndics,cin,' . $id
        ]);

        MemberSyndic::findOrFail($id)->update($request->all());

        return redirect()->route('all.memberSyndic')->with('success', 'Syndic modifié avec succès');
    }

    public function DeleteMemberSyndic($id)
    {
        MemberSyndic::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Syndic supprimé avec succès');
    }


}
