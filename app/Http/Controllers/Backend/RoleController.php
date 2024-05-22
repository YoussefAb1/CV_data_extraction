<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    public function AllPermission() {
        $permissions = Permission::with('roles')->get();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    public function AddPermission(){
        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = array(
            'message'=> 'Permission ajoutée avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id) {
        $permissions = Permission::findOrFail($id);
        $roles = Role::where('guard_name', 'web')->get();
        $permissionRoles = $permissions->roles->pluck('id')->toArray();
        return view('backend.pages.permission.edit_permission', compact('permissions', 'roles', 'permissionRoles'));
    }

    public function UpdatePermission(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        $permission = Permission::findOrFail($request->id);
        $permission->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        if ($request->has('roles')) {
            $roles = Role::whereIn('id', $request->roles)->where('guard_name', 'web')->get();
            $permission->syncRoles($roles);
        } else {
            $permission->syncRoles([]);
        }

        $notification = array(
            'message' => 'Permission modifiée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id){
        Permission::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Permission supprimée avec succès',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AllRole(){
        $roles = Role::all();
        return view('backend.pages.role.all_role', compact('roles'));
    }

    public function AddRole(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.pages.role.add_role', compact('roles', 'permissions', 'permission_groups'));
    }

    public function StoreRole(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->where('guard_name', 'web')->get();

        if ($permissions->count() != count($request->permissions)) {
            return redirect()->route('add.role')->withErrors(['permissions' => 'Certaines permissions ne sont pas valides.']);
        }

        $role->syncPermissions($permissions);

        $notification = array(
            'message'=> 'Rôle ajouté avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function EditRole($id){
        $roles = Role::findOrFail($id);
        return view('backend.pages.role.edit_role', compact('roles'));
    }

    public function UpdateRole(Request $request){
        Role::findOrFail($request->id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'=> 'Rôle modifié avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role')->with($notification);
    }

    public function DeleteRole($id){
        Role::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Rôle supprimé avec succès',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    
}
