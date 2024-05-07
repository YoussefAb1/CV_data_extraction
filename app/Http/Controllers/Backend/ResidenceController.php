<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Residence;

use Illuminate\Support\Facades\Hash;

class ResidenceController extends Controller
{
    public function AllResidence(){

        $residences = Residence::latest()->get();
        return view('backend.residence.all_residence', compact('residences'));

    }

    public function AddResidence(){
        return view('backend.residence.add_residence');
    }

    public function StoreResidence(Request $request){

        // validation
        $request->validate([
            'nom_residence' => 'required|unique:residences|max:200',
            'adresse_residence' => 'required'
        ]);

        Residence::insert([
            'nom_residence' => $request->nom_residence,
            'adresse_residence' => $request->adresse_residence,

        ]);

        $notification = array(
            'message'=> 'Résidence ajoutée avec succés',
            'alert-type' => 'success'
        );
        return redirect()->route('all.residence')->with($notification);

    }

    public function EditResidence($id){
        $residences = Residence::findOrFail($id);
        return view('backend.residence.edit_residence', compact('residences'));

    }

    public function UpdateResidence(Request $request){

        $rid=$request->id;

        Residence::findOrFail($rid)->update([
            'nom_residence' => $request->nom_residence,
            'adresse_residence' => $request->adresse_residence,

        ]);

        $notification = array(
            'message'=> 'Résidence modifiée avec succés',
            'alert-type' => 'success'
        );
        return redirect()->route('all.residence')->with($notification);

    }

    public function DeleteResidence($id){

        Residence::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Résidence supprimée avec succés',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }

    }





?>
