<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminRole;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    public function __construct(){
        return $this->middleware('auth:admin');
    }
    //
    public function index(){
        return view('admin.public.home');
    }
    public function UserView(){
        $this->authorize('add_user', Permission::class);
        return view('admin.public.role.adduser');
    }

    public function add_role(){
        $this->authorize('add_role', Permission::class);
        $permissions = Permission::all();
        return view('admin.public.role.addRole', compact('permissions'));
    }

    public function seeUser(){
        $this->authorize('add_user', Permission::class);
        $permissions = Permission::all();
        return view('admin.public.role.viewUser', compact('permissions'));
    }

    public function seeRole($id){
        $this->authorize('add_role', Permission::class);
        $roles = Role::find($id);
        return view('admin.public.role.viewRole', compact('roles'));
    }

    public function editRole($id){
        $this->authorize('add_role', Permission::class);
        $roles = Role::find($id);
        $permissions = Permission::all();
        return view('admin.public.role.editRole', compact('roles', 'permissions'));
    }
    public function editUser($id){
        try{
            $ids = Crypt::decrypt($id);
        }
        catch(\Illuminate\Contracts\Encryption\DecryptException $e){
            $notification = array('message' => 'fail to decrypt information, please conttact the admin', 'alert-type' => 'info');
            return redirect()->back()->with($notification);
        }

       // return $ids;
        $this->authorize('add_user', Permission::class);
        $user = Admin::where('id', $ids)->first();
        return view('admin.public.role.editUser', compact('user'));
    }

    public function addUser(Request $req){
        $this->authorize('add_user', Permission::class);
        $this->validate($req, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:App\Admin,email',
            'userName' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
        ]);
        $fname = $req['firstName'];
        $lname = $req['lastName'];
        $email = $req['email'];
        $uname = $req['userName'];
        $gender = $req['gender'];
        $dob = $req['date_of_birth'];
        $roles = $req->input('roles');

        $admins = new Admin();

        $admins->first_name = $fname;
        $admins->last_name = $lname;
        $admins->is_super = 0;
        $admins->email = $email;
        $admins->user_name = $uname;
        $admins->gender = $gender;
        $admins->date_of_birth = $dob;
        $admins->password = bcrypt($uname);

        $admins->save();
        if($admins){
            $user = Admin::where('email', $email)->first();
            $userId = $user->id;

            if($roles){
                $admin = Admin::find($userId);

                foreach ($roles as $role) {

                    $admin->roles()->attach($role);
                }

               // $arr = array();
                $admin_role = DB::table('admin_role')->where('admin_id', $userId)->get();
                foreach($admin_role as $a_r){
                    $role_permission = DB::table('permission_role')->where('role_id', $a_r->role_id)->get();
                    foreach($role_permission as $r_p){
                       // array_push($arr, $r_p);
                        $admin->permissions()->attach($r_p->permission_id);
                    }
                }
               // return $arr;

                if($admin){
                    if (isset(auth()->user()->id)) {
                        $destinationPath = '/image/profile';
                        $filename = $userId.'.'.request()->profile_image->getClientOriginalExtension();
                        request()->profile_image->move(public_path($destinationPath), $filename);
                        DB::table('admins')->where('id', $userId)->update(['profile' => $filename]);

                        $notification = array(
                            'message' => 'You successfully registeted '.$fname.'  '.$lname.', and successfully uploaded his Profile image.!',
                            'alert-type' => 'success'
                        );
                        return redirect()->back()->with($notification);
                    }
                    else{
                        $notify = array(
                            'message' => 'Fail to uplaod profile for '.$fname.'  '.$lname.',  try again.!',
                            'alert-type' => 'success'
                        );
                        return redirect()->back()->with($notify);
                    }
                }
            }
        }
        return redirect()->back()->withInput();
    }

    public function editUserFunction(Request $req){
        $this->authorize('add_user', Permission::class);
        $this->validate($req, [
            'admin_id' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'userName' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
        ]);

        $id = $req['admin_id'];
        $fname = $req['firstName'];
        $lname = $req['lastName'];
        $email = $req['email'];
        $uname = $req['userName'];
        $gender = $req['gender'];
        $dob = $req['date_of_birth'];
        $roles = $req->input('roles');

        $admins = DB::table('admins')->where('id', $id)->update([
            'first_name' => $fname,
            'last_name' => $lname,
            'email' => $email,
            'user_name' => $uname,
            'gender' => $gender,
            'date_of_birth' => $dob,
            'password' => bcrypt($uname),
        ]);

        if($admins){
            $user = Admin::where('email', $email)->first();
            $userId = $user->id;

            if($id){
                $admin_role = DB::table('admin_role')->where('admin_id', $id)->get();
                $admin = Admin::find($userId);

                DB::table('admin_permission')->where('admin_id', $userId)->delete();
                foreach($admin_role as $role){
                    DB::table('admin_role')->where('role_id', $role->role_id)->delete();
                }
                if($roles == null){} else{
                    foreach ($roles as $rol) {
                        $admin->roles()->attach($rol);
                    }
                }

                $admin_role = DB::table('admin_role')->where('admin_id', $userId)->get();
                foreach ($admin_role as $a_r) {
                    $role_permission = DB::table('permission_role')->where('role_id', $a_r->role_id)->get();
                    foreach ($role_permission as $r_p) {
                        // array_push($arr, $r_p);
                        $admin->permissions()->attach($r_p->permission_id);
                    }
                }
                if($admin){
                    if ($req['profile_image'] != '') {
                        // $this->validate($req, [
                        //     'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
                        // ]);

                        $destinationPath = '/image/profile';
                        $filename = $userId.'.'.request()->profile_image->getClientOriginalExtension();
                        request()->profile_image->move(public_path($destinationPath), $filename);
                        DB::table('admins')->where('id', $userId)->update(['profile' => $filename]);

                        $notification = array(
                            'message' => 'You successfully Updated '.$fname.'  '.$lname.', and successfully uploaded his new Profile image.!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('manage.user')->with($notification);
                    }
                    else{
                        $notify = array(
                            'message' => 'You successfully Updated '.$fname.'  '.$lname.', but did not succeed to uploaded a new Profile image.!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('manage.user')->with($notify);
                    }
                }
            }
        }
        return redirect()->back()->withInput();
    }

    public function addRole(Request $req){
        $role = $req['role'];
        $token = $req['_token'];
        $permissions = $req->all();
        // $cc = array();
        if($role){
            if(Role::where('name', $role)->exists()){
                $arr = array('message' => 'the Role '.$role.' Exist already, Enter another one!', 'type' => 'error');
                return $arr;
            }
            else {
                //save the role
                $roles = new Role();
                $roles->name = $role;
                $roles->save();

                $roleId = Role::where('name', $role)->first();
                $role_id = $roleId->id;
                foreach($permissions as $permit){
                    if($permit == $role || $permit == $token){}
                    else{
                      $save_role_permission =  DB::table('permission_role')->insert([
                            ['permission_id' => $permit, 'role_id' => $role_id]
                        ]);
                    }
                }
                if($save_role_permission){
                        $arr = array('message' => 'The role '.$role.' and all the permissions are saved successfully!', 'type' => 'success');
                        return $arr;
                }
            }
        }
    }

    public function editRoleFunction(Request $req){
        $role = $req['role'];
        //$roleid = $req['roleid'];
        $token = $req['_token'];
        $permissions = $req->all();
        $roleid = Role::where('name', $role)->first();
        $roles = Role::find($roleid->id);

        $all_perm = DB::table('permission_role')->where('role_id', $roleid->id)->get();
        $adminrole = DB::table('admin_role')->where('role_id', $roleid->id)->get();
        $arr = array();
        foreach($adminrole as $arole){
            $admins = Admin::find($arole->admin_id);

            $permissionRole = DB::table('permission_role')->where('role_id', $arole->role_id)->get();
            foreach($permissionRole as $permitrole){
               DB::table('admin_permission')->where('permission_id',  $permitrole->permission_id)
                 ->where('admin_id', $arole->admin_id)->delete();
            }

            foreach($permissions as $permit){
                if( $permit == $token || $permit == $role){}
                else{
                    array_push($arr, [$arole->admin_id, $permit]);
                    $admins->permissions()->attach($permit);
                }
            }

        }

        foreach($all_perm as $perm){
            DB::table('permission_role')->where('permission_id', $perm->permission_id)->delete();
        }

        foreach($permissions as $permit){
            if( $permit == $token || $permit == $role){}
            else{
                $roles->permissions()->attach($permit);
            }
        }
        $arr = array('message' => 'the Role '.$role.' and all it permissions have been successfully updated!', 'type' => 'success');

        return $arr;
    }

}
