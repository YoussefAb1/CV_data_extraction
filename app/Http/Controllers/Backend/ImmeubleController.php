<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Immeuble;
use App\Models\Residence;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ImmeubleController extends Controller
{
    public function AllImmeuble()
{
    $immeubles = Immeuble::with('memberSyndic', 'residence')->get();
    // dd($immeubles); // Ajoutez cette ligne pour déboguer

    return view('backend.immeuble.all_immeuble', compact('immeubles'));
}

    public function AddImmeuble()
    {
        $residences = Residence::all();
        $syndics = Role::where('name', 'Syndic')->first()->users()->get();
        return view('backend.immeuble.add_immeuble', compact('residences', 'syndics'));
    }

    public function StoreImmeuble(Request $request)
{
    $request->validate([
        'nom_immeuble' => 'required|unique:immeubles|max:255',
        'nombre_etages' => 'required|numeric',
        'residence_id' => 'required|exists:residences,id',
        'member_syndic_id' => 'nullable|exists:users,id'
    ]);

    Immeuble::create([
        'nom_immeuble' => $request->nom_immeuble,
        'nombre_etages' => $request->nombre_etages,
        'residence_id' => $request->residence_id,
        'member_syndic_id' => $request->member_syndic_id ?: null // Provide default null if not set
    ]);

    $notification = array(
        'message' => 'Immeuble ajouté avec succès',
        'alert-type' => 'success'
    );

    return redirect()->route('all.immeuble')->with($notification);
}



    public function EditImmeuble($id)
    {
        $immeuble = Immeuble::findOrFail($id);
        $residences = Residence::all();
        $syndics = Role::where('name', 'Syndic')->first()->users()->get();
        return view('backend.immeuble.edit_immeuble', compact('immeuble', 'residences', 'syndics'));
    }

    public function UpdateImmeuble(Request $request, $id)
    {
        $request->validate([
            'nom_immeuble' => 'required|max:255',
            'nombre_etages' => 'required|numeric',
            'residence_id' => 'required|exists:residences,id',
            'member_syndic_id' => 'exists:users,id'
        ]);

        Immeuble::findOrFail($id)->update([
            'nom_immeuble' => $request->nom_immeuble,
            'nombre_etages' => $request->nombre_etages,
            'residence_id' => $request->residence_id,
            'member_syndic_id' => $request->member_syndic_id,
        ]);

        $notification = array(
            'message' => 'Immeuble modifié avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.immeuble')->with($notification);
    }

    public function DeleteImmeuble($id)
    {
        Immeuble::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Immeuble supprimé avec succès',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
