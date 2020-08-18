<?php

namespace App\Http\Controllers;

use App\Firsttermresult;
use App\Form;
use App\Generateresult;
use App\Permission;
use App\Secondtermresult;
use App\Subclass;
use App\Subject;
use App\Term;
use App\Thirdtermresult;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RankStudentController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function index(){
        $this->authorize('rank_student', Permission::class);

        $data['ranked'] = Generateresult::where('rank_student', 1)->get();
        return view('admin.student_marks.rank_students')->with($data);
    }


    public function classResult(Request $req){
        $this->authorize('rank_student', Permission::class);
        $this->validate($req, [
            'class' => 'required'
        ]);

         try {
            $class_id = Crypt::decrypt($req['class']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }

        $arr = array();
        $arr_sum = array();

        $current_year = Year::where('active', 1)->first();
        $current_term = Term::where('active', 1)->first();

        if(strcmp($current_term->name, "First Term") == 0){
            $term = Firsttermresult::where('year_id', $current_year->id)->where('form_id', $class_id)->get();
            $nu1 = 1;
            $nu2 = 2;
        }elseif(strcmp($current_term->name, "Second Term") == 0){
            $term = Secondtermresult::where('year_id', $current_year->id)->where('form_id', $class_id)->get();
            $nu1 = 3;
            $nu2 = 4;
        } else{
            $term = Thirdtermresult::where('year_id', $current_year->id)->where('form_id', $class_id)->get();
            $nu1 = 5;
            $nu2 = 6;
        }
        $all_term_result = $term;

        $form = Form::where('id', $class_id)->first();
        $sub_form = Subclass::where('form_id', $form->id)->get();

        // selecting alll the subjects from the form
        $subjects = Subject::where('form_id', $form->id)->get();
        $subjects_coefficient = Subject::where('form_id', $form->id)->sum('coefficient');

   // echo $subjects_coefficient;
        foreach($subjects as $subject){
            if($nu1 == 1 || $nu2 == 2){
                $count_student = Firsttermresult::where('subject_id', $subject->id)->where('form_id', $class_id)->count();
            }elseif($nu1 == 3 || $nu2 == 4){
                $count_student = Secondtermresult::where('subject_id', $subject->id)->where('form_id', $class_id)->count();
            }
            else{
                $count_student = Thirdtermresult::where('subject_id', $subject->id)->where('form_id', $class_id)->count();
            }
            $sub = ['subject_name' => $subject->name,
                    'subject_coff' => $subject->coefficient,
                    'point' => 20*(int)$subject->coefficient,
                    'number_student' => $count_student
                ];
            array_push($arr, $sub);
            array_push($arr_sum, 20*(int)$subject->coefficient);
        }
        // first test
        $arr_first = array();
       // $all_student_mark = array();
        $sum_coff = array();
        foreach ($subjects as $sb) {
            $first_test_student = $term->where('subject_id', $sb->id)->count();
            $total_wrote = $term->where('seq'.$nu1.'', '!=', null)->where('subject_id', $sb->id)->count();
            $total_pass = $term->where('seq'.$nu1.'', '>=', 10)->where('subject_id', $sb->id)->count();
            $highest_mark = $term->where('subject_id', $sb->id)->max('seq'.$nu1.'');
            $sum_marks = $term->where('subject_id', $sb->id)->sum('seq'.$nu1.'');

            if($first_test_student == 0){
                $all_students = 1;
            }
            else {
                $all_students = $first_test_student;
            }
            $subject_percentage_pass = $sum_marks*100/(20*$all_students);
            $average = 20*$subject_percentage_pass/100;
             //sum student marks multiply by sum of class coefficient
           // $sum_point =  20*(int)$sb->coefficient*$first_test_student;

            $farr = [
                'sub_name' => $sb->name.' '.$sb->code,
                'first_test_student' => $first_test_student,
                'total_wrote' => $total_wrote,
                'total_pass' => $total_pass,
                'highest_mark' => $highest_mark,
                'percentage' => number_format((float)$subject_percentage_pass, 2, '.', ' '),
                'average' => $average
            ];
            array_push($arr_first, $farr);
           // array_push($all_student_mark, $sum_marks);
        }
      //  return $arr_first;


        $data['avg'] = array_sum($arr_sum)/$subjects_coefficient;
        $data['total_point'] = array_sum($arr_sum);
        $data['form'] = $form;
        $data['subjects'] = $arr;
        $data['sum_coff'] = $subjects_coefficient;
        $data['ranked'] = Generateresult::where('term_id', $current_term)->where('year_id', $current_year)->get();

        return view('admin.student_marks.rank_final')->with($data);
    }
}
