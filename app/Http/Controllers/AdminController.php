<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Appartement;
use App\Models\Immeuble;
use App\Models\MemberCoproprietaire;
use App\Models\MemberSyndic;
use App\Models\Residence;



class AdminController extends Controller
{
    public function AdminDashboard(){

        $residencesCount = Residence::count();
        $immeublesCount = Immeuble::count();
        $appartementsCount = Appartement::count();
        $coproprietairesCount = MemberCoproprietaire::count();
        $syndicsCount = MemberSyndic::count();

        return view('admin.index', compact('residencesCount', 'immeublesCount', 'appartementsCount', 'coproprietairesCount', 'syndicsCount'));    }





    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }


    public function AdminLogin(){
        return view('admin.admin_login');
    }


    public function AdminProfile(){
        $id = Auth::user()-> id;
        $dataProfile = User::find($id);
        return view('admin.admin_profile_view', compact('dataProfile'));
    }

    public function AdminProfileStore(Request $request){
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
            'message'=> 'Admin Profile Updated succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function AdminChangePassword(){

        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request){
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

