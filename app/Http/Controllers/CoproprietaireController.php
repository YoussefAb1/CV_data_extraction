<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CoproprietaireController extends Controller
{
    public function CoproprietaireDashboard(){

        return view('backend.coproprietaire.index');
    }

    public function CoproprietaireLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/coproprietaire/login');
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

 }

?>
