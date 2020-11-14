<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            [
                'parent' => 'fees_expenses',
                'name' => 'can create income',
                'name_slug' => 'create_income',
            ],
            [
                'parent' => 'fees_expenses',
                'name' => 'can create expenses',
                'name_slug' => 'create_expenses',
            ],
            [
                'parent' => 'fees_expenses',
                'name' => 'can receive fee',
                'name_slug' => 'receive_fees',
            ],
            [
                'parent' => 'fees_expenses',
                'name' => 'can record expenses',
                'name_slug' => 'record_expense',
            ],
            [
                'parent' => 'fees_expenses',
                'name' => 'can report fees',
                'name_slug' => 'report_fees',
            ],
            [
                'parent' => 'fees_expenses',
                'name' => 'can give scholarhip',
                'name_slug' => 'give_scholarship',
            ],
            [
                'parent' => 'fees_expenses',
                'name' => 'can report Scholarship',
                'name_slug' => 'scholarship_report',
            ],
            [
                'parent' => 'fees_expenses',
                'name' => 'can see income stement',
                'name_slug' => 'income_statement',
            ],
            [
                'parent' => 'fees_expenses',
                'name' => 'can print receipt',
                'name_slug' => 'print_reciept',
            ],
            // these ones are for class
            [
                'parent' => 'classes',
                'name' => 'can create class',
                'name_slug' => 'create_class', // if can create, then can edit and delete
            ],
            [
                'parent' => 'classes',
                'name' => 'can create, edit and delete class',
                'name_slug' => 'edit_delete_class',
            ],
            [
                'parent' => 'classes',
                'name' => 'can create sub-class',
                'name_slug' => 'sub_class',
            ],
            [
                'parent' => 'classes',
                'name' => 'can see sub-class',
                'name_slug' => 'see_class',
            ],
            // sector and Background
            [
                'parent' => 'sector_background',
                'name' => 'can create sector',
                'name_slug' => 'create_sector',
            ],
            [
                'parent' => 'sector_background',
                'name' => 'can create background',
                'name_slug' => 'create_background',
            ],
            [
                'parent' => 'sector_background',
                'name' => 'can see all sector',
                'name_slug' => 'see_sector',
            ],
            [
                'parent' => 'sector_background',
                'name' => 'can see all background',
                'name_slug' => 'see_background',
            ],
            // students
            [
                'parent' => 'students',
                'name' => 'can add students',
                'name_slug' => 'add_student',
            ],
            [
                'parent' => 'students',
                'name' => 'can see class list',
                'name_slug' => 'class_list',
            ],
            [
                'parent' => 'students',
                'name' => 'can can promote student',
                'name_slug' => 'promote_student',
            ],
            [
                'parent' => 'students',
                'name' => 'can change student class',
                'name_slug' => 'change_class',
            ],
            // subjects
            [
                'parent' => 'subjects',
                'name' => 'can create subjects',
                'name_slug' => 'create_subject',
            ],
            [
                'parent' => 'subjects',
                'name' => 'can see all subjects',
                'name_slug' => 'all_subject',
            ],
            //teacher
            [
                'parent' => 'teachers',
                'name' => 'can add teacher',
                'name_slug' => 'add_teacher',
            ],
            [
                'parent' => 'teachers',
                'name' => 'can assign subject',
                'name_slug' => 'assign_subjects',
            ],
            [
                'parent' => 'teachers',
                'name' => 'can see all teachers/subjects',
                'name_slug' => 'teacher_subjects',
            ],
            // discipline
            [
                'parent' => 'discipline',
                'name' => 'can add type of discipline',
                'name_slug' => 'add_type',
            ],
            [
                'parent' => 'discipline',
                'name' => 'can record student discipline',
                'name_slug' => 'record_student',
            ],
            [
                'parent' => 'discipline',
                'name' => 'can view all discipne statistics',
                'name_slug' => 'view_record_student',
            ],
            //result
            [
                'parent' => 'result',
                'name' => 'can record mark',
                'name_slug' => 'record_mark',
            ],
            [
                'parent' => 'result',
                'name' => 'can rank student',
                'name_slug' => 'rank_student',
            ],
            [
                'parent' => 'result',
                'name' => 'can print result',
                'name_slug' => 'print_result',
            ],
             [
                'parent' => 'result',
                'name' => 'can print rank sheet',
                'name_slug' => 'print_rank',
            ],
             [
                'parent' => 'result',
                'name' => 'can print fee controlled form',
                'name_slug' => 'print_fee',
            ],
            // user and account
            [
                'parent' => 'roles',
                'name' => 'can add role',
                'name_slug' => 'add_role',
            ],
            [
                'parent' => 'roles',
                'name' => 'can edit roles',
                'name_slug' => 'edit_role',
            ],
            [
                'parent' => 'roles',
                'name' => 'can see users role',
                'name_slug' => 'user_role',
            ],
            //transfer result online
            [
                'parent' => 'tranfer_result',
                'name' => 'can send result online',
                'name_slug' => 'send_result',
            ],
            //settings
            [
                'parent' => 'setting',
                'name' => 'can modify school theme',
                'name_slug' => 'school_theme',
            ],
            [
                'parent' => 'setting',
                'name' => 'can modify school profile',
                'name_slug' => 'school_profile',
            ]
        ];
        foreach($permissions as $permit){
            Permission::create($permit);
        }
    }
}
