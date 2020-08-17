<?php

namespace App\Http\Controllers;

use App\Language;
use App\Permission;
use App\Setting;
use App\Term;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class pageController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth');
    }

    public function adminLaygout(){
        $this->authorize(['create_expenses', 'create_income','receive_fees','record_expense',
                        'report_fees', 'give_scholarship', 'scholarship_report',
                        'income_statement', 'print_reciept',
                        'create_class', 'edit_delete_class', 'sub_class', 'see_class',
                        'create_sector', 'create_backgorund', 'see_sector', 'see_background',
                        'add_student', 'class_list', 'promote_student','change_class',
                        'create_subject', 'all_subject', 'add_teacher', 'assign_subjects',
                        'teacher_subjects', 'add_type', 'record_student','view_record_student',
                        'record_mark','rank_student','print_result','print_rank',
                        'print_fee','school_theme', 'school_profile','add_role','add_user',
                        'user_role','send_result'
                                        ], Permission::class);
        return view('admin.layout');
    }

    public function studentLaygout(){
        return view('student.layout');
    }

    public function teacherLaygout(){
        return view('teacher.layout');
    }

    public function boserLaygout(){
        return view('boser.layout');
    }

    public function example(Request $req){
        $name = $req['name'];
        $notification = array(
            'message' => 'my name is '.$name.'!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
