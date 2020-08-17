<?php

namespace App\Policies;

use App\Admin;
use App\AdminPermission;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create_income(Admin $user)
    {
        $permission =Permission::where('name_slug', 'create_income')->first();
        if(DB::table('admin_permission')
            ->where('permission_id', $permission->id)
            ->where('admin_id', $user->id)
            ->exists() || $user->is_super == 1){
            return true;
        } else {
            return false;
        }
    }

    public function create_expenses(Admin $user)
    {
        $permission =Permission::where('name_slug', 'create_expenses')->first();
        if(DB::table('admin_permission')
                ->where('permission_id', $permission->id)
                ->where('admin_id', $user->id)
                ->exists()|| $user->is_super == 1){
            return true;
        } else {
            return false;
        }
    }

    public function receive_fees(Admin $user)
        {
            $permission =Permission::where('name_slug', 'receive_fees')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
            }
        }

    public function record_expense(Admin $user)
        {
            $permission =Permission::where('name_slug', 'record_expense')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function report_fees(Admin $user)
        {
            $permission =Permission::where('name_slug', 'report_fees')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function give_scholarship(Admin $user)
        {
            $permission =Permission::where('name_slug', 'give_scholarship')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function scholarship_report(Admin $user)
        {
            $permission =Permission::where('name_slug', 'scholarship_report')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }
    public function income_statement(Admin $user)
        {
            $permission =Permission::where('name_slug', 'income_statement')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function print_reciept(Admin $user)
        {
            $permission =Permission::where('name_slug', 'print_reciept')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function create_class(Admin $user)
        {
            $permission =Permission::where('name_slug', 'create_class')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function edit_delete_class(Admin $user)
        {
            $permission =Permission::where('name_slug', 'edit_delete_class')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function sub_class(Admin $user)
        {
            $permission =Permission::where('name_slug', 'sub_class')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function see_class(Admin $user)
        {
            $permission =Permission::where('name_slug', 'see_class')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function create_sector(Admin $user)
        {
            $permission =Permission::where('name_slug', 'create_sector')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function create_backgorund(Admin $user)
        {
            $permission =Permission::where('name_slug', 'create_backgorund')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function see_sector(Admin $user)
        {
            $permission =Permission::where('name_slug', 'see_sector')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function see_background(Admin $user)
        {
            $permission =Permission::where('name_slug', 'see_background')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    // student permission

    public function add_student(Admin $user)
        {
            $permission =Permission::where('name_slug', 'add_student')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function class_list(Admin $user)
        {
            $permission =Permission::where('name_slug', 'class_list')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function promote_student(Admin $user)
        {
            $permission =Permission::where('name_slug', 'promote_student')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function change_class(Admin $user)
        {
            $permission =Permission::where('name_slug', 'change_class')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    //subjects

    public function create_subject(Admin $user)
        {
            $permission =Permission::where('name_slug', 'create_subject')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function all_subject(Admin $user)
        {
            $permission =Permission::where('name_slug', 'all_subject')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    // teachers permission

    public function add_teacher(Admin $user)
        {
            $permission =Permission::where('name_slug', 'add_teacher')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function assign_subjects(Admin $user)
        {
            $permission =Permission::where('name_slug', 'assign_subjects')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function teacher_subjects(Admin $user)
        {
            $permission =Permission::where('name_slug', 'teacher_subjects')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    // discipline

    public function add_type(Admin $user)
        {
            $permission =Permission::where('name_slug', 'add_type')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function record_student(Admin $user)
        {
            $permission =Permission::where('name_slug', 'record_student')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function view_record_student(Admin $user)
        {
            $permission =Permission::where('name_slug', 'view_record_student')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function record_mark(Admin $user)
        {
            $permission =Permission::where('name_slug', 'record_mark')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }
    // result
    public function rank_student(Admin $user)
        {
            $permission =Permission::where('name_slug', 'rank_student')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function print_result(Admin $user)
        {
            $permission =Permission::where('name_slug', 'print_result')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function print_rank(Admin $user)
        {
            $permission =Permission::where('name_slug', 'print_rank')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function print_fee(Admin $user)
        {
            $permission =Permission::where('name_slug', 'print_fee')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }
    // settings
    public function school_theme(Admin $user)
        {
            $permission =Permission::where('name_slug', 'school_theme')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function school_profile(Admin $user)
        {
            $permission =Permission::where('name_slug', 'school_profile')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function add_role(Admin $user)
        {
            $permission =Permission::where('name_slug', 'add_role')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function add_user(Admin $user)
        {
            $permission =Permission::where('name_slug', 'add_user')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function user_role(Admin $user)
        {
            $permission =Permission::where('name_slug', 'user_role')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    public function send_result(Admin $user)
        {
            $permission =Permission::where('name_slug', 'send_result')->first();
            if(DB::table('admin_permission')
                    ->where('permission_id', $permission->id)
                    ->where('admin_id', $user->id)
                    ->exists()|| $user->is_super == 1){
                return true;
            } else {
                return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function view(User $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function restore(User $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function forceDelete(User $user, Permission $permission)
    {
        //
    }
}
